<?= $this->extend('DashboardUser/DashboardLayout') ?>

<?= $this->section('content') ?>
<div>
    <?php if (!is_null($dataCV)) { ?>
        <div class="col-12 col-lg-8 mt-3">

            <?php if (session()->get('success')) { ?>
                <div class="alert alert-success mt-2" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php } ?>

            <?php if (session()->get('fails')) { ?>
                <div class="alert alert-danger mt-2" role="alert">
                    <?= session()->get('fails') ?>
                </div>
            <?php } ?>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">CV</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="align-middle">
                        <td><?= $dataCV['nama'] ?></td>
                        <td>
                            <form action="/dashboard_user/download_cv" method="post">
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <input type="hidden" name="urlDownloadFile" value="<?= $dataCV['addressCVPDF'] ?>">
                                <button type="submit" class="btn btn-success align-middle d-flex align-items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M7.646 10.854a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 9.293V5.5a.5.5 0 0 0-1 0v3.793L6.354 8.146a.5.5 0 1 0-.708.708l2 2z"/>
                                        <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                                    </svg>
                                    Download CV
                                </button>
                            </form>
                        </td>
                        <td class="d-flex gap-1">
                            <form action="/dashboard_user/delete_cv" method="post">
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <input type="hidden" name="idResume" value="<?= $dataCV['idResume'] ?>">
                                <button onclick="return confirm('Apakah Ingin Menghapus CV Anda Sendiri ?')" type="submit" class="btn btn-danger align-middle d-flex align-items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>

                            <a class="align-middle btn btn-warning d-inline-block" href="/dashboard_user/change_cv/<?= $dataCV['idResume'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                                Ubah
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } else { ?>
        <div class="resume-cv col-6">

            <?php if (session()->get('errorUpload')) { ?>
                <div class="alert alert-danger mt-2" role="alert">
                    <?= session()->get('errorUpload') ?>
                </div>
            <?php } ?>

            <?php if (session()->get('success')) { ?>
                <div class="alert alert-success mt-2" role="alert">
                    <?= session()->get('success') ?>
                </div>
            <?php } ?>

            <form action="/dashboard_user/upload_resume_cv" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <embed class="d-none preview-cv" src="" style="width: 100%; min-height: 400px">
                <div class="mb-3 mt-3">
                    <label for="formFile" class="form-label">Silahkan Upload CV</label>
                    <input type="hidden" name="idUser" value="<?= session()->get('idUser') ?>">
                    <input class="form-control <?= session()->get('error') ? 'is-invalid' : '' ?> input-cv" type="file" id="formFile" name="uploadCV">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= session()->get('error') ?>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <button type="submit" class="btn btn-upload-cv none position-relative">
                        Upload CV
                        <div class="block"></div>
                    </button>
                </div>
            </form>
        </div>
    <?php }  ?>

</div>
<?= $this->endSection() ?>
