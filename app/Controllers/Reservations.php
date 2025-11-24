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
                    ->select('reservations.*, users.last_name as user_name, equipment.name as equipment_name, equipment.accessories')
                    ->join('users', 'users.user_id = reservations.user_id')
                    ->join('equipment', 'equipment.equipment_id = reservations.equipment_id')
                    ->where('reservations.status', 'Active')
                    ->where('reservations.reservation_confirmation', 1)
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
    $equipmentmodel = model('Equipment_model');
    $session = session();
    $validation = service('validation');

    $data = array(
        'email' => strtolower(trim($this->request->getPost('email'))),
        'equipment_id' => $this->request->getPost('equipment_id'),
        'quantity' => $this->request->getPost('quantity'),
        'reserved_date' => $this->request->getPost('reserved_date'),
        'status' => 'Active',
        'reservation_token' => bin2hex(random_bytes(16)),
    );
    
    // using validation rules with custom error messages
    $validation->setRules(
        config('Validation')->reservation,
        config('Validation')->reservation_errors
    );
    
    if(!$validation->run($data)){
        $session->setFlashdata('errors', $validation->getErrors());
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
    $user = $usersmodel->where('email', $userEmail)->first();
    
    if (!$user) {
        $session->setFlashdata('errors', ['email' => 'User not found with this email.']);
        return redirect()->to(base_url('reservations/reserve'))->withInput();
    }

    // Check if the specific user is an Associate
    if ($user['role'] !== 'Associate') {
        $session->setFlashdata('errors', ['email' => 'Only active Associates can make reservations.']);
        return redirect()->to(base_url('reservations/reserve'))->withInput();
    }
    if ($user['is_active'] != 1) {
        $session->setFlashdata('errors', ['email' => 'Your account is deactivated. Please contact ITSO for assistance.']);
        return redirect()->to(base_url('reservations/reserve'))->withInput();
    }
    
    $data['user_id'] = $user['user_id'];
    unset($data['email']);
    
    $equipment = $equipmentmodel->find($data['equipment_id']);
    if (!$equipment || $equipment['available_count'] < $data['quantity']) {
        $session->setFlashdata('errors', ['quantity' => "Only {$equipment['available_count']} left in stock."]);
        return redirect()->to(base_url('reservations/reserve'))->withInput();
    }
    // REMOVED: Equipment count reduction - will be done in confirm()

    $reservationsmodel->insert($data);

    $message = 'Confirm your reservation by clicking the link below:<br>
    <a href="' . base_url('reservations/confirm/' . $data['reservation_token']) . '">Confirm Reservation</a>';
    $email = service('email');
    $email->setTo($userEmail);
    $email->setSubject('Confirm your reservation');
    $email->setMessage($message);
    $email->send();

    $session->setFlashdata('success', 'Reservation successful. Please check your email to confirm.');
    return redirect()->to(base_url('reservations/'));
}
    public function confirm($reservation_token)
    {
    $reservationsmodel = model('Reservations_model');
    $borrowmodel = model('BorrowRecords_Model');
    $equipmentmodel = model('Equipment_model');
    $session = session();
    
    $reservation = $reservationsmodel->where('reservation_token', $reservation_token)->first();
    
    if($reservation){
        // Check if already confirmed
        if($reservation['reservation_confirmation'] == 1){
            $session->setFlashdata('msg', 'Reservation already confirmed.');
            return redirect()->to(base_url('reservations/confirmationView'));
        }
        
        // Get equipment details
        $equipment = $equipmentmodel->find($reservation['equipment_id']);
        
        // Check if enough equipment available
        if (!$equipment || $equipment['available_count'] < $reservation['quantity']) {
            $session->setFlashdata('errors', ['quantity' => "Not enough equipment available. Only {$equipment['available_count']} left in stock."]);
            return redirect()->to(base_url('reservations/confirmationView'));
        }
        
        // Reduce equipment count
        $equipmentmodel->update($reservation['equipment_id'], [
            'available_count' => $equipment['available_count'] - $reservation['quantity']
        ]);
        
        // Create borrow record
        $borrowmodel->insert([
            'user_id' => $reservation['user_id'],
            'equipment_id' => $reservation['equipment_id'],
            'borrow_quantity' => $reservation['quantity'],
            'borrowed_at' => $reservation['reserved_date'],
            'status' => 'Borrowed'
        ]);
        
        // Update reservation
        $data_update = array(
            'reservation_confirmation' => 1,
        );
        $reservationsmodel->update($reservation['reservation_id'], $data_update);
        
        $session->setFlashdata('msg', 'Reservation confirmed successfully.');
        return redirect()->to(base_url('reservations/confirmationView')); 
    }
    
    return redirect()->to(base_url('reservations/confirmationView'));
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

    public function cancel($reservation_id)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }

        $reservationsmodel = model('Reservations_model');
        $equipmentmodel = model('Equipment_model');
        $borrowmodel = model('BorrowRecords_Model');
        $session = session();

        // Get reservation details
        $reservation = $reservationsmodel->find($reservation_id);
        
        if (!$reservation) {
            $session->setFlashdata('errors', ['general' => 'Reservation not found.']);
            return redirect()->to(base_url('reservations'));
        }

        if ($reservation['status'] !== 'Active') {
            $session->setFlashdata('errors', ['general' => 'Reservation is not active and cannot be cancelled.']);
            return redirect()->to(base_url('reservations'));
        }

        // If reservation was confirmed, restore equipment count and update borrow record
        if ($reservation['reservation_confirmation'] == 1) {
            // Get equipment details
            $equipment = $equipmentmodel->find($reservation['equipment_id']);
            
            // Restore equipment count
            $equipmentmodel->update($reservation['equipment_id'], [
                'available_count' => $equipment['available_count'] + $reservation['quantity']
            ]);

            // Update borrow record status to cancelled
            $borrowmodel->where('user_id', $reservation['user_id'])
                       ->where('equipment_id', $reservation['equipment_id'])
                       ->where('status', 'Borrowed')
                       ->set(['status' => 'Cancelled', 'updated_at' => date('Y-m-d H:i:s')])
                       ->update();
        }

        // Update reservation status
        $reservationsmodel->update($reservation_id, [
            'status' => 'Cancelled',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $session->setFlashdata('success', 'Reservation cancelled successfully.');
        return redirect()->to(base_url('reservations'));
    }

    public function reschedule($reservation_id)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }

        $reservationsmodel = model('Reservations_model');
        
        // Get reservation details with user and equipment info
        $reservation = $reservationsmodel
            ->select('reservations.*, users.last_name as user_name, equipment.name as equipment_name')
            ->join('users', 'users.user_id = reservations.user_id')
            ->join('equipment', 'equipment.equipment_id = reservations.equipment_id')
            ->where('reservations.reservation_id', $reservation_id)
            ->first();

        if (!$reservation) {
            session()->setFlashdata('errors', ['general' => 'Reservation not found.']);
            return redirect()->to(base_url('reservations'));
        }

        if ($reservation['status'] !== 'Active') {
            session()->setFlashdata('errors', ['general' => 'Only active reservations can be rescheduled.']);
            return redirect()->to(base_url('reservations'));
        }

        $data = [
            'title' => 'Reschedule Reservation',
            'reservation' => $reservation
        ];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reservations/reschedule_view', $data)
            .view('include/foot_view');
    }

    public function updateSchedule($reservation_id)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        

        $reservationsmodel = model('Reservations_model');
        $borrowmodel = model('BorrowRecords_Model');
        $session = session();
        $validation = service('validation');

        $newDate = $this->request->getPost('reserved_date');

        // Validate the new date
        $validation->setRules([
            'reserved_date' => 'required|valid_date'
        ]);

        if (!$validation->run(['reserved_date' => $newDate])) {
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('reservations/reschedule/' . $reservation_id))->withInput();
        }

        // Check if the new date is at least 1 day in advance
        $reservedDate = strtotime($newDate);
        $minDate = strtotime('+1 day', strtotime('today'));
        
        if ($reservedDate < $minDate) {
            $session->setFlashdata('errors', ['reserved_date' => 'The reservation date must be at least 1 day in advance.']);
            return redirect()->to(base_url('reservations/reschedule/' . $reservation_id))->withInput();
        }

        // Update the reservation date
        $reservationsmodel->update($reservation_id, [
            'reserved_date' => $newDate,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $borrowmodel->where('user_id', $reservationsmodel->find($reservation_id)['user_id'])
                    ->where('equipment_id', $reservationsmodel->find($reservation_id)['equipment_id'])
                    ->where('status', 'Borrowed')
                    ->set(['updated_at' => date('Y-m-d H:i:s')])
                    ->set(['borrowed_at' => $newDate])
                    ->update();
        
        

        $session->setFlashdata('success', 'Reservation rescheduled successfully.');
        return redirect()->to(base_url('reservations'));
    }

    public function confirmationView()
    {
        $data = ['title' => 'Reservation Confirmed'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reservations/confirmation_view', $data)
            .view('include/foot_view');
    }
}
