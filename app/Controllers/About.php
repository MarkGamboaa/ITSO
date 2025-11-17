<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index()
    {
        $data = ['title' => 'About'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/about/about_view', $data)
            .view('include/foot_view');
    }
}
