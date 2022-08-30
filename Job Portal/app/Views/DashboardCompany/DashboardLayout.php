<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/css/dashboard-company.css" rel="stylesheet">

    <title><?= $title ?></title>
</head>
<body style="background-color: rgb(247,248,251)">
<?= $this->include('DashboardCompany/Navbar/Navbar') ?>
<?= $this->renderSection('content') ?>
<script src="<?= base_url() ?>/js/dashboardCompany.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
