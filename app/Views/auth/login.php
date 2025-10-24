<?= $this->extend('layouts/auth') ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> <?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="container d-flex justify-content-center p-5">
    <div class="card col-12 col-md-5 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-5 text-center">Login</h5>

            <?php if (session('error') !== null) : ?>
                <div class="alert alert-danger" role="alert"><?= esc(session('error')) ?></div>
            <?php elseif (session('errors') !== null) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php if (is_array(session('errors'))) : ?>
                        <?php foreach (session('errors') as $error) : ?>
                            <?= esc($error) ?>
                            <br>
                        <?php endforeach ?>
                    <?php else : ?>
                        <?= esc(session('errors')) ?>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <?php if (session('message') !== null) : ?>
                <div class="alert alert-success" role="alert"><?= esc(session('message')) ?></div>
            <?php endif ?>

            <form action="<?= url_to('login') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Email -->
                <div class="mb-3">
                    <label for="floatingEmailInput" class="">Email</label>
                    <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="Email" value="<?= old('email') ?>" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="floatingPasswordInput">Password</label>
                    <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
                </div>

                <!-- Remember me -->
                <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')): ?> checked<?php endif ?>>
                            Ingat saya
                        </label>
                    </div>
                <?php endif; ?>

                <div class="d-grid col-12 col-md-8 mx-auto m-3">
                    <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.login') ?></button>
                </div>

                <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                    <p class="text-center">Lupa password? <a href="<?= url_to('magic-link') ?>">Gunakan link login</a></p>
                <?php endif ?>

                <?php if (setting('Auth.allowRegistration')) : ?>
                    <p class="text-center">Belum punya akun? <a href="/register">Daftar</a></p>
                <?php endif ?>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>