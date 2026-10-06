<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?? 'My CI4 App' ?></title>

    <!-- Bootstrap -->
    <link href="<?= base_url() ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            min-height: calc(100vh - 56px);
            position: fixed;
            top: 56px;
            left: 0;
            z-index: 1000;
        }

        .main-content {
            margin-left: 250px;
            padding: 25px;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            padding: 10px 15px;
            border-radius: 6px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top">
        <div class="container-fluid">

            <a class="navbar-brand" href="<?= base_url('/') ?>">
                My App
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">

                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown">
                            <?= session()->get('username') ?? 'User' ?>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    Profile
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item" href="<?= base_url('logout') ?>">
                                    Logout
                                </a>
                            </li>
                        </ul>

                    </li>
                </ul>

            </div>
        </div>
    </nav>


    <!-- Sidebar -->
    <aside class="sidebar bg-dark p-3">

        <ul class="nav nav-pills flex-column gap-2">

            <li class="nav-item">
                <a
                    href="<?= base_url('/dashboard') ?>"
                    class="nav-link <?= uri_string() == 'dashboard' ? 'active' : '' ?>">
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a
                    href="<?= base_url('/students') ?>"
                    class="nav-link <?= uri_string() == 'students' ? 'active' : '' ?>">
                    Students
                </a>
            </li>

            <li class="nav-item">
                <a
                    href="<?= base_url('/users') ?>"
                    class="nav-link <?= uri_string() == 'users' ? 'active' : '' ?>">
                    Users
                </a>
            </li>
        </ul>

    </aside>


    <!-- Main Content -->
    <main class="main-content mt-5">

        <?= $this->renderSection('content') ?>

    </main>


    <script src="<?= base_url() ?>bootstrap\dist\js\bootstrap.bundle.js"></script>

</body>

</html>