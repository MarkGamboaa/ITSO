<?php
namespace App\Controllers;

class Users extends BaseController {
    public function index() {
        $data = array(
            'title' => 'Users List',
        );

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/userslist_view', $data)
            .view('include/foot_view');
    }

    public function register()
    {
        $data = ['title' => 'Register User'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/users_register_view', $data)
            .view('include/foot_view');
    }

    public function view($id = null)
    {
        $data = ['title' => 'View User', 'id' => $id];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/users_view_view', $data)
            .view('include/foot_view');
    }

    public function edit($id = null)
    {
        $data = ['title' => 'Edit User', 'id' => $id];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/users_edit_view', $data)
            .view('include/foot_view');
    }

    public function deactivate($id = null)
    {
        $data = ['title' => 'Deactivate User', 'id' => $id];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/users_deactivate_view', $data)
            .view('include/foot_view');
    }
}
?>