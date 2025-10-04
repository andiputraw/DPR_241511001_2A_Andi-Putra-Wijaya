<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?? 'Dashboard' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            transition: margin-left .3s;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #e9ecef;
            overflow-x: hidden;
            transition: width 0.3s ease-in-out;
            padding-top: 60px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar.collapsed {
            width: 0;
        }

        .main-content {
            transition: margin-left 0.3s ease-in-out;
            margin-left: 250px;
            padding: 30px;
        }

        .main-content.collapsed {
            margin-left: 0;
        }

        #sidebarToggle svg {
            color: #343a40;
            transition: color 0.2s ease-in-out;
        }

        #sidebarToggle:hover svg {
            color: #007bff;
        }

        #sidebarToggle {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 2;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }

        h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #343a40;
        }

        .navigation-content {
            padding: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .navigation-item {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .navigation-item:hover {
            background-color: #dee2e6;
        }

        .navigation-item.navbar-selected a {
            font-weight: 600;
        }

        .navigation-item.navbar-selected svg {
            stroke: #ff8400ff;
        }

        .navigation-item a {
            text-decoration: none;
            color: inherit;
            margin-left: 15px;
            font-weight: 500;
        }

        .logout-button {
            position: absolute;
            bottom: 20px;
            left: 20px;
        }

        .logout-button a {
            text-decoration: none;
            color: #fff;
            background-color: #dc3545;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.2s ease-in-out;
        }

        .logout-button a:hover {
            background-color: #c82333;
        }

        .dashboard {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .dashboard:hover {
            background-color: #dee2e6;
        }

        .dashboard.navbar-selected {
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
        }

        .dashboard a {
            text-decoration: none;
            color: inherit;
            margin-left: 15px;
            font-weight: 500;
        }

        .dashboard.navbar-selected a {
            font-weight: 600;
        }

        .dashboard.navbar-selected svg {
            stroke: #fff;
            text-decoration: none;
            color: inherit;
            margin-left: 15px;
        }

         @media (max-width: 768px) {
            .table {
                font-size: 0.5rem;
            }
         }

    </style>
</head>

<body class="">

        <div id="sidebarToggle" role="button" tabindex="0" aria-label="Toggle sidebar" aria-controls="sidebar" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu">
                <title>Toggle Sidebar</title>
                <line x1="4" y1="12" x2="20" y2="12" />
                <line x1="4" y1="6" x2="20" y2="6" />
                <line x1="4" y1="18" x2="20" y2="18" />
            </svg>
        </div>

        <div class="sidebar" id="sidebar" aria-hidden="true">
            <div class="navigation-content">
                <h3>Cek DPR</h3>
                <div class="<?= service('uri')->getSegment(1) == 'dashboard' ? 'navbar-selected' : '' ?> dashboard" onclick="window.location.href='/dashboard';">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house-icon lucide-house">
                        <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                        <path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    </svg>
                    <a href="/dashboard">Home</a>
                </div>
                <div class="<?= service('uri')->getSegment(1) == 'anggota' ? 'navbar-selected' : '' ?> navigation-item" onclick="window.location.href='/anggota';">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    <a href="/anggota">Anggota</a>
                </div>
                <div class="<?= service('uri')->getSegment(1) == 'penggajian' ? 'navbar-selected' : '' ?> navigation-item" onclick="window.location.href='/penggajian';">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-dollar-sign-icon lucide-circle-dollar-sign">
                        <circle cx="12" cy="12" r="10"/>
                    <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/>
                    <path d="M12 18V6"/>
                    </svg>
                    <a href="/penggajian">Penggajian</a>
                </div>
                <?php if (is_admin()) : ?>
                    <div class="<?= service('uri')->getSegment(1) == 'komponen-gaji' ? 'navbar-selected' : '' ?> navigation-item" onclick="window.location.href='/komponen-gaji';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-archive">
                             <rect width="20" height="5" x="2" y="3" rx="1" />
                             <path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8" />
                             <path d="M10 12h4" />
                        </svg>
                        <a href="/komponen-gaji">Komponen Gaji</a>
                    </div>
                <?php endif; ?>
                <div class="logout-button">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
                </div>
            </div>
        </div>

        <div class="main-content" id="main-content">
            <?= $this->renderSection('content') ?>
        </div>

        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah kamu yakin untuk logout?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="/logout" class="btn btn-primary">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarToggle = document.getElementById('sidebarToggle');

            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('collapsed');
            });

            function checkWindowSize() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('collapsed');
                } else {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('collapsed');
                }
            }

            window.addEventListener('resize', checkWindowSize);
            document.addEventListener('DOMContentLoaded', checkWindowSize);
        </script>
    </body>

</html>