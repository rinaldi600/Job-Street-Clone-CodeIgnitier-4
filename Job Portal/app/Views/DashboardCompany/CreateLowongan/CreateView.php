<?= $this->extend('DashboardCompany/DashboardLayout') ?>

<?= $this->section('content') ?>
<div class="container dashboard-create-lowongan">
    <a class="btn mt-5 mb-3" href="/dashboard_company">Back</a>
    <form class="col-8" action="/getLowongan" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="namaLowongan" class="form-label">Nama Lowongan</label>
            <input type="text" class="form-control <?= session()->getFlashdata('namaLowongan') ? 'is-invalid' : '' ?>" name="namaLowongan" id="namaLowongan" value="<?= old('namaLowongan') ?? '' ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('namaLowongan') ?? '' ?>
            </div>
        </div>
        <div class="mb-3">
            <textarea name="deskripsi" class="<?= session()->getFlashdata('deskripsi') ? 'is-invalid' : '' ?>" id="editor"><?= old('deskripsi') ?? '' ?></textarea>
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('deskripsi') ?? '' ?>
            </div>
        </div>
        <button class="btn btn-success mt-3" type="submit">Tambah</button>
    </form>
</div>
<script src="<?= base_url() ?>/ckeditor5-build-classic/ckeditor.js" type="text/javascript"></script>
<script src="<?= base_url() ?>/ckfinder/ckfinder.js" type="text/javascript"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            },
        })
        .catch( error => {
            console.error( error );
        } );
</script>
<?= $this->endSection() ?>
