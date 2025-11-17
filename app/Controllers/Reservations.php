<?php

namespace App\Controllers;

class Reservations extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Reservations'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reservations/reservations_table_view', $data)
            .view('include/foot_view');
    }

    public function reserve()
    {
        $data = ['title' => 'Reserve Equipment'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reservations/reserve_view', $data)
            .view('include/foot_view');
    }

    public function manage()
    {
        $data = ['title' => 'Manage Reservations'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reservations/manage_reservations_view', $data)
            .view('include/foot_view');
    }
}
