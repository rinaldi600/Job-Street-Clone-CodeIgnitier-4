<?= $this->extend('DashboardCompany/DashboardLayout') ?>

<?= $this->section('content') ?>
<div class="container dashboard-home-company">
    <a class="btn mt-5" href="/dashboard_company">Back</a>
    <div class="table-responsive col-8 mt-3">
        <table class="table">
            <thead style="background-color: rgb(243,244,245)">
            <tr class="text-center" style="color: rgb(126,129,132)">
                <th scope="col">Pelamar</th>
                <th scope="col">Handphone</th>
                <th scope="col">CV</th>
            </tr>
            </thead>
            <tbody>
            <?php if (count($listPelamar) <= 0) { ?>
                <td class="text-center" colspan="2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-frown" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
                    </svg>
                    Belum Ada Pelamar
                </td>
            <?php } else { ?>
                <?php foreach ($listPelamar as $pelamar) { ?>
                    <tr class="text-center">
                        <td><?= $pelamar['nama'] ?></td>
                        <td><?= $pelamar['handphone'] ?></td>
                        <td>
                            <form class="d-inline-block" action="/dashboard_company/download_cv" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="idCV" value="<?= $pelamar['idCV'] ?>">
                                <button onclick="return confirm('Apakah anda ingin melihat cv ini ?')" class="btn btn-success">Download CV</button>
                            </form>
                            <a style="background-color: rgb(255,193,7) !important;" class="btn text-dark d-inline-block" href="/dashboard_company/view_cv/<?= $pelamar['idCV'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                                Lihat CV
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>

