<?php

namespace App\Controllers;

class LoginUser extends BaseController
{
    private $userModel;
    private $validation;

    public function __construct()
    {
        $this->validation =  \Config\Services::validation();
        $this->validation->setRules([
            'username' => [
                'label'  => 'Username',
                'rules'  => 'required|alpha_numeric|min_length[3]|max_length[20]',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'alpha_numeric' => '{field} harus kombinasi angka dan huruf',
                    'min_length' => '{field} minimal 3 karakter',
                    'max_length' => '{field} maksimal 20 karakter',
                ],
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required|alpha_numeric|min_length[8]|max_length[20]',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'alpha_numeric' => '{field} harus berupa huruf / angka',
                    'min_length' => '{field} minimal 8 karakter',
                    'max_length' => '{field} maksimal 20 karakter',
                ],
            ],
        ]);
        $this->userModel = new \App\Models\UserModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Pasang Iklan Lowongan Kerja Gratis | JobStreet Employer ID'
        ];

        return view('loginUser/View', $data);
    }

    public function loginUser() {
        if ($this->validation->withRequest($this->request)->run()) {
            $user = $this->userModel->where('username', $this->request->getPost('username'))->first();

            if (!empty($user)) {
                $passwordString = $this->request->getPost('password');
                $passwordVerify = $user['password'];
                if (!password_verify($passwordString, $passwordVerify)) {
                    session()->setFlashdata('password', 'Password salah');
                } else {
                    session()->set([
                        'idUser' => $user['idUser'],
                        'nama' => $user['nama']
                    ]);
                    return redirect()->to('/job');
                }
            } else {
                session()->setFlashdata('username', 'Username tidak ditemukan');
            }
        } else {
            session()->setFlashdata([
               'username' => $this->validation->getError('username'),
               'password' => $this->validation->getError('password'),
            ]);
        }
        return redirect()->back()->withInput();
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/job');
    }
}

