<?= $this->extend('DashboardCompany/DashboardLayout') ?>

<?= $this->section('content') ?>
<div class="container dashboard-home-company">
    <a class="btn mt-5" href="/dashboard_company">Back</a>
    <div class="mt-2">
        <iframe style="min-height: 100vh" class="w-100" src="/<?= $viewCV ?>" frameborder="0"></iframe>
    </div>
</div>
<?= $this->endSection() ?>

