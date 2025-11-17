<?php

namespace App\Controllers;

class Borrowing extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Borrowing'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/borrow/borrowing_table_view', $data)
            .view('include/foot_view');
    }

    public function borrow()
    {
        $data = ['title' => 'Borrow Equipment'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/borrow/borrow_view', $data)
            .view('include/foot_view');
    }

    public function history()
    {
        $data = ['title' => 'Borrowing History'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/borrow/borrowing_history_view', $data)
            .view('include/foot_view');
    }
}
