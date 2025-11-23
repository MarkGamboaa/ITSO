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

        $usersModel = model('Users_model');
        $auser = $usersModel->where('email', $email)->first();

        if(empty($email) || empty($password)) {
            $session->setFlashdata('msg', 'Email and Password are required.');
            return redirect()->to(base_url('auth/login'));
        }

        if (empty($auser) || strcasecmp($auser['role'] ?? '', 'ITSO') !== 0) {
            $session->setFlashdata('msg', 'Only ITSO personnel can login.');
            return redirect()->to(base_url('auth/login'));
        }
        $stored = $auser['password_hash'] ?? '';

        // Support hashed passwords (recommended) or plain-text fallback
        $passwordOk = false;
        if (! empty($stored) && password_verify($password, $stored)) {
            $passwordOk = true;
        }

        if ($passwordOk) {
            $session->set([
                'user_id'    => $auser['user_id'] ?? 0,
                'email'      => $auser['email'] ?? '',
                'role'       => $auser['role'] ?? '',
                'isLoggedIn' => true,
            ]);
            // redirect to the app home (Index::index) 
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

    public function send_reset_link()
    {
        $session = session();
        $userEmail = strtolower(trim($this->request->getPost('email')));
        
        if (empty($userEmail)) {
            $session->setFlashdata('errors', ['email' => 'Email is required.']);
            return redirect()->to(base_url('auth/reset'))->withInput();
        }
        
        $usersModel = model('Users_model');
        $user = $usersModel->where('email', $userEmail)->where('role', 'ITSO')->first();
        
        if (!$user) {
            $session->setFlashdata('errors', ['email' => 'Email address not found.']);
            return redirect()->to(base_url('auth/reset'))->withInput();
        }
        
        $message = "Dear User,\n\n";
        $message .= "Please click the link below to reset your password:\n";
        $message .= '<a href="' . base_url('auth/reset_password_form?email=' . urlencode($userEmail)) . '">Reset Password</a>' . "\n\n";
        $message .= "If you did not request a password reset, please ignore this email.\n\n";
        $message .= "Best regards,\n";
        $message .= "FEU IT Support Office";
    
        $emailService = service('email');
        $emailService->setTo($userEmail);
        $emailService->setSubject('Password Reset Request');
        $emailService->setMessage($message);
        
        if ($emailService->send()) {
            $session->setFlashdata('msg', 'A password reset link has been sent to your email address.');
            return redirect()->to(base_url('auth/reset'));
        } else {
            $session->setFlashdata('errors', ['email' => 'Failed to send reset email. Please try again later.']);
            return redirect()->to(base_url('auth/reset'))->withInput();
        }
    }

    public function reset_password_form()
    {
        $email = $this->request->getGet('email');
        
        if (empty($email)) {
            return redirect()->to(base_url('auth/reset'));
        }
        
        $data = [
            'title' => 'Reset Password',
            'email' => $email
        ];

        return view('include/head_view', $data)
            .view('ITSO/auth/auth_reset_password_form', $data);
    }

    public function update_password()
    {
        $session = session();
        $validation = service('validation');
        
        $email = $this->request->getPost('email');
        
        $data = [
            'new_password' => $this->request->getPost('new_password'),
            'confirm_password' => $this->request->getPost('confirm_password')
        ];

        if (!$validation->run($data, 'password_reset')) {
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('auth/reset_password_form?email=' . urlencode($email)))->withInput();
        }

        $usersModel = model('Users_model');
        $user = $usersModel->where('email', $email)->where('role', 'ITSO')->first();

        if (!$user) {
            $session->setFlashdata('errors', ['Invalid reset link.']);
            return redirect()->to(base_url('auth/reset'));
        }

        $hashedPassword = password_hash($data['new_password'], PASSWORD_DEFAULT);
        $usersModel->update($user['user_id'], ['password_hash' => $hashedPassword]);

        $session->setFlashdata('msg', 'Password reset successfully. You can now login.');
        return redirect()->to(base_url('auth/login'));
    }
}
