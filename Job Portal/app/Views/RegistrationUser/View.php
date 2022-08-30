<?= $this->extend('LayoutHome/LayoutHomeView') ?>

<?= $this->section('content') ?>
    <div class="registration-view p-2">
        <div class="row">
            <div class="col-11 col-sm-8 col-md-5 view mt-3 mx-auto">
                <div class="description">
                    <h3>Kandidat Daftar</h3>
                    <p>Temukan lowongan sesuai gaji Anda</p>
                    <div class="button d-grid justify-content-center mb-2">
                        <a class="btn-facebook" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-white bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                            </svg>
                            Masuk dengan Facebook
                        </a>
                    </div>
                    <small>Sangat mudah dan cepat. Kami tidak akan mengunggah apapun tanpa izin dari Anda</small>
                </div>

                <div class="form-registration">
                    <div class="line d-flex">
                        <div class="line-one"></div>
                        Atau
                        <div class="line-two"></div>
                    </div>
                    <?php if (session()->getFlashdata('successSignUp')) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('successSignUp') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <form action="/signupUser" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control <?= session()->getFlashdata('username') ? 'is-invalid' : '' ?>" placeholder="Username" value="<?= old('username') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= session()->getFlashdata('username') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="email" class="form-control <?= session()->getFlashdata('email') ? 'is-invalid' : '' ?>" placeholder="Email" value="<?= old('email') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= session()->getFlashdata('email') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="nama" class="form-control <?= session()->getFlashdata('nama') ? 'is-invalid' : '' ?>" placeholder="Nama" value="<?= old('nama') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= session()->getFlashdata('nama') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="handphone" class="form-control <?= session()->getFlashdata('handphone') ? 'is-invalid' : '' ?>" placeholder="Handphone" value="<?= old('handphone') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= session()->getFlashdata('handphone') ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control <?= session()->getFlashdata('password') ? 'is-invalid' : '' ?>" placeholder="Password">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= session()->getFlashdata('password') ?>
                            </div>
                        </div>
                        <div class="mb-3 d-flex align-items-center gap-2">
                            <div class="profile-images">
                                <img src="<?= base_url() ?>/img/profile/user.png" class="img-thumbnail profile-thumbnail" alt="Photo Profile">
                            </div>
                            <input name="photo_profile" class="form-control input-photo-profile <?= session()->getFlashdata('photo_profile') ? 'is-invalid' : '' ?>" type="file">

                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= session()->getFlashdata('photo_profile') ?>
                            </div>
                        </div>
                        <div class="button-two mb-3">
                            <button type="submit" class="btn btn-daftar">Daftar</button>
                        </div>
                        <div class="mb-3 text-center">
                            <p>Sudah menjadi anggota? <a class="text-decoration-none" href="<?= base_url() ?>/login_user">Masuk sekarang</a></p>

                            <p>
                                Dengan memilih "Daftar Sekarang",
                                saya telah membaca dan menyetujui Persyaratan penggunaan
                                <a class="text-decoration-none" href="#">JobStreet.com</a> dan <a class="text-decoration-none" href="#">Kebijakan privasi</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
