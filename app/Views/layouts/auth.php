<?php $this->extend('layouts/base'); ?>

<?php $this->section('body'); ?>
<main role="main" class="container">
    <?= $this->renderSection('main') ?>
</main>
<?php $this->endSection() ?>