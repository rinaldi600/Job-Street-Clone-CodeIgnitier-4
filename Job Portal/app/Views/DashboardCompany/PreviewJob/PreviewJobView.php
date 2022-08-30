<?= $this->extend('DashboardCompany/DashboardLayout') ?>

<?= $this->section('content') ?>
<div class="container dashboard-preview-job-company">
    <div class="bg-preview-job p-2 d-block position-relative container">
        <div class="overlay-bg"></div>
        <div class="position-absolute">
            <a class="btn mt-3" href="/dashboard_company">Back</a>
        </div>
        <div class="header-preview-job bg-white p-2 rounded-1">
            <div class="mb-2">
                <img class="rounded-circle" style="max-width: 50px; max-height: 50px" src="/<?= $companyDetail['profileCompany'] ?>" alt="">
                <span class="align-middle fw-bold">PT. Anugrah Jaya Abadi</span>
            </div>
            <span class="mt-4 fs-5 d-block">Front End Developer</span>
            <?php require_once(APPPATH . 'CustomFunctions/TimeAgo.php')?>
            <span style="font-size: 0.8rem" class="fw-normal"><?= 'Posted ' . facebook_time_ago($detailJob['updated_at']) ?></span>
        </div>
    </div>

    <div class="body-preview-job bg-white p-2">
        <div class="detail-description">
            <?= $detailJob['deskripsiJob'] ?>
        </div>
    </div>
</div>

<div class="footer-preview-job bg-white">
    <div class="link-detail container">
        <div style="padding-bottom: 25px; border-bottom: 2px solid rgb(210,215,223)" class="row bg-white">
            <div class="col-6 col-md-3">
                <ul style="list-style-type: none">
                    <li>
                        <h5 class="mb-4 mt-5">Job seekers</h5>
                    </li>
                    <li>
                        <a href="#">Jobs by specialization</a>
                    </li>
                    <li>
                        <a href="#">Jobs by company name</a>
                    </li>
                    <li>
                        <a href="#">Safe job search guide</a>
                    </li>
                    <li>
                        <a href="#">Career resources</a>
                    </li>
                    <li>
                        <a href="#">Testimonials</a>
                    </li>
                    <li>
                        <a href="#">Download apps</a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md-3">
                <ul style="list-style-type: none">
                    <li>
                        <h5 class="mb-4 mt-5">Employers</h5>
                    </li>
                    <li>
                        <a href="#">Post a job ad</a>
                    </li>
                    <li>
                        <a href="#">Search for resumes</a>
                    </li>
                    <li>
                        <a href="#">Advertise with us</a>
                    </li>
                    <li>
                        <a href="#">Company profiles</a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md-3">
                <ul style="list-style-type: none">
                    <li>
                        <h5 class="mb-4 mt-5">About JobStreet</h5>
                    </li>
                    <li>
                        <a href="#">About us</a>
                    </li>
                    <li>
                        <a href="#">News & events</a>
                    </li>
                    <li>
                        <a href="#">Career @ JobStreet</a>
                    </li>
                    <li>
                        <a href="#">International partners</a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md-3">
                <ul style="list-style-type: none">
                    <li>
                        <h5 class="mb-4 mt-5">Contact</h5>
                    </li>
                    <li>
                        <a href="#">Contact us</a>
                    </li>
                    <li>
                        <a href="#">FAQ</a>
                    </li>
                    <li>
                        <a href="#">Send feedback</a>
                    </li>
                    <li>
                        <a href="#">Social</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row bg-white">
            <div class="col-12 mt-3">
                <ul class="d-flex justify-content-between align-items-center">
                    <li class="d-inline-block">
                        <span style="font-size: 0.8rem" class="fw-bold align-middle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                              <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                              <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                            Indonesia
                        </span>
                    </li>
                    <li class="d-inline-block">
                        <ul>
                            <li class="d-inline-block me-2">
                                <a style="font-size: 0.8rem" href="#">Pernyataan privasi</a>
                            </li>
                            <li class="d-inline-block me-2">
                                <a style="font-size: 0.8rem" href="#">Persyaratan & ketentuan</a>
                            </li>
                            <li class="d-inline-block me-2">
                                <a style="font-size: 0.8rem" href="#">Hak cipta © 2022 JobStreet</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
