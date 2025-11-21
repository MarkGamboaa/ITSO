<?php

namespace App\Controllers;

class Products extends BaseController
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

        $data = array(
            'title' => 'Products List',
        );
        
        return view('include/head_view', $data)
             . view('include/nav_view', $data)
             . view('products_table_view', $data)
             . view('include/foot_view', $data);
    }
    
    public function add()
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = [
            'title' => 'Add New Product',
        ];
        
        return view('include/head_view', $data)
             . view('include/nav_view', $data)
             . view('add_product_view', $data)
             . view('include/foot_view', $data);
    }
    
    public function edit($id = null)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = [
            'title' => 'Edit Product',
            'id' => $id
        ];
        
        return view('include/head_view', $data)
             . view('include/nav_view', $data)
             . view('edit_product_view', $data)
             . view('include/foot_view', $data);
    }
    
    public function view($id = null)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = [
            'title' => 'View Product',
            'id' => $id
        ];
        
        return view('include/head_view', $data)
             . view('include/nav_view', $data)
             . view('view_product_view', $data)
             . view('include/foot_view', $data);
    }
}