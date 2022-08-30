<?php

namespace App\Controllers;

use App\Models\UserModel;

class Job extends BaseController
{
    private $jobDeskModel;
    private $resumeModel;
    private $cvModel;
    private $userModel;

    public function __construct()
    {
        $this->jobDeskModel = new \App\Models\JobDeskModel();
        $this->resumeModel = new \App\Models\ResumeModel();
        $this->cvModel = new \App\Models\CVModel();
        $this->db = \Config\Database::connect();
        $this->userModel = new \App\Models\UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Lowongan kerja di Indonesia - Cari Lowongan Kerja - Karier | JobStreet.co.id',
            'jobDesk' => $this->jobDeskModel->join('company','company.idCompany = job_desk.idCompany')->paginate(4,'job_desk'),
            'pager' => $this->jobDeskModel->pager,
            'detailUser' => $this->userModel->where('idUser', session()->get('idUser'))->first(),
        ];
        return view('Job/JobView', $data);
    }

    public function detailJob() {
        $detailJob = $this->jobDeskModel->join('company','company.idCompany = job_desk.idCompany')
            ->where('idJob', $this->request->getPost('idJob'))->first();
        return json_encode(array(
            'data' => $detailJob,
            'success' => 'WORK',
            'csrf_token' => csrf_hash(),
        ));
    }

    public function applyJob() {
        if (session()->get('idUser')) {
            $checkCV = $this->resumeModel->where('idUser', session()->get('idUser'))->first();
            if (empty($checkCV)) {
                return json_encode(array(
                    'idJob' => $this->request->getPost('idJob'),
                    'checkCV' => 'Silahkan Upload CV Anda Terlebih Dahulu',
                    'success' => 'WORK',
                    'csrf_token' => csrf_hash(),
                ));
            } else {
                $checkDuplicateApplyJob = $this->cvModel->where('idUser', session()->get('idUser'))
                    ->where('idJob', $this->request->getPost('idJob'))->first();
                if (empty($checkDuplicateApplyJob)) {
                    try {
                        $this->cvModel->insert([
                            'idCV' => 'CV - ' . uniqid(),
                            'idUser' => session()->get('idUser'),
                            'idJob' => $this->request->getPost('idJob'),
                            'idResume' => $checkCV['idResume']
                        ]);

                        if ($this->db->affectedRows()) {
                            return json_encode(array(
                                'checkCV' => 'Anda Berhasil Melamar Pekerjaan Ini',
                                'success' => 'WORK',
                                'csrf_token' => csrf_hash(),
                            ));
                        } else {
                            return json_encode(array(
                                'checkCV' => 'Coba lagi nanti....',
                                'success' => 'WORK',
                                'csrf_token' => csrf_hash(),
                            ));
                        }
                    } catch (\ReflectionException $e) {
                        return json_encode(array(
                            'checkCV' => $e,
                            'csrf_token' => csrf_hash(),
                        ));
                    }
                } else {
                    return json_encode(array(
                        'checkCV' => 'Maaf Anda Sudah Melamar Pekerjaan Ini',
                        'csrf_token' => csrf_hash(),
                    ));
                }
            }
        } else {
            return json_encode(array(
                'checkCV' => 'Anda Harus Login',
                'csrf_token' => csrf_hash(),
            ));
        }
    }
}
