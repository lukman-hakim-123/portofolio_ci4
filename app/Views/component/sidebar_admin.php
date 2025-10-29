<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse p-3">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link <?= url_is('admin') ? 'active' : '' ?>" href="<?= site_url('admin') ?>">
                    <i data-feather="home" class="me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link" href="#">
                    <i data-feather="briefcase" class="me-2"></i> Projects
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link" href="#">
                    <i data-feather="tool" class="me-2"></i> Skills
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link" href="#">
                    <i data-feather="award" class="me-2"></i> Experience
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link" href="#">
                    <i data-feather="book-open" class="me-2"></i> Education
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link" href="#">
                    <i data-feather="mail" class="me-2"></i> Messages
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= url_is('admin/profile*') ? 'active' : '' ?>" href="<?= site_url('admin/profile') ?>">
                    <i data-feather="user" class="me-2"></i> Profile
                </a>
            </li>
        </ul>
    </div>
</nav>