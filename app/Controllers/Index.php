<?php
namespace App\Controllers;

class Index extends BaseController {
    protected function auth()
    {
        $session = session();
        if (! $session->get('isLoggedIn') || $session->get('role') !== 'ITSO') {
            return redirect()->to(base_url('auth/login'));
        }
        return null;

    }
    public function index() {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $session = session();
        $usermodel = model('Users_Model');
        $equipmentmodel = model('Equipment_Model');
        $borrowmodel = model('BorrowRecords_Model');
        $reservationmodel = model('Reservations_Model');
        
        $data = array(
            'title' => 'ITSO - DASHBOARD',
            'totalUsers' => $usermodel->countAllResults(),
            'totalEquipment' => $equipmentmodel->countAllResults(),
            'totalBorrowed' => $borrowmodel->where('returned_at IS NULL', null, false)->where('status', 'Borrowed')->countAllResults(false),
            'totalReservations' => $reservationmodel->where('reservation_confirmation', '1')->where('status', 'Active')->countAllResults(),
            'borrowing' => $borrowmodel
                    ->select('borrow_records.*, users.last_name as user_name, equipment.name as equipment_name, equipment.accessories as accessories')
                    ->join('users', 'users.user_id = borrow_records.user_id')
                    ->join('equipment', 'equipment.equipment_id = borrow_records.equipment_id')
                    ->where('borrow_records.returned_at IS NULL', null, false)
                    ->where('borrow_records.status', 'Borrowed')
                    ->orderBy('borrow_records.borrowed_at', 'DESC')
                    ->limit(5)
                    ->findAll()
        );

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/main_view', $data)
            .view('include/foot_view');
    }
}
?>