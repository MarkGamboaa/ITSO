<?php
namespace App\Controllers;

class Users extends BaseController {

    protected function auth()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('auth/login'));
        }
        return null;

    }
    
    public function index() {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }

        // load model and fetch users
        $usermodel = model('Users_model');

        // normalize fields expected by the view
        

        $data = array (
            'title' => 'Users List',
            'users' => $usermodel->paginate(3),
            'pager' => $usermodel->pager
        );
        $usermodel->pager->setPath('users');
        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/userslist_view', $data)
            .view('include/foot_view');
    }

    public function register()
    {   
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'Register User'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/users_register_view', $data)
            .view('include/foot_view');
    }

    public function view($id = null)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'View User', 'id' => $id];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/users_view_view', $data)
            .view('include/foot_view');
    }

    public function edit($id = null)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'Edit User', 'id' => $id];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/users_edit_view', $data)
            .view('include/foot_view');
    }

    public function deactivate($id = null)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'Deactivate User', 'id' => $id];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/users_deactivate_view', $data)
            .view('include/foot_view');
    }
}
?>