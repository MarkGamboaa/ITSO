<?php

namespace App\Controllers;

class Returns extends BaseController
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
        $equipmentmodel = model('Equipment_model');
        $usermodel = model('User_model');
        $session = session();

        // Get returned items with equipment and user details
        $data = ['title' => 'Returns',
                 'returnedItems' => $borrowingmodel
                    ->select('borrow_records.*, equipment.name, equipment.accessories as accessories, users.first_name as first_name, users.last_name as last_name')
                    ->join('equipment', 'equipment.equipment_id = borrow_records.equipment_id')
                    ->join('users', 'users.user_id = borrow_records.user_id')
                    ->where('borrow_records.status', 'Returned')
                    ->orderBy('borrow_records.returned_at', 'DESC')
                    ->paginate(10),
                 'pager' => $borrowingmodel->pager
                ];
        
        $borrowingmodel->pager->setPath('returns');

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/returns/returns_table_view', $data)
            .view('include/foot_view');
    }

    public function process()
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }


        $data = ['title' => 'Process Return'
                ];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/returns/process_return_view', $data)
            .view('include/foot_view');
    }

    public function completeReturn()
    {
    $check = $this->auth();
    if ($check !== null) {
        return $check;
    }

    $borrowingmodel = model('BorrowRecords_Model');
    $equipmentmodel = model('Equipment_model');
    $usermodel = model('Users_model');
    $session = session();
    
    if (!$this->request->is('post')) {
        return redirect()->to(base_url('returns'))->with('error', 'Invalid request method.');
    }

    $data = array(
        'email' => strtolower(trim($this->request->getPost('email'))),
        'condition' => $this->request->getPost('condition'),
    );

    // Find user by email
    $user = $usermodel->where('email', $data['email'])->first();
    if (!$user) {
        $session->setFlashdata('errors', ['User not found']);
        return redirect()->to(base_url('returns/process'))->withInput();
    }

    // Find all active borrow records for this user
    $borrowRecords = $borrowingmodel
        ->where('user_id', $user['user_id'])
        ->where('status', 'Borrowed')
        ->findAll();
    
    if (empty($borrowRecords)) {
        $session->setFlashdata('errors', ['No active borrow records found for this user.']);
        return redirect()->to(base_url('returns/process'));
    }

    // Update all borrow records
    foreach ($borrowRecords as $borrowRecord) {
        $borrowingmodel->update($borrowRecord['id'], [
            'status' => 'Returned',
            'return_condition' => $data['condition'],
            'returned_at' => date('Y-m-d H:i:s')
        ]);

        // Update equipment availability
        $equipment = $equipmentmodel->find($borrowRecord['equipment_id']);
        if ($equipment) {
            $equipmentmodel->update($borrowRecord['equipment_id'], [
                'available_count' => $equipment['available_count'] + $borrowRecord['borrow_quantity']
            ]);
        }
    }

    $itemCount = count($borrowRecords);
    $message = "Dear {$user['first_name']},\n\n";
    $message .= "Your borrowed {$itemCount} item(s) have been successfully returned.\n\n";
    $message .= "Return Condition: {$data['condition']}\n";
    $message .= "Date Returned: " . date('Y-m-d H:i:s') . "\n\n";
    $message .= "Thank you.";
    
    $emailService = service('email');
    $emailService->setTo($user['email']);
    $emailService->setSubject('Return Processed');
    $emailService->setMessage($message);
    $emailService->send();

    return redirect()->to(base_url('returns'))->with('success', 'Return processed successfully.');
}
}