<?php
namespace App\Controllers;

class Index extends BaseController {
    public function index() {
        $data = array(
            'title' => 'ITSO - DASHBOARD',
        );

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/main_view', $data)
            .view('include/foot_view');
    }
}
?>