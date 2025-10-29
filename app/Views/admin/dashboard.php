<?php $this->extend('layouts/admin') ?>

<?php $this->section('title') ?><?php $title ?><?php $this->endSection() ?>

<?php $this->section('main') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<p>Selamat datang di dashboard <?= $user->username ?>!</p>

<?= $this->endSection() ?>