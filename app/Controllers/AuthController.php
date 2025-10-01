<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pengguna;

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

        $userModel = new Pengguna();
        $user = $userModel->getUserByUsername($this->request->getPost('username'));

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            $session->set([
                'email' => $user['email'],
                'id_pengguna' => $user['id_pengguna'],
                'username' => $user['username'],
                'nama_depan' => $user['nama_depan'],
                'nama_belakang' => $user['nama_belakang'],
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
