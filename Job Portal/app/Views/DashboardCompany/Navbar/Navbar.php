<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand" href="/dashboard_company">
            <img src="<?= base_url() ?>/icons/jobstreet-logo.png" style="max-width: 40%; max-height: 40%" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link align-items-center d-flex dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="rounded-circle d-inline-block" style="width: 32px; height: 32px" src="<?= base_url() ?>/<?= $companyDetail['profileCompany'] ?>" alt="">
                            <span class="d-inline-block align-middle mx-2"><?= $companyDetail['namaCompany'] ?></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="mx-auto">
                                <form class="text-center mx-auto" action="/logout_company" method="post">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-danger text-center" type="submit">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/dashboard_company">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Pelamar</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>