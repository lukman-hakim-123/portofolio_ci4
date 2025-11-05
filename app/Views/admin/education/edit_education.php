<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?> <?= esc($title) ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="card-body p-4 mt-2">
    <h5 class="mb-3 fw-semibold"><?= esc($title) ?></h5>

    <form action="<?= site_url('admin/pendidikan/update/' . $education['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- Logo Sekolah -->
        <div class="mb-3 d-flex align-items-center">
            <img id="logo-preview"
                src="<?= site_url('images/education/' . $education["logo"]) ?>"
                alt="Logo Preview"
                class="rounded border border-secondary-subtle shadow-sm me-4"
                width="100"
                height="100"
                style="object-fit: cover;">

            <div class="col-md-6">
                <label for="logo" class="form-label fw-semibold">Logo Sekolah / Universitas</label>
                <input type="file" name="logo" id="logo"
                    class="form-control <?= session('errors.logo') ? 'is-invalid' : '' ?>"
                    accept="image/*"
                    onchange="previewLogo(event)">
                <?php if (session('errors.logo')): ?>
                    <div class="invalid-feedback"><?= session('errors.logo') ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Nama Sekolah -->
        <div class="mb-3">
            <label for="institution" class="form-label fw-semibold">Nama Sekolah / Universitas</label>
            <input type="text" name="institution" id="institution"
                class="form-control <?= session('errors.institution') ? 'is-invalid' : '' ?>"
                value="<?= $education["institution"] ?>">
            <?php if (session('errors.institution')): ?>
                <div class="invalid-feedback"><?= session('errors.institution') ?></div>
            <?php endif; ?>
        </div>

        <!-- Jurusan -->
        <div class="mb-3">
            <label for="major" class="form-label fw-semibold">Jurusan / Program Studi</label>
            <input type="text" name="major" id="major"
                class="form-control <?= session('errors.major') ? 'is-invalid' : '' ?>"
                value="<?= $education["major"] ?>">
            <?php if (session('errors.major')): ?>
                <div class="invalid-feedback"><?= session('errors.major') ?></div>
            <?php endif; ?>
        </div>

        <!-- Tahun Mulai & Selesai -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="start_year" class="form-label fw-semibold">Tahun Mulai</label>
                <input type="number" name="start_year" id="start_year"
                    class="form-control <?= session('errors.start_year') ? 'is-invalid' : '' ?>"
                    value="<?= $education["start_year"] ?>" min="1900" max="<?= date('Y') ?>">
                <?php if (session('errors.start_year')): ?>
                    <div class="invalid-feedback"><?= session('errors.start_year') ?></div>
                <?php endif; ?>
            </div>

            <div class="col-md-6 mb-3">
                <label for="end_year" class="form-label fw-semibold">Tahun Selesai</label>
                <input type="number" name="end_year" id="end_year"
                    class="form-control <?= session('errors.end_year') ? 'is-invalid' : '' ?>"
                    value="<?= $education["end_year"] ?>" min="1900" max="<?= date('Y') ?>">
                <?php if (session('errors.end_year')): ?>
                    <div class="invalid-feedback"><?= session('errors.end_year') ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="text-end mt-4 d-flex flex-row-reverse">
            <button type="submit" class="btn btn-primary px-4 d-flex align-items-center justify-content-center">
                <i data-feather="save" class="me-1"></i>
                <span>Update Pendidikan</span>
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('js/education.js') ?>"></script>
<?= $this->endSection() ?>