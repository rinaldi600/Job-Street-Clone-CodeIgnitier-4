<?= $this->extend('LayoutHome/LayoutHomeView') ?>

<?= $this->section('content') ?>

    <input type="hidden" class="txt-csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    <div class="job-view">
        <div class="search-bar d-grid align-items-center">
            <div class="box-search">
                <form action="#" method="get">
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <div class="search position-relative d-flex bg-white align-items-center col-12 col-sm-7 p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search ms-1" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                            <input type="text" class="form-control" placeholder="Jabatan, kata kunci, perusahaan">
                        </div>
                        <div class="button col-12 col-sm-4">
                            <button type="button" class="btn-search">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="alert-notifications mx-5">

        </div>

        <div class="list-job col-11 mx-auto">
            <div class="row">
                <div class="col-12 col-lg-4 list">
                    <p class="mt-3"><span class="fw-bold">1-30</span> dari <?= count($jobDesk) ?> lowongan</p>
                    <?php foreach ($jobDesk as $job) {  ?>
                        <div class="card-job d-grid mb-3">
                            <input type="hidden" name="idJob" value="<?= $job['idJob'] ?>">
                            <div class="text mx-3 position-relative">
                                <img style="max-width: 100px; max-height: 50px" src="<?= base_url() ?>/<?= $job['profileCompany'] ?>" alt="" class="img-fluid mt-3 mb-3">
                                <h5 style="font-size: 1rem"><?= $job['namaJob'] ?></h5>
                                <p><?= $job['namaCompany'] ?></p>

                                <p style="font-size: 0.8rem" class="fw-bold"><?= $job['alamat'] ?></p>
                                <?php require_once(APPPATH .'CustomFunctions/TimeAgo.php')?>
                                <p class="card-text position-absolute bottom-0 mb-4"><small class="text-muted"><?= facebook_time_ago($job['created_at']) ?></small></p>
                            </div>
                        </div>
                    <?php }  ?>
                    <div class="bg-transparent">
                        <?= $pager->links('job_desk', 'custom_pagination') ?>
                    </div>
                </div>
                <div class="col-12 col-lg-8 details bg-white">
                    <div class="description d-grid justify-content-center mt-5">
                        <img src="<?= base_url() ?>/icons/2982a5e7e83c56a68c79.png" alt="">
                        <p class="text-center"><span class="fw-bold">Ada <?= count($jobDesk) ?> lowongan untuk kamu</span> <br>
                            Pilih lowongan untuk melihat lebih detil</p>
                    </div>

                    <div class="w-100 detail-job d-none">
                        <div class="w-100 desc-job">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
