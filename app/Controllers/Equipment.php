<?php

namespace App\Controllers;

class Equipment extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Equipment'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/equipment/equipment_table_view', $data)
            .view('include/foot_view');
    }

    public function add()
    {
        $data = ['title' => 'Add Equipment'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/equipment/add_equipment_view', $data)
            .view('include/foot_view');
    }

    public function edit($id = null)
    {
        $data = ['title' => 'Edit Equipment', 'id' => $id];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/equipment/edit_equipment_view', $data)
            .view('include/foot_view');
    }

    public function view($id = null)
    {
        $data = ['title' => 'View Equipment', 'id' => $id];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/equipment/view_equipment_view', $data)
            .view('include/foot_view');
    }

    public function deactivate($id = null)
    {
        $data = ['title' => 'Deactivate Equipment', 'id' => $id];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/equipment/deactivate_equipment_view', $data)
            .view('include/foot_view');
    }
}
