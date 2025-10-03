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
            /* Add transition for smoother layout changes */
            transition: margin-left .5s;
        }

        /* --- Sidebar Styles --- */
        .sidebar {
            width: 0; /* START HIDDEN (Mobile First) */
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #007bff;
            padding-top: 60px;
            transition: width .5s;
            overflow-x: hidden;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            color: white;
        }

        /* This class will be toggled by JS to show the sidebar */
        .sidebar.open {
            width: 250px;
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
            display: block;
            white-space: nowrap; /* Prevents text wrap when sidebar collapses */
            cursor: pointer;
        }
        
        .navigation-content a, .navigation-content svg {
            color: white;
            text-decoration: none;
            vertical-align: middle; /* Aligns icon and text nicely */
            margin-right: 8px; /* Adds space between icon and text */
        }

        .navigation-content div:hover {
            background-color: #ff8c00;
        }
        
        .navigation-content div:hover a, 
        .navigation-content div:hover svg {
            color: black;
        }

        .sidebar .logout-button {
            margin-top: auto;
            margin-bottom: 1rem;
        }
        .logout-button a {
           color: white;
        }
        .logout-button a:hover {
           color: black;
        }

        /* --- Main Content Styles --- */
        .main-content {
            margin-left: 0; /* Full width by default (Mobile First) */
            padding: 20px;
            padding-top: 60px;
            width: 100%;
            transition: margin-left .5s;
        }

        /* --- Hamburger Toggle Styles --- */
        #sidebarToggle {
            cursor: pointer;
            width: 35px;
            height: 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            position: fixed;
            top: 15px;
            left: 15px; /* Positioned for closed state by default */
            z-index: 1001;
            transition: left .5s;
        }

        #sidebarToggle span {
            display: block;
            width: 100%;
            height: 3px;
            background-color: #333; /* Black bars for visibility on white background */
            border-radius: 3px;
            transition: all .3s;
        }

        /* --- Selected Navigation Item --- */
        .navbar-selected {
            background: #ff8c00;
        }

        .navbar-selected a,
        .navbar-selected svg {
            color: black;
        }


        /* ================================================= */
        /* ---  MEDIA QUERY FOR LARGER SCREENS (>=768px) --- */
        /* ================================================= */
        @media (min-width: 768px) {
            
            /* By default on desktop, the sidebar is open */
            .sidebar {
                width: 250px;
            }

            /* When it's closed via JS toggle, it becomes 0 */
            .sidebar.close {
                 width: 0;
            }
            
            /* Push main content over to make space for the sidebar */
            .main-content {
                margin-left: 250px;
            }

            /* If sidebar is closed, content takes full width */
            .main-content.close {
                margin-left: 0;
            }

            /* Position the toggle inside the open sidebar */
            #sidebarToggle {
                left: 200px;
            }

            /* Make toggle bars white to show up on the blue sidebar */
            #sidebarToggle span {
                background-color: white;
            }
            
            /* When sidebar is closed, move toggle to the left edge */
            body.sidebar-closed #sidebarToggle {
                left: 15px;
            }

            /* And make the bars black again for the white background */
            body.sidebar-closed #sidebarToggle span {
                background-color: #333;
            }
        }
    </style>
</head>

<body class="">

    <div id="sidebarToggle">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div class="sidebar" id="sidebar">
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet">
                    <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4" />
                    <path d="M3 5v14a2 2 0 0 0 2 2h16v-5" />
                    <path d="M18 12a2 2 0 0 0 0 4h4v-4Z" />
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
            // This single line on the body is great for controlling styles globally
            document.body.classList.toggle('sidebar-closed'); 
            
            // These two lines handle the actual layout shift
            document.getElementById('sidebar').classList.toggle('close');
            document.getElementById('main-content').classList.toggle('close');
        });

        // Small improvement: Detect screen size on load to set initial state correctly
        // This prevents a "flash" of the wrong layout on desktop
        window.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');

            if (window.innerWidth < 768) {
                // If on mobile, ensure it starts closed
                document.body.classList.add('sidebar-closed');
                sidebar.classList.add('close');
                mainContent.classList.add('close');
            } else {
                // If on desktop, ensure it starts open
                document.body.classList.remove('sidebar-closed');
                sidebar.classList.remove('close');
                mainContent.classList.remove('close');
            }
        });
    </script>
</body>

</html>