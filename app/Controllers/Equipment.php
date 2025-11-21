<?php

namespace App\Controllers;

class Equipment extends BaseController
{
    protected function auth()
    {
        $session = session();
        if (! $session->get('isLoggedIn') || $session->get('role') !== 'ITSO') {
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
        $data = ['title' => 'Equipment'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/equipment/equipment_table_view', $data)
            .view('include/foot_view');
    }

    public function add()
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'Add Equipment'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/equipment/add_equipment_view', $data)
            .view('include/foot_view');
    }

    public function edit($id = null)
    {   
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'Edit Equipment', 'id' => $id];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/equipment/edit_equipment_view', $data)
            .view('include/foot_view');
    }

    public function view($id = null)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'View Equipment', 'id' => $id];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/equipment/view_equipment_view', $data)
            .view('include/foot_view');
    }

    public function deactivate($id = null)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'Deactivate Equipment', 'id' => $id];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/equipment/deactivate_equipment_view', $data)
            .view('include/foot_view');
    }
}
