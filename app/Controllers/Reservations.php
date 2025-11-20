<?php

namespace App\Controllers;

class Reservations extends BaseController
{
    protected function auth()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
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

        $data = ['title' => 'Reservations'];

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
