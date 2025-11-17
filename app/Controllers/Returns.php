<?php

namespace App\Controllers;

class Returns extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Returns'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/returns/returns_table_view', $data)
            .view('include/foot_view');
    }

    public function process()
    {
        $data = ['title' => 'Process Return'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/returns/process_return_view', $data)
            .view('include/foot_view');
    }
}
