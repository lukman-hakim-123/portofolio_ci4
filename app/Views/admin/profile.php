<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="card-body p-4 mt-1">
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session('message') ?></div>
    <?php endif; ?>

    <form action="<?= site_url('admin/profile/update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- Profile Photo -->
        <h5 class="mb-4">Foto Profile</h5>
        <div class="mb-4 text-center d-flex justify-content-start align-items-center">
            <?php if ($user->image): ?>
                <img id="profile-preview"
                    src="<?= base_url('images/profile/' . $user->image) ?>"
                    alt="Profile"
                    class="rounded-circle mb-3 shadow-sm border border-3 border-secondary-subtle"
                    width="120" height="120"
                    style="object-fit: cover;">
            <?php else: ?>
                <img id="profile-preview"
                    src="<?= site_url('images/profile/default-user.png') ?>"
                    alt="Profile"
                    class="rounded-circle mb-3 shadow-sm bg-light border border-3 border-secondary-subtle"
                    width="120" height="120"
                    style="object-fit: cover;">
            <?php endif; ?>

            <div class="ms-4 d-flex align-items-center">
                <label class="btn btn-sm text-black bg-body-secondary p-2 border border-secondary hover-opacity">
                    <i data-feather="camera" class="me-1"></i>
                    <span>Change Photo</span>
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
                <div class="d-flex align-items-center justify-content-center">
                    <i data-feather="save" class="me-1"></i>
                    <span>Save Changes</span>
                </div>
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>
<script src="<?= base_url('js/profile.js') ?>"></script>
<?= $this->endSection() ?>