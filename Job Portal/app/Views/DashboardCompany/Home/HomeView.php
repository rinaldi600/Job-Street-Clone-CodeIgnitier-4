<?= $this->extend('DashboardCompany/DashboardLayout') ?>

<?= $this->section('content') ?>
    <div class="container dashboard-home-company">
        <a class="btn mt-5" href="/dashboard_company/create_lowongan">Tambah Lowongan</a>
        <?php if ($message = session()->getFlashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible fade show col-6 mt-3" role="alert">
                <strong>Selamat!</strong> <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php if ($message = session()->getFlashdata('successUpdate')) { ?>
            <div class="alert alert-success alert-dismissible fade show col-6 mt-3" role="alert">
                <strong>Selamat!</strong> <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php if ($message = session()->getFlashdata('successDelete')) { ?>
            <div class="alert alert-success alert-dismissible fade show col-6 mt-3" role="alert">
                <strong>Selamat!</strong> <?= $message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <div class="table-responsive col-8 mt-3">
            <table class="table">
                <thead style="background-color: rgb(243,244,245)">
                    <tr class="text-center" style="color: rgb(126,129,132)">
                        <th scope="col">Nama Lowongan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($listJob as $job) { ?>
                    <tr class="text-center" style="color: rgb(67,71,75)">
                        <td><?= $job['namaJob'] ?></td>
                        <td>
                            <form action="/deleteLowongan" method="post" class="d-inline-block">
                                <?= csrf_field() ?>
                                <input type="hidden" name="idJob" value="<?= $job['idJob'] ?>">
                                <button onclick="return confirm('Apakah anda ingin menghapus lowongan ini')" type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                            <a style="background-color: rgb(255,193,7)" class="btn btn-warning text-dark" href="/dashboard_company/change_description_job/<?= $job['idJob'] ?>">Ubah</a>
                            <a target="_blank" href="/dashboard_company/view_job/<?= $job['idJob'] ?>/<?= url_title($job['namaJob']) ?>" class="btn btn-primary d-inline-block">Detail</a>
                            <a style="background-color: rgb(25,135,84)" target="_blank" href="/dashboard_company/view_pelamar_job/<?= $job['idJob'] ?>/<?= url_title($job['namaJob']) ?>" class="btn d-inline-block">Lihat Pelamar</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?= $this->endSection() ?>
