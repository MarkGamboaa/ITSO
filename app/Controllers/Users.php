<?php
namespace App\Controllers;

class Users extends BaseController {

    protected function auth()
    {
        $session = session();
        if (! $session->get('isLoggedIn') || $session->get('role') !== 'ITSO') {
            return redirect()->to(base_url('auth/login'));
        }
        return null;

    }
    
    public function index() {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }

        // load model and fetch users
        $usermodel = model('Users_model');        

        $data = array (
            'title' => 'Users List',
            'users' => $usermodel->where('email_verified', 1)->paginate(10),
            'pager' => $usermodel->pager
        );
        $usermodel->pager->setPath('users');
        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/userslist_view', $data)
            .view('include/foot_view');
    }

    public function register()
    {   
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $data = ['title' => 'Register User'];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/users_register_view', $data)
            .view('include/foot_view');
    }

    public function insert(){
    $usermodel = model('Users_model');
    $session = session();
    $validation = service('validation');

    $data = array (
        'first_name' => $this->request->getPost('first_name'),
        'last_name'  => $this->request->getPost('last_name'),
        'email'      => strtolower(trim($this->request->getPost('email'))),
        'role'       => $this->request->getPost('role'),
    );

    if (!$validation->run($data, 'user')) {
        $session->setFlashdata('errors', $validation->getErrors());
        return redirect()->to(base_url('users/register'))->withInput(); 
    }

    $data_insert = array(
        'first_name' => $data['first_name'],
        'last_name'  => $data['last_name'],
        'email'      => $data['email'],
        'role'       => $data['role'],
        'token'      => bin2hex(random_bytes(16))
    );

    $message = "<h2>Hello, ".$data['first_name']."</h2><br>
    <p>Your account has been created</p><a href='".base_url()."/auth/verify/".$data_insert['token']."'>Click here to verify your registration</a>";
    
    $email = service('email');
    $email->setTo($data['email']);
    $email->setSubject('Account Registration - Verify your registration');
    $email->setMessage($message);
    
    if(!$email->send()){
        $session->setFlashdata('msg', 'Failed to send verification email. Please try again.');
        return redirect()->to(base_url('users/register')); 
    }
    
    $usermodel->insert($data_insert);
    return redirect()->to(base_url('users')); 
    }

    public function verify($token){
        $usermodel = model('Users_model');
        $session = session();

        $user = $usermodel->where('token', $token)->first();
        if($user){
            $data_update = array(
                'email_verified' => 1,
            );
            $usermodel->update($user['user_id'], $data_update);
            return redirect()->to(base_url('about/')); 
        }
    }

    public function view($user_id = null)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $usermodel = model('Users_model');
        $data = array (
                'title' => 'View User', 
                'user'=>$usermodel->find($user_id)
            );

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/users_view_view', $data)
            .view('include/foot_view');
    }

    public function edit($user_id = null)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $usermodel = model('Users_model');
        $session = session();
        $data = ['title' => 'Edit User', 
                'user' => $usermodel->find($user_id),];

        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/users_edit_view', $data)
            .view('include/foot_view');
    }

    public function update($user_id = null)
    {   
    $check = $this->auth();
    if ($check !== null) {
        return $check;
    }

    $usermodel = model('Users_model');
    $session = session();
    $validation = service('validation');

    $currentUser = $usermodel->find($user_id);
    
    if (!$currentUser) {
        $session->setFlashdata('errors', ['User not found']);
        return redirect()->to(base_url('users/')); 
    }

    $data = array (
        'first_name'    => $this->request->getPost('first_name'),
        'last_name'     => $this->request->getPost('last_name'),
        'email'         => strtolower(trim($this->request->getPost('email'))),
        'role'          => $this->request->getPost('role')
    );

    // Check if email has changed to determine which validation group to use
    if ($data['email'] !== strtolower(trim($currentUser['email']))) {
        // Email changed, check uniqueness
        if (!$validation->run($data, 'user')) {
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('users/edit/' . $user_id)); 
        }
    } else {
        // Email unchanged, use update validation
        if (!$validation->run($data, 'user_update')) {
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('users/edit/' . $user_id)); 
        }
    }
    
    $usermodel->setValidationRules([]);
    $result = $usermodel->update($user_id, $data);
    
    return redirect()->to(base_url('users/')); 
    }

    public function deactivate($id = null)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $usermodel = model('Users_model');
        $user = $usermodel->find($id);
        $data = ['title' => 'Deactivate User', 
                'user' => $user,
                'id' => $id];
        return view('include/head_view', $data)
            .view('include/nav_view')
            .view('ITSO/users/users_deactivate_view', $data)
            .view('include/foot_view');
    }

    public function confirmDeactivate($id = null)
    {
        $check = $this->auth();
        if ($check !== null) {
            return $check;
        }
        $usermodel = model('Users_model');
        $session = session();

        $user = $usermodel->find($id);

        $data_update = array(
            'is_active' => 0
        );

        $usermodel->update($id, $data_update);
        return redirect()->to(base_url('users/')); 
    }
}
?>