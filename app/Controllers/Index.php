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
            'totalBorrowed' => $borrowmodel->where('status', 'borrowed')->countAllResults(),
            'totalReservations' => $reservationmodel->where('status', 'Active')->countAllResults(),
        );

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/main_view', $data)
            .view('include/foot_view');
    }
}
?>