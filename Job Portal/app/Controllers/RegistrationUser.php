<?php

namespace App\Controllers;

class RegistrationUser extends BaseController
{

    private $validation;
    private $userModel;

    public function __construct()
    {
        $this->validation =  \Config\Services::validation();
        $this->validation->setRules([
            'username' => [
                'label'  => 'Username',
                'rules'  => 'required|is_unique[user.username]|alpha_numeric|min_length[3]|max_length[20]',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'is_unique' => '{field} Sudah Ada',
                    'alpha_numeric' => '{field} harus kombinasi angka dan huruf',
                    'min_length' => '{field} minimal 3 karakter',
                    'max_length' => '{field} maksimal 20 karakter',
                ],
            ],
            'email' => [
                'label'  => 'Email',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'valid_email' => 'Harus berupa format email',
                ],
            ],
            'nama' => [
                'label'  => 'Nama',
                'rules'  => 'required|alpha_space',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'alpha_space' => '{field} tidak boleh mengandung selain huruf dan spasi',
                ],
            ],
            'handphone' => [
                'label'  => 'Handphone',
                'rules'  => 'required|is_natural',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'is_natural' => '{field} harus berupa angka',
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
            'photo_profile' => [
                'label'  => 'Photo',
                'rules'  => 'uploaded[photo_profile]|max_size[photo_profile,2048]
                |is_image[photo_profile]|ext_in[photo_profile,png,jpg,jpeg]
                |mime_in[photo_profile,image/png,image/jpg,image/png,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} wajib diisi',
                    'max_size' => '{field} maksimal 2 MB',
                    'is_image' => '{field} harus berupa image',
                    'ext_in' => '{field} harus format png / jpg / jpeg',
                ],
            ],
        ]);
        $this->userModel = new \App\Models\UserModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Mendaftar atau masuk untuk melamar lowongan @ JobStreet.com'
        ];

        return view('RegistrationUser/View', $data);
    }
    public function signupUser() {
        if ($this->validation->withRequest($this->request)->run()) {
            $photoProfile = $this->request->getFile('photo_profile');
            $randomName = $photoProfile->getRandomName();
            $data = [
                'idUser' => 'USER - ' . uniqid(),
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'nama' => $this->request->getPost('nama'),
                'handphone' => $this->request->getPost('handphone'),
                'photo_profile' => 'img/user_profile/' . date('d-F-Y H-i-s.u', time()) . '/' . $randomName,
            ];
            try {
                $this->userModel->insert($data);
                if ($this->db->affectedRows()) {
                    $photoProfile->move('img/user_profile/' . date('d-F-Y H-i-s.u', time()), $randomName);
                    return redirect()->back()->with("successSignUp",'Anda Berhasil Mendaftar');
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } catch (\ReflectionException $e) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

        } else {
            session()->setFlashdata([
                'username' => $this->validation->getError('username'),
                'email' => $this->validation->getError('email'),
                'nama' => $this->validation->getError('nama'),
                'handphone' => $this->validation->getError('handphone'),
                'password' => $this->validation->getError('password'),
                'photo_profile' => $this->validation->getError('photo_profile'),
            ]);
            return redirect()->back()->withInput();
        }
    }
}
