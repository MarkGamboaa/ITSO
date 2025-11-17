<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Login'];

        return view('include/head_view', $data)
            .view('ITSO/auth/auth_login_view', $data);
    }

    public function login()
    {
        $session = session();

        // Only accept POST
        if ($this->request->getMethod() !== 'post') {
            
        }

        $email = strtolower(trim($this->request->getPost('email')));
        $password = $this->request->getPost('password');

        // instantiate model using full namespace (more reliable)
        $usersModel = model('Users_model');
        $user = $usersModel->where('email', $email)->first();

        if (strcasecmp($user['role'] ?? '', 'ITSO') !== 0) {
            $session->setFlashdata('msg', 'Only ITSO personnel can login.');
            return redirect()->to(base_url('auth/login'));
        }
        $stored = $user['password'] ?? '';

        // Support hashed passwords (recommended) or plain-text fallback
        $passwordOk = false;
        if (! empty($stored) && password_verify($password, $stored)) {
            $passwordOk = true;
        } elseif ($password === $stored) {
            $passwordOk = true; // fallback if DB holds plain text (not recommended)
        }

        
        if ($passwordOk) {
            $session->set([
                'user_id'    => $user['id'] ?? 0,
                'username'   => $user['username'] ?? '',
                'email'      => $user['email'] ?? '',
                'isLoggedIn' => true,
            ]);
            // redirect to the app home (Index::index) which enforces auth()
            return redirect()->to(base_url('/'));
        }

        $session->setFlashdata('msg', 'Invalid login credentials.');
        return redirect()->to(base_url('auth/login'));
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('auth/index'));
    }

    public function reset()
    {
        $data = ['title' => 'Reset Password'];

        return view('include/head_view', $data)
            .view('ITSO/auth/auth_reset_view', $data);
    }
}
