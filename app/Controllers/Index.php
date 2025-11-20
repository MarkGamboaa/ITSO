<?php
namespace App\Controllers;

class Index extends BaseController {
    protected function auth()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('auth/login'));
        }
        return null;

    }
    public function index() {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        
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