<?php

namespace App\Controllers;

class Reservations extends BaseController
{
    protected function auth()
    {
        $session = session();
        if (! $session->get('isLoggedIn') || $session->get('role') !== 'ITSO') {
            return redirect()->to(base_url('auth/login'));
        }
        return null;

    }
    public function index()
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $reservationmodel = model('Reservations_model');

        $data = ['title' => 'Reservations',
                'reservations' => $reservationmodel
                    ->select('reservations.*, users.last_name as user_name, equipment.name as equipment_name')
                    ->join('users', 'users.user_id = reservations.user_id')
                    ->join('equipment', 'equipment.equipment_id = reservations.equipment_id')
                    ->where('reservations.status', 'Active')
                    ->paginate(10),
                'pager' => $reservationmodel->pager 
        ];

        $reservationmodel->pager->setPath('reservations');
        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reservations/reservations_table_view', $data)
            .view('include/foot_view');
    }

    public function reserve()
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'Reserve Equipment'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reservations/reserve_view', $data)
            .view('include/foot_view');
    }

    public function insert()
    {
        
        $reservationsmodel = model('Reservations_model');
        $usersmodel = model('Users_model');
        $session = session();
        $validation = service('validation');
        
        $data = array(
            'email' => strtolower(trim($this->request->getPost('email'))),
            'equipment_id' => $this->request->getPost('equipment_id'),
            'quantity' => $this->request->getPost('quantity'),
            'reserved_date' => $this->request->getPost('reserved_date'),
            'status' => 'Active'
        );
        // using validation rules
        if(!$validation->run($data, 'reservation')){
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('reservations/reserve'))->withInput();
        }
        // to check if email belongs to an active Associate
        $user = $usersmodel->where('email', $data['email'])->where('role', 'Associate')->first();
        if (!$user) {
            $session->setFlashdata('errors', ['email' => 'Only active Associates can make reservations.']);
            return redirect()->to(base_url('reservations/reserve'))->withInput();
        }
        // to check if user is still active
        if($user['is_active'] != 1) {
            $session->setFlashdata('errors', ['email' => 'This user account is not active.']);
            return redirect()->to(base_url('reservations/reserve'))->withInput();
        }

        $reservedDate = strtotime($data['reserved_date']);
        $minDate = strtotime('+1 day', strtotime('today'));
        if ($reservedDate < $minDate) {
            $session->setFlashdata('errors', ['reserved_date' => 'The reservation date must be at least 1 day in advance.']);
            return redirect()->to(base_url('reservations/reserve'))->withInput();
        }

        // Prepare data for insertion - replace email with user_id
        $userEmail = $data['email'];
        $data['user_id'] = $user['user_id'];
        unset($data['email']);

        $reservationsmodel->insert($data);

        $message = 'Reservation successful.';
        $email = service('email');
        $email->setTo($userEmail);
        $email->setSubject('Reservation Successful');
        $email->setMessage($message);
        $email->send();

        $session->setFlashdata('success', 'Reservation successful.');
        return redirect()->to(base_url('reservations'));
        
    }

    public function manage()
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'Manage Reservations'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reservations/manage_reservations_view', $data)
            .view('include/foot_view');
    }
}
