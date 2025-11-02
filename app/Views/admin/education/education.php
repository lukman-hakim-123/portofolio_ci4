<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="d-flex justify-content-between align-items-center mb-3 mt-2">
    <h5 class="fw-semibold mb-0">Daftar Pendidikan</h5>
    <a href="<?= site_url('admin/pendidikan/tambah') ?>" class="btn btn-primary d-flex align-items-center">
        <i data-feather="plus" class="me-1"></i> Tambah Pendidikan
    </a>
</div>

<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= esc(session('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <?php if (!empty($educations)): ?>
            <div class="table-responsive">
                <table class="table table-bordered align-middle table-hover mb-0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th scope="col" style="width: 70px;">#</th>
                            <th scope="col" style="width: 80px;">Logo</th>
                            <th scope="col">Sekolah / Universitas</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Tahun</th>
                            <th scope="col" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($educations as $index => $edu): ?>
                            <tr>
                                <td class="text-center"><?= $index + 1 ?></td>
                                <td class="text-center">
                                    <?php if (!empty($edu['logo']) && file_exists(FCPATH . 'images/education/' . $edu['logo'])): ?>
                                        <img src="<?= base_url('images/education/' . esc($edu['logo'])) ?>"
                                            alt="Logo" width="50" height="50"
                                            class="rounded border shadow-sm" style="object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center border"
                                            style="width:50px; height:50px;">
                                            <i data-feather="image" class="text-muted"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($edu['institution']) ?></td>
                                <td><?= esc($edu['major']) ?></td>
                                <td class="text-center">
                                    <?= esc($edu['start_year']) ?> –
                                    <?= $edu['end_year']
                                        ? esc($edu['end_year'])
                                        : '<span class="text-success fw-semibold">Sekarang</span>' ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= site_url('admin/pendidikan/edit/' . $edu['id']) ?>"
                                        class="btn btn-sm btn-warning me-1" title="Edit">
                                        <i data-feather="edit-3"></i>
                                    </a>
                                    <form action="<?= site_url('admin/pendidikan/delete/' . $edu['id']) ?>"
                                        method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            title="Hapus"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted text-center my-3">Belum ada data pendidikan.</p>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>