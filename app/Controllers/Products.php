<?php

namespace App\Controllers;

class Products extends BaseController
{
    public function index()
    {
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