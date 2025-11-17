<?php

namespace App\Controllers;

class Returns extends BaseController
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

        $data = ['title' => 'Returns'];

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
        $data = ['title' => 'Process Return'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/returns/process_return_view', $data)
            .view('include/foot_view');
    }
}
