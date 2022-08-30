<?php

namespace App\Controllers;

class RegistrationCompany extends BaseController
{
    private $validation;
    private $companyModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->companyModel = new \App\Models\CompanyModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Pasang Iklan Lowongan Kerja Gratis | JobStreet Employer ID'
        ];
        return view('RegistrationCompany/View', $data);
    }

    public function registrationCompany() {
        $this->validation->setRules(
            [
                'email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email|is_unique[company.emailCompany]',
                    'errors' => [
                        'required' => 'Kolom Wajib Diisi',
                        'valid_email' => '{field} tidak valid',
                        'is_unique' => '{field} sudah terdaftar'
                    ],
                ],
                'noHp' => [
                    'label'  => 'No. Handphone',
                    'rules'  => 'required|is_natural',
                    'errors' => [
                        'required' => 'Kolom Wajib Diisi',
                        'is_natural' => 'Tidak boleh selain angka',
                    ],
                ],
                'namaBisnis' => [
                    'label'  => 'Nama Bisnis',
                    'rules'  => 'required|alpha_numeric_punct|min_length[3]|is_unique[company.namaCompany]',
                    'errors' => [
                        'required' => 'Kolom Wajib Diisi',
                        'alpha_numeric_punct' => 'Kolom tidak Valid',
                        'min_length' => 'Kolom minimal 3 character',
                        'is_unique' => 'Nama sudah dipakai'
                    ],
                ],
                'alamatBisnis' => [
                    'label'  => 'Alamat Bisnis',
                    'rules'  => 'required|string|min_length[8]',
                    'errors' => [
                        'required' => 'Kolom Wajib Diisi',
                        'string' => 'Kolom tidak Valid',
                        'min_length' => 'Kolom minimal 8 character',
                    ],
                ],
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'required|string|min_length[8]|max_length[20]',
                    'errors' => [
                        'required' => 'Kolom Wajib Diisi',
                        'string' => 'Kolom tidak Valid',
                        'min_length' => 'Kolom minimal 8 character',
                        'max_length' => 'Maksimal minimal 20 character',
                    ],
                ],
                'logoPerusahaan' => [
                    'label'  => 'Logo Perusahaan',
                    'rules'  => 'uploaded[logoPerusahaan]|max_size[logoPerusahaan,2048]|mime_in[logoPerusahaan,image/png,image/jpg,image/jpeg]|ext_in[logoPerusahaan,png,jpg,jpeg]|is_image[logoPerusahaan]',
                    'errors' => [
                        'uploaded' => 'Kolom wajib diisi',
                        'max_size' => 'Maksimal 2MB',
                        'mime_in' => 'Harus gambar',
                        'ext_in' => 'Harus gambar',
                        'is_image' => 'Harus gambar',
                    ],
                ],
            ]
        );
        if ($this->validation->withRequest($this->request)->run()) {
            $timeToday = new \DateTime();
            $profileCOmpany = $this->request->getFile('logoPerusahaan');
            $nameProfileCompany =  $profileCOmpany->getRandomName();

            $data = [
                'idCompany' => 'COMPANY - ' . $timeToday->format('YmdHis.u'),
                'profileCompany' => 'img/company_profile/' . $nameProfileCompany,
                'namaCompany' => $this->request->getPost('namaBisnis'),
                'emailCompany' => $this->request->getPost('email'),
                'passwordCompany' => password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
                'handphoneCompany' => $this->request->getPost('noHp'),
                'alamat' => $this->request->getPost('alamatBisnis', FILTER_SANITIZE_STRING)
            ];

            try {
                $this->companyModel->insert($data);
                if ($this->db->affectedRows()) {
                    $movePictureProfile = $profileCOmpany->move('img/company_profile',$nameProfileCompany);
                    if ($movePictureProfile) {
                        return redirect()->back()->with('success', 'Selamat akun perusahaan berhasil dibuat silahkan coba');
                    } else {
                        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                    }
                }
            } catch (\ReflectionException $e) {
            }
        } else {
            $errorMessage = [
                'email' => $this->validation->getError('email'),
                'namaBisnis' => $this->validation->getError('namaBisnis'),
                'noHp' => $this->validation->getError('noHp'),
                'alamatBisnis' => $this->validation->getError('alamatBisnis'),
                'password' => $this->validation->getError('password'),
                'logoPerusahaan' => $this->validation->getError('logoPerusahaan'),
            ];

            session()->setFlashdata($errorMessage);
            return redirect()->back()->withInput();
        }
    }
}
