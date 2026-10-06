<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        return view('login');
    }
    public function users()
    {
        $model = new UserModel();
        $users = $model->findAll();
        return view('users', ['users' => $users]);
    }

    public function login()
    {
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $check = $model->where('username', $username)->first();

        if ($check) {
            if (password_verify($password, $check['password'])) {
                session()->set([
                    'role' => $check['role'],
                    'userId' => $check['id'],
                    'username' => $check['username'],
                    'isLoggedIn' => true
                ]);

                if ($check['role'] === 'admin') {
                    return redirect()->to('dashboard');
                }

                return redirect()->to('user');
            } else {
                return redirect()->back()->with('message', 'Invalid Credentials');
            }
        }
        return redirect()->back()->with('message', 'User Not Found');
    }

    public function register()
    {
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirmPassword');
        $role = $this->request->getPost('role');

        $check = $model->where('username', $username)->first();

        if ($check) {
            return redirect()->back()->with('message', 'Username is already taken');
        }

        if (password_verify($password, $confirmPassword)) {
            $model->insert([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => $role
            ]);
        } else {
            return redirect()->back()->with('message', 'Password not match!');
        }

        return redirect()->back()->with('message', 'Registered Successfully');
    }
    public function updateUser($id)
    {
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');


        $model->update($id, [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role
        ]);

        return redirect()->back()->with('message', 'Updated Successfully');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
