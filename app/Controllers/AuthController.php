<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
      public function login()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('login', $data);
    }

    public function authenticate()
    {
        $session = session();
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/login')->withInput();
        }

        $userModel = new UserModel();
        $user = $userModel->getUserByUsername($this->request->getPost('username'));

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'fullname' => $user['fullname'],
                'role' => $user['role'],
                'isLoggedIn' => true,
            ]);
            return redirect()->to('/dashboard');
        }

        $session->setFlashdata('error', 'Invalid username or password');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
