<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="card-body p-4 mt-4">
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session('message') ?></div>
    <?php endif; ?>

    <form action="<?= site_url('admin/profile/update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- Profile Photo -->
        <div class="mb-4 text-center">
            <?php if ($user->image): ?>
                <img id="profile-preview"
                    src="<?= base_url('images/profile/' . $user->image) ?>"
                    alt="Profile"
                    class="rounded-circle mb-3 shadow-sm"
                    width="120" height="120"
                    style="object-fit: cover;">
            <?php else: ?>
                <img id="profile-preview"
                    src="https://via.placeholder.com/120x120?text=No+Image"
                    alt="Profile"
                    class="rounded-circle mb-3 shadow-sm bg-light"
                    width="120" height="120"
                    style="object-fit: cover;">
            <?php endif; ?>

            <div>
                <label class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-camera"></i> Change Photo
                    <input
                        type="file"
                        name="photo"
                        id="photo"
                        class="d-none <?= session('errors.photo') ? 'is-invalid' : '' ?>"
                        accept="image/*">
                </label>

                <?php if (session('errors.photo')): ?>
                    <div class="invalid-feedback d-block mt-1">
                        <?= session('errors.photo') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>


        <!-- Bio -->
        <div class="mb-3">
            <label for="bio" class="form-label fw-semibold">Bio</label>
            <textarea name="bio" id="bio" class="form-control" rows="3" placeholder="Write something about yourself..."><?= esc($user->bio) ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="username" class="form-label fw-semibold">Username</label>
                <input type="text" name="username" id="username" class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>" value="<?= old('username', esc($user->username)) ?>">
                <?php if (session('errors.username')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.username') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input type="email" name="email" id="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" value="<?= old('email', esc($user->email)) ?>">
                <?php if (session('errors.email')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.email') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="linkedin" class="form-label fw-semibold">LinkedIn URL</label>
                <input type="text" name="linkedin" id="linkedin" class="form-control" value="<?= esc($social_links['linkedin'] ?? '') ?>" placeholder="https://linkedin.com/in/username">
            </div>

            <div class="col-md-6 mb-3">
                <label for="github" class="form-label fw-semibold">GitHub URL</label>
                <input type="text" name="github" id="github" class="form-control" value="<?= esc($social_links['github'] ?? '') ?>" placeholder="https://github.com/username">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="twitter" class="form-label fw-semibold">Twitter URL</label>
                <input type="text" name="twitter" id="twitter" class="form-control" value="<?= esc($social_links['twitter'] ?? '') ?>" placeholder="https://twitter.com/username">
            </div>

            <div class="col-md-6 mb-3">
                <label for="website" class="form-label fw-semibold">Personal Website</label>
                <input type="text" name="website" id="website" class="form-control" value="<?= esc($social_links['website'] ?? '') ?>" placeholder="https://yourwebsite.com">
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-save"></i> Save Changes
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('js/profile.js') ?>"></script>
<?= $this->endSection() ?>