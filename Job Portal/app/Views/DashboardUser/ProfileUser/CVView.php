<?= $this->extend('DashboardUser/DashboardLayout') ?>

<?= $this->section('content') ?>
<div>
    <div class="navbar-cv d-flex align-items-center justify-content-center mx-auto">
        <h3>Lamaran Saya</h3>
    </div>
    <?php if ($message = session()->getFlashdata('success')) { ?>
        <div class="alert alert-success col-6" role="alert">
            <?= $message ?>
        </div>
    <?php } ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Pekerjaan</th>
                <th scope="col">Perusahaan</th>
                <th scope="col">CV</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($listMyApplication as $myApplication) { ?>
                <?php if (is_null($myApplication['deleted_at'])) { ?>
                    <tr>
                        <td><?= $myApplication['namaJob'] ?></td>
                        <td><?= $myApplication['namaCompany'] ?></td>
                        <td>
                            <form class="mx-auto" action="/dashboard_user/download_cv" method="post">
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <input type="hidden" name="urlDownloadFile" value="<?= $myApplication['addressCVPDF'] ?>">
                                <button type="submit" class="btn btn-success align-middle d-flex align-items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M7.646 10.854a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 9.293V5.5a.5.5 0 0 0-1 0v3.793L6.354 8.146a.5.5 0 1 0-.708.708l2 2z"/>
                                        <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                                    </svg>
                                    Download CV
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="/dashboard_user/delete_my_application" method="post">
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <input type="hidden" name="idCV" value="<?= $myApplication['idCV'] ?>">
                                <button onclick="return confirm('Apakah anda yakin ingin menghapus lamaran ini ? ')" type="submit" class="btn btn-danger align-middle d-flex align-items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                    Hapus Lamaran
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr class="position-relative">
                        <td class="text-center" colspan="3"><?= $myApplication['namaJob'] ?> ( Sudah tidak tersedia )</td>
                        <td>
                            <form action="/dashboard_user/delete_my_application" method="post">
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                <input type="hidden" name="idCV" value="<?= $myApplication['idCV'] ?>">
                                <button onclick="return confirm('Apakah anda yakin ingin menghapus lamaran ini ? ')" type="submit" class="btn btn-danger align-middle d-flex align-items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                    </svg>
                                    Hapus Lamaran
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php }  ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
