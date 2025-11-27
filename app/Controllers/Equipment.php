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
        $equipmentModel = model('Equipment_model'); 
        $equipment = $equipmentModel->findAll();    
        
        $data = [
            'title' => 'Equipment',
            'equipment' => $equipment
        ];
        
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

        $equipmentModel = model('Equipment_model');
        $equipment = $equipmentModel->find($id);

        if (!$equipment) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Equipment not found");
        }

        $data = [
            'title'     => 'Edit Equipment',
            'equipment' => $equipment
        ];

        return view('include/head_view', $data)
            . view('include/nav_view')
            . view('ITSO/equipment/edit_equipment_view', $data)
            . view('include/foot_view');
    }

    
    public function update($id = null)
    {
        $equipmentModel = model('Equipment_model');
        $session = session();
        $validation = service('validation');

        // Fetch existing equipment
        $equipment = $equipmentModel->find($id);
        if (!$equipment) {
            $session->setFlashdata('errors', ['Equipment not found']);
            return redirect()->to(base_url('equipment'));
        }

        $new_total = (int)$this->request->getPost('count');
        $borrowed = $equipment['total_count'] - $equipment['available_count'];
        $new_available = $new_total - $borrowed;
        if ($new_available < 0) $new_available = 0;

        $data = [
            'name' => $this->request->getPost('name'),
            'total_count' => $new_total,
            'available_count' => $new_available,
            'accessories' => $this->request->getPost('accessories') ?? ''
        ];

        if (!$validation->run($data, 'equipment_update')) {
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('equipment/edit/' . $id))->withInput();
        }

        // Clear rules and update
        $equipmentModel->setValidationRules([]);
        $equipmentModel->update($id, $data);

        $session->setFlashdata('msg', 'Equipment updated successfully');
        return redirect()->to(base_url('equipment'));
}


    public function view($id = null)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }

        $equipmentModel = model('Equipment_model');
        $equipment = $equipmentModel->find($id);

        if (!$equipment) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Equipment not found");
        }

        $data = [
            'title'     => 'View Equipment',
            'equipment' => $equipment
        ];

        return view('include/head_view', $data)
            . view('include/nav_view')
            . view('ITSO/equipment/view_equipment_view', $data)
            . view('include/foot_view');
    }

    public function deactivate($id = null)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        
        $equipmentmodel = model('Equipment_model');
        $session = session();
        
        // Handle POST request for deactivation
        if ($this->request->getMethod() === 'post') {
            $equipment = $equipmentmodel->find($id);
            
            if ($equipment) {
                $equipmentmodel->update($id, ['is_active' => 0]);
                $session->setFlashdata('success', 'Equipment deactivated successfully.');
            } else {
                $session->setFlashdata('errors', ['general' => 'Equipment not found.']);
            }
            
            return redirect()->to(base_url('equipment'));
        }
        
        // For GET request, redirect to equipment list (modal will handle confirmation)
        return redirect()->to(base_url('equipment'));
    }
    public function insert(){
        $equipmentmodel = model('Equipment_model');
        $session = session();
        $validation = service('validation');

    $data = array (
        'name'    => $this->request->getPost('name'),
        'total_count'   => $this->request->getPost('count'),
        'available_count'   => $this->request->getPost('count'),
        'accessories'   => $this->request->getPost('accessories') ?? '',
        'is_active'       => 1,
    );

    if (!$validation->run($data, 'equipment')) {
        $session->setFlashdata('errors', $validation->getErrors());
        return redirect()->to(base_url('equipment/add'))->withInput();
    }

    $equipmentmodel->insert($data);

    $session->setFlashdata('msg', 'Equipment added successfully');
    return redirect()->to(base_url('equipment'));

         }
}
