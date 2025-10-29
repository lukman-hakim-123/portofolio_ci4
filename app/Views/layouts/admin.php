<?= $this->extend('layouts/base'); ?>

<?php $this->section('pageStyles') ?>

<link rel="stylesheet" href="<?= base_url('css/dashboard.css') ?>">

<?php $this->endSection() ?>

<?= $this->section('body'); ?>

<?= $this->include('component/header_admin'); ?>

<div class="container-fluid">
    <div class="row">
        <?= $this->include('component/sidebar_admin'); ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 bg-white">
            <?= $this->renderSection('main'); ?>
        </main>
    </div>
</div>

<?= $this->endSection() ?>
<?php $this->section('pageScripts') ?>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="<?= base_url('js/dashboard.js') ?>"></script>

<?php $this->endSection() ?>