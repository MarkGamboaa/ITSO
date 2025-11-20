<?php

namespace App\Controllers;

class Borrowing extends BaseController
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
        $data = ['title' => 'Borrowing'];

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

    public function history()
    {   
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'Borrowing History'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/borrow/borrowing_history_view', $data)
            .view('include/foot_view');
    }
}
