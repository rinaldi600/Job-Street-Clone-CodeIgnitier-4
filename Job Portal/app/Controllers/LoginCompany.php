<?php

namespace App\Controllers;

use App\Models\CompanyModel;

class LoginCompany extends BaseController
{

    private $validation;
    private $companyModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
        $this->companyModel = new \App\Models\CompanyModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pasang Iklan Lowongan Kerja Gratis | JobStreet Employer ID'
        ];

        return view('LoginCompany/View', $data);
    }

    public function loginCompany() {
        $this->validation->setRules(
            [
                'email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email|email_company[email]',
                    'errors' => [
                        'required' => 'Kolom Wajib Diisi',
                        'valid_email' => '{field} tidak valid',
                        'is_unique' => '{field} sudah terdaftar',
                        'email_company' => '{field} tidak ditemukan'
                    ],
                ],
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'required|string|min_length[8]|max_length[20]|check_password[email,password]|',
                    'errors' => [
                        'required' => 'Kolom Wajib Diisi',
                        'string' => 'Kolom tidak Valid',
                        'min_length' => 'Kolom minimal 8 character',
                        'max_length' => 'Maksimal minimal 20 character',
                        'check_password' => '{field} salah',
                    ],
                ],
            ]
        );
        if ($this->validation->withRequest($this->request)->run()) {
            $idCompany = $this->companyModel->where('emailCompany', $this->request->getPost('email'))->first()['idCompany'];
            session()->set('id_company', $idCompany);
            return redirect()->to('/dashboard_company');
        } else {
            session()->setFlashdata([
               'email' => $this->validation->getError('email'),
               'password' => $this->validation->getError('password')
            ]);
            return redirect()->back()->withInput();
        }
    }
}