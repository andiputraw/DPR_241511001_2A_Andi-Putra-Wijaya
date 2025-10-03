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
        }

        #sidebarToggle {
            cursor: pointer;
            width: 35px;
            height: 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            position: fixed;
            top: 15px;
            left: 200px;
            /* Position inside sidebar */
            z-index: 1001;
            transition: left .5s;
        }

        #sidebarToggle span {
            display: block;
            width: 100%;
            height: 3px;
            background-color: white;
            /* White bars for visibility on blue */
            border-radius: 3px;
            transition: background-color .5s;
        }

        body.sidebar-closed #sidebarToggle {
            left: 15px;
        }

        body.sidebar-closed #sidebarToggle span {
            background-color: #333;
            /* Black bars for visibility on white */
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #007bff;
            /* Blue */
            padding-top: 60px;
            /* Make space for toggle */
            transition: width .5s;
            overflow-x: hidden;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .sidebar.close {
            width: 0;
        }

        .sidebar h3 {
            color: white;
            text-align: center;
            margin-bottom: 2rem;
        }

        .sidebar .navigation-content div {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #ffffffff;
            /* Light color for links */
            display: block;
            white-space: nowrap;
        }

        .navigation-content a, .navigation-content svg  {
            color: white;
        }


        .navigation-content a:hover, .navigation-content svg:hover  {
            color: #000000ff;
        }

        .navigation-content div:hover {
            background-color: #ff8c00;
            /* Orange on hover */
            color: black;
        }

        .sidebar .logout-button {
            color: black;
            margin-top: auto;
            margin-bottom: 1rem;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            padding-top: 60px;
            /* Adjust for fixed toggle */
            width: 100%;
            transition: margin-left .5s;
        }

        .main-content.close {
            margin-left: 0;
        }

        .navbar-selected {
            background: #ff8c00;
            color: black;
        }

        /* Add this new rule */
        .navbar-selected a, .navbar-selected svg {
            color: black;
            text-decoration: none;
            /* Optional: removes the underline */
        }

        
    </style>
</head>

<body>

    <div id="sidebarToggle">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="navigation-content">
            <h3>Cek DPR</h3>
            <div class="<?= service('uri')->getSegment(1) == 'dashboard' ? 'navbar-selected' : '' ?> dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house-icon lucide-house">
                    <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                    <path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                </svg>
                <a href="/dashboard">Home</a>
            </div>
                <div class="<?= service('uri')->getSegment(1) == 'anggota' ? 'navbar-selected' : '' ?> navigation-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house-icon lucide-house">
                        <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                        <path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    </svg>

                    <a href="/anggota">Anggota</a>
                </div>
                <div class="<?= service('uri')->getSegment(1) == 'penggajian' ? 'navbar-selected' : '' ?> navigation-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house-icon lucide-house">
                        <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                        <path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    </svg>

                    <a href="/penggajian">Penggajian</a>
                </div>
                <?php if (is_admin()) : ?>
                <div class="<?= service('uri')->getSegment(1) == 'komponen-gaji' ? 'navbar-selected' : '' ?> navigation-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house-icon lucide-house">
                        <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                        <path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    </svg>

                    <a href="/komponen-gaji">Komponen Gaji</a>
                </div>
                <?php endif; ?>
        </div>
        <div class="logout-button">
            <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a>
        </div>
    </div>

    <div class="main-content" id="main-content">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout?
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
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-closed');
            document.getElementById('sidebar').classList.toggle('close');
            document.getElementById('main-content').classList.toggle('close');
        });
    </script>
</body>

</html>