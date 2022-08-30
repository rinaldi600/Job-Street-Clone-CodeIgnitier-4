<?php

namespace App\Controllers;


class CompanyDashboard extends BaseController
{
    private $companyModel;
    private $data;
    private $validation;
    private $jobDeskModel;
    private $cvModel;

    public function __construct()
    {
        $this->companyModel = new \App\Models\CompanyModel();
        $this->validation = \Config\Services::validation();
        $this->jobDeskModel = new \App\Models\JobDeskModel();
        $this->cvModel = new \App\Models\CVModel();
        $this->db = \Config\Database::connect();
        $this->data = [
            'title' => 'Dashboard Company',
            'companyDetail' => $this->companyModel->where('idCompany', session()->get('id_company'))->first()
        ];
    }

    public function index()
    {
        $this->data['listJob'] = $this->jobDeskModel->where('idCompany', session()->get('id_company'))->findAll();
        return view('DashboardCompany/Home/HomeView', $this->data);
    }

    public function changeDescription($idJob) {
        $this->data['detailJobDesk'] = $this->jobDeskModel->where('idJob', $idJob)->first();
        return view('DashboardCompany/ChangeLowongan/View', $this->data);
    }

    public function changeLowongan() {
        $this->validation->setRules([
            'namaLowongan' => [
                'label'  => 'Nama Lowongan',
                'rules'  => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => '{field} wajib diisi',
                    'alpha_numeric_space' => 'tidak boleh mengandung selain huruf dan angka',
                ],
            ],
            'deskripsi' => [
                'label'  => 'Deskripsi',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi',
                ],
            ],
        ]);
        if ($this->validation->withRequest($this->request)->run()) {
            $idJob = $this->request->getPost('idJob');
            $nameLowongan = $this->request->getPost('namaLowongan');
            $descriptionLowongan = $this->request->getPost('deskripsi');

            try {
                $data = [
                    'namaJob' => $nameLowongan,
                    'deskripsiJob' => $descriptionLowongan
                ];

                $this->jobDeskModel->where('idJob', $idJob)->set($data)->update();

                if ($this->db->affectedRows()) {
                    return redirect()->to('/dashboard_company')->with('successUpdate','Data berhasil diupdate');
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } catch (\ReflectionException $e) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            session()->setFlashdata([
                'namaLowongan' => $this->validation->getError('namaLowongan'),
                'deskripsi' => $this->validation->getError('deskripsi'),
            ]);
            return redirect()->back()->withInput();
        }
    }

    public function logoutCompany() {
        if (session()->has('id_company')) {
            unset($_SESSION['id_company']);
            return redirect()->to('/login_company');
        }
    }

    public function deleteLowongan() {
        $idJob = $this->request->getPost('idJob');
        $this->jobDeskModel->where('idJob', $idJob)->delete();

        if ($this->db->affectedRows()) {
            return redirect()->to('/dashboard_company')->with('successDelete','Data berhasil dihapus');
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function pelamarLowongan($idJob, $namaJob) {
        $this->data['listPelamar'] = $this->cvModel->join('user','user.idUser = cv.idUser')
            ->join('job_desk','job_desk.idJob = cv.idJob')
            ->join('resume','resume.idResume = cv.idResume')
            ->where('cv.idJob',$idJob)->findAll();
        return view('DashboardCompany/PelamarJob/PelamarjobView', $this->data);
    }

    public function downloadCV() {
        $getAddressCV = $this->cvModel->join('resume','resume.idResume = cv.idResume')
            ->where('idCV', $this->request->getPost('idCV'))->first()['addressCVPDF'];
        return $this->response->download($getAddressCV,null);
    }

    public function viewCV($idCV) {
        $getAddressCV = isset($this->cvModel->join('resume','resume.idResume = cv.idResume')
            ->where('idCV', $idCV)->first()['addressCVPDF']) ? $this->cvModel->join('resume','resume.idResume = cv.idResume')
            ->where('idCV', $idCV)->first()['addressCVPDF'] : 'DATA TIDAK DITEMUKAN';
        $this->data['viewCV'] = $getAddressCV;
        return view('DashboardCompany/ViewCV/View', $this->data);
    }

    public function createLowongan() {
        return view('DashboardCompany/CreateLowongan/CreateView', $this->data);
    }

    public function previewJob($seg1, $seg2) {
        $query = [
            'idCompany' => session()->get('id_company'),
            'idJob' => $seg1
        ];
        $this->data['detailJob'] = $this->jobDeskModel->where($query)->first();
        return view('DashboardCompany/PreviewJob/PreviewJobView', $this->data);
    }

    public function getLowongan() {
        $this->validation->setRules([
            'namaLowongan' => [
                'label'  => 'Nama Lowongan',
                'rules'  => 'required|alpha_numeric_space',
                'errors' => [
                    'required' => '{field} wajib diisi',
                    'alpha_numeric_space' => 'tidak boleh mengandung selain huruf dan angka',
                ],
            ],
            'deskripsi' => [
                'label'  => 'Deskripsi',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi',
                ],
            ],
        ]);

        if ($this->validation->withRequest($this->request)->run()) {
            $namaLowongan = $this->request->getPost('namaLowongan');
            $deskripsi = $this->request->getPost('deskripsi');

            try {
                $this->jobDeskModel->insert([
                    'idJob' => 'JOB - ' . uniqid(),
                    'idCompany' => session()->get('id_company'),
                    'namaJob' => $namaLowongan,
                    'deskripsiJob' => $deskripsi
                ]);

                if ($this->db->affectedRows()) {
                    return redirect()->to('/dashboard_company')->with('success','Data berhasil ditambahkan');
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }

            } catch (\ReflectionException $e) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }


        } else {
            session()->setFlashdata([
                'namaLowongan' => $this->validation->getError('namaLowongan'),
                'deskripsi' => $this->validation->getError('deskripsi'),
            ]);
            return redirect()->back()->withInput();
        }
    }
}