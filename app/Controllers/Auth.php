<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        $data = ['title' => 'Login'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/auth/auth_login_view', $data)
            .view('include/foot_view');
    }

    public function reset()
    {
        $data = ['title' => 'Reset Password'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/auth/auth_reset_view', $data)
            .view('include/foot_view');
    }
}
