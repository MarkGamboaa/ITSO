<?php

namespace App\Controllers;

class Reports extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Reports'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reports/reports_view', $data)
            .view('include/foot_view');
    }

    public function activeEquipment()
    {
        $data = ['title' => 'Active Equipment Report'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reports/report_active_equipment_view', $data)
            .view('include/foot_view');
    }

    public function unusableEquipment()
    {
        $data = ['title' => 'Unusable Equipment Report'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reports/report_unusable_equipment_view', $data)
            .view('include/foot_view');
    }

    public function userHistory()
    {
        $data = ['title' => 'User History Report'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/reports/report_user_history_view', $data)
            .view('include/foot_view');
    }
}
