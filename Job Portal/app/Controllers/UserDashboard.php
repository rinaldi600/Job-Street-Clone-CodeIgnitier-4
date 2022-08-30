<?php

namespace App\Controllers;

use ReflectionException;

class UserDashboard extends BaseController
{

    private $validation;
    private $userModel;
    private $userInfo;
    private $resumeModel;
    private $cvModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->userModel = new \App\Models\UserModel();
        $this->resumeModel = new \App\Models\ResumeModel();
        $this->cvModel = new \App\Models\CVModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (url_is('dashboard_user')) {
            return redirect()->to('/dashboard_user/profile');
        }
    }

    public function user() {
        $data = [
            'title' => 'Dashboard Seeker | JobStreet.co.id',
            'profileUser' => $this->userModel->where('idUser', session()->get('idUser'))->first(),
            'detailUser' => $this->userModel->where('idUser', session()->get('idUser'))->first(),
        ];
        return view('DashboardUser/ProfileUser/ProfileView', $data);
    }

    public function myApplication() {
        $data = [
            'title' => 'Dashboard Seeker | JobStreet.co.id',
            'listMyApplication' => $this->cvModel->join('user','user.idUser = cv.idUser')
                ->join('job_desk','job_desk.idJob = cv.idJob')
                ->join('resume','resume.idResume = cv.idResume')
                ->join('company','company.idCompany = job_desk.idCompany')
                ->where('cv.idUser',session()->get('idUser'))->findAll(),
            'detailUser' => $this->userModel->where('idUser', session()->get('idUser'))->first(),
        ];
        return view('DashboardUser/ProfileUser/CVView', $data);
    }

    public function deleteMyApplication() {
        $this->cvModel->where('idCV', $this->request->getPost('idCV'))->delete();

        if ($this->db->affectedRows()) {
            return redirect()->back()->with('success', 'Lamaran berhasil dihapus');
        }
    }

    public function resumeCV() {
        $data = [
            'title' => 'Dashboard Seeker | JobStreet.co.id',
            'dataCV' => $this->resumeModel->where('resume.idUser', session()->get('idUser'))
                ->join('user', 'user.idUser = resume.idUser')->first(),
            'detailUser' => $this->userModel->where('idUser', session()->get('idUser'))->first(),
        ];
        return view('DashboardUser/ProfileUser/ResumeView', $data);
    }

    public function uploadCV() {
        $this->userInfo = $this->userModel->where('idUser', session()->get('idUser'))->first();
        $this->validation->setRules([
            'uploadCV' => [
                'label'  => 'Upload CV',
                'rules'  => 'uploaded[uploadCV]|max_size[uploadCV,2048]|ext_in[uploadCV,pdf]',
                'errors' => [
                    'uploaded' => 'Kolom wajib diisi',
                    'is_unique' => 'CV sudah ada',
                    'max_size' => 'Maksimal ukuran 2MB',
                    'ext_in' => 'File wajib format pdf'
                ]
            ],
            'idUser' => [
                'label'  => 'ID User',
                'rules'  => 'required|is_unique[cv.idUser]',
                'errors' => [
                    'required' => 'Kolom wajib diisi',
                    'is_unique' => 'File anda sudah ada'
                ],
            ]
        ]);
        if ($this->validation->withRequest($this->request)->run()) {
            $userID = $this->userInfo;
            $fileResumePDF = $this->request->getFile('uploadCV');
            $randomName = $fileResumePDF->getRandomName();

            $data = [
                'idResume' => 'RESUME-' . uniqid(),
                'idUser' => $userID['idUser'],
                'addressCVPDF' => 'cv/' . $randomName,
            ];

            try {
                $this->resumeModel->insert($data);
                if ($this->db->affectedRows()) {
                    $fileResumePDF->move('cv', $randomName);
                    return redirect()->back()->with('success', 'CV Berhasil Di Upload');
                }
            } catch (\mysqli_sql_exception $e) {
                if ($e->getCode() === 1062) {
                    return redirect()->back()->with('errorUpload', 'Maksimal Upload CV 1 File');
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } catch (ReflectionException $e) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

        } else {
            session()->setFlashdata('error', $this->validation->getError('uploadCV'));
            return redirect()->back();
        }
    }

    public function downloadCV() {
        $fileDownload = $this->request->getPost('urlDownloadFile');
        return $this->response->download($fileDownload, null);
    }

    public function deleteCV() {
        $idResume = $this->request->getPost('idResume');
        $deleteFileCV =  $this->resumeModel->where('idResume', $idResume)->first()['addressCVPDF'];
        $checkCV = $this->cvModel->where('idResume', $idResume)->first();
        if (empty($checkCV)) {
            unlink($deleteFileCV);
            $this->resumeModel->where('idResume', $idResume)->delete();
            if ($this->db->affectedRows()) {
                return redirect()->back()->with('success','CV Berhasil Dihapus');
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            return redirect()->back()->with('fails', 'CV sedang digunakan');
        }
    }

    public function changeCV($idResume) {
        $data = [
            'title' => 'Dashboard Seeker | JobStreet.co.id',
            'detailResume' => $this->resumeModel->where('idResume', $idResume)->first(),
            'detailUser' => $this->userModel->where('idUser', session()->get('idUser'))->first(),
        ];
        return view('DashboardUser/ProfileUser/ChangeCV', $data);
    }

    public function getNewCV() {
        $this->validation->setRules([
            'fileNewCv' => [
                'label'  => 'Kolom',
                'rules'  => 'uploaded[fileNewCv]|max_size[fileNewCv,2048]|ext_in[fileNewCv,pdf]|mime_in[fileNewCv,application/pdf]',
                'errors' => [
                    'uploaded' => 'File wajib diupload',
                    'max_size' => 'File maksimal 2MB',
                    'ext_in' => 'File harus pdf',
                    'mime_in' => 'File harus pdf',
                ],
            ],
        ]);
        if ($this->validation->withRequest($this->request)->run()) {
            $addressCV = $this->resumeModel->where('idResume', $this->request->getPost('idResume'))->first()['addressCVPDF'];
            $fileNewCV = $this->request->getFile('fileNewCv');
            $randomName = $fileNewCV->getRandomName();
            try {
                unlink($addressCV);
                $this->resumeModel->where('idResume', $this->request->getPost('idResume'))->set([
                    'addressCVPDF' => 'cv/' . $randomName
                ])->update();
                $fileNewCV->move('cv/', $randomName);
                return redirect()->back()->with('success', 'CV berhasil Diubah');
            } catch (ReflectionException $e) {
                dd($e);
            }
        } else {
            session()->setFlashdata([
               'fileNewCv' => $this->validation->getError('fileNewCv')
            ]);
            return redirect()->back();
        }
    }

    public function getEmail() {
        $verifyUrl = "https://www.google.com/recaptcha/api/siteverify?secret=6LenRqAgAAAAADVz91V1TdG-CnaWXckRsQ9f8KHC&response=" . $this->request->getPost('response');
        $getResponse = file_get_contents($verifyUrl);
        $convertResponse = json_decode($getResponse, true);
        $convertResponse['email'] = $this->userModel->where('idUser', session()->get('idUser'))->first()['email'];
        return $convertResponse['score'] >= 0.5 ? json_encode($convertResponse) : json_encode("FAILS");
    }
}