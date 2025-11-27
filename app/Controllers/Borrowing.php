<?php

namespace App\Controllers;

class Borrowing extends BaseController
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
        $borrowingmodel = model('BorrowRecords_Model');
        $reservationmodel = model('Reservations_Model');
        $equipmentmodel = model('Equipment_model');
        
        // Check all reservations and convert to borrow if reserved_date is today
        $currentDate = date('Y-m-d');
        $reservations = $reservationmodel->where('reserved_date', $currentDate)
                                         ->where('status', 'Active')
                                         ->where('reservation_confirmation', 1)
                                         ->findAll();
        
        foreach ($reservations as $reservation) {
            // Get equipment details
            $equipment = $equipmentmodel->find($reservation['equipment_id']);
            
            if ($equipment && $equipment['available_count'] >= $reservation['quantity']) {
                // Reduce equipment count
                $equipmentmodel->update($reservation['equipment_id'], [
                    'available_count' => $equipment['available_count'] - $reservation['quantity']
                ]);
                
                // Create borrow record
                $borrowingmodel->insert([
                    'user_id' => $reservation['user_id'],
                    'equipment_id' => $reservation['equipment_id'],
                    'borrow_quantity' => $reservation['quantity'],
                    'borrowed_at' => $reservation['reserved_date'],
                    'status' => 'Borrowed'
                ]);
                
                // Update reservation status to 'completed'
                $reservationmodel->update($reservation['reservation_id'], [
                    'status' => 'Completed'
                ]);
            }
        }

        $data = ['title' => 'Borrowing',
                'borrowing' => $borrowingmodel
                    ->select('borrow_records.*, users.last_name as user_name, equipment.name as equipment_name, equipment.accessories as accessories')
                    ->join('users', 'users.user_id = borrow_records.user_id')
                    ->join('equipment', 'equipment.equipment_id = borrow_records.equipment_id')
                    ->where('borrow_records.returned_at IS NULL', null, false)
                    ->where('borrow_records.status', 'Borrowed')
                    ->paginate(10),
                'pager' => $borrowingmodel->pager 
        ];
        $borrowingmodel->pager->setPath('borrowing');

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/borrow/borrowing_table_view', $data)
            .view('include/foot_view');
    }

    public function borrow()
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }        
        $data = ['title' => 'Borrow Equipment'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/borrow/borrow_view', $data)
            .view('include/foot_view');
    }

    public function insert()
    {
        $borrowrecordsmodel = model('BorrowRecords_Model');
        $usersmodel = model('Users_model');
        $equipmentmodel = model('Equipment_model');
        $session = session();
        $validation = service('validation');
        
        $data = array(
            'email' => strtolower(trim($this->request->getPost('email'))),
            'equipment_id' => $this->request->getPost('equipment_id'),
            'borrow_quantity' => $this->request->getPost('borrow_quantity'),
        );

        // Validate using borrow_rules from Validation.php
        if (!$validation->run($data, 'borrow_rules')) {
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('borrowing/borrow'))->withInput();
        }

        // Get user_id from email
        $user = $usersmodel->where('email', $data['email'])->where('email_verified', 1)->where('is_active', 1)->first();
        
        if (!$user) {
            $session->setFlashdata('errors', ['email' => 'User not found or inactive']);
            return redirect()->to(base_url('borrowing/borrow'))->withInput();
        }

        // Check equipment availability
        $equipment = $equipmentmodel->find($data['equipment_id']);
        
        if (!$equipment) {
            $session->setFlashdata('errors', ['equipment_id' => 'Equipment not found']);
            return redirect()->to(base_url('borrowing/borrow'))->withInput();
        }

        if (!$equipment || $equipment['available_count'] < $data['borrow_quantity']) {
            $session->setFlashdata('errors', ['quantity' => "Not enough equipment available. Only {$equipment['available_count']} left in stock."]);
            return redirect()->to(base_url('borrowing/borrow'))->withInput();
        }

        // Insert borrow record
        $borrowData = [
            'user_id' => $user['user_id'],
            'equipment_id' => $data['equipment_id'],
            'borrow_quantity' => $data['borrow_quantity'],
            'borrowed_at' => date('Y-m-d H:i:s')
        ];
        $message = 'You borrowed equipment.<br>
        <strong>Item:</strong> ' . $equipment['name'] . '<br>
        <strong>Quantity:</strong> ' . $data['borrow_quantity'] . '<br>
        <Strong>Accessories:</strong> ' . $equipment['accessories'] . '<br>
        <strong>Borrowed At:</strong> ' . date('Y-m-d H:i:s') . '<br>';
        $email = service('email');
        $email->setTo($user['email']);
        $email->setSubject('Borrowed Equipment');
        $email->setMessage($message);
        $email->send();

        if ($borrowrecordsmodel->insert($borrowData)) {
            // Update equipment quantity
            $equipmentmodel->update($data['equipment_id'], [
                'available_count' => $equipment['available_count'] - $data['borrow_quantity']
            ]);
            $session->setFlashdata('success', 'Equipment borrowed successfully');
            return redirect()->to(base_url('borrowing'));
        }
    }

    public function history()
    {   
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $borrowingmodel = model('BorrowRecords_Model');

        $data = ['title' => 'Borrowing History',
                'borrowing' => $borrowingmodel
                    ->select('borrow_records.*, users.last_name as user_name, equipment.name as equipment_name, equipment.accessories as accessories')
                    ->join('users', 'users.user_id = borrow_records.user_id')
                    ->join('equipment', 'equipment.equipment_id = borrow_records.equipment_id')
                    ->where('borrow_records.returned_at IS NOT NULL')
                    ->paginate(10),
                'pager' => $borrowingmodel->pager 
        ];
        $borrowingmodel->pager->setPath('borrowing/history');

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/borrow/borrowing_history_view', $data)
            .view('include/foot_view');
    }
}
