<?php

namespace App\Controllers;

class Reports extends BaseController
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

        $data = ['title' => 'Reports'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reports/reports_view', $data)
            .view('include/foot_view');
    }

    public function activeEquipment()
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'Active Equipment Report'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reports/report_active_equipment_view', $data)
            .view('include/foot_view');
    }

    public function unusableEquipment()
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'Unusable Equipment Report'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reports/report_unusable_equipment_view', $data)
            .view('include/foot_view');
    }

    public function userHistory()
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'User History Report'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reports/report_user_history_view', $data)
            .view('include/foot_view');
    }
}
