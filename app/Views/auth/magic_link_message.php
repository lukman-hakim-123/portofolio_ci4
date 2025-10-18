<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?>Link Login<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="container d-flex justify-content-center p-5">
    <div class="card col-12 col-md-5 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-5">Gunakan Link Login</h5>

            <p><b>Silahkan cek email anda</b></p>

            <p>Kami baru saja mengirimkan email yang berisi tautan masuk. Tautan ini hanya berlaku selama <?= setting('Auth.magicLinkLifetime') / 60 ?> menit.</p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>