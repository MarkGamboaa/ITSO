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
        $equipmentmodel = model('Equipment_model');
        $equipmentList = $equipmentmodel->where('is_active', '1')->paginate(10);

        $data = ['title' => 'Active Equipment Report',
                 'equipmentList' => $equipmentList,
                 'pager' => $equipmentmodel->pager
                ];
        $equipmentmodel->pager->setPath('reports/activeEquipment');

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
        $equipmentmodel = model('Equipment_model');
        $equipmentList = $equipmentmodel->where('is_active', '0')->where('available_count <=', 0)->paginate(10);
        $data = ['title' => 'Unusable Equipment Report',
                 'equipmentList' => $equipmentList,
                 'pager' => $equipmentmodel->pager
                ];
        $equipmentmodel->pager->setPath('reports/unusableEquipment');

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
    $usermodel = model('Users_model');
    $borrowingmodel = model('BorrowRecords_Model');
    $equipmentmodel = model('Equipment_model');

    $data = ['title' => 'Borrowed User History Report',
            'borrowing' => $borrowingmodel
                ->select('borrow_records.*, users.last_name as user_name, equipment.name as equipment_name, equipment.accessories as accessories')
                ->join('users', 'users.user_id = borrow_records.user_id')
                ->join('equipment', 'equipment.equipment_id = borrow_records.equipment_id')
                ->where('borrow_records.returned_at IS NOT NULL', null, false)
                ->where('borrow_records.status', 'Returned')
                ->paginate(10),
            'pager' => $borrowingmodel->pager 
    ];
    $borrowingmodel->pager->setPath('reports/userHistory');


    return view('include/head_view', $data)
        .view('include/nav_view')
        .view('ITSO/reports/report_user_history_view', $data)
        .view('include/foot_view');
    }
}
