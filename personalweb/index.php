<?php
session_start();
require_once 'koneksi.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Web - <?php echo ucfirst($page); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body { background-color: #f8f9fa; }
        .main-container { min-height: 500px; padding: 20px; background-color: white; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        .sidebar { background-color: white; padding: 15px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        .header-carousel img { height: 300px; object-fit: cover; }
    </style>
</head>
<body>

<div class="container mt-3">
    <!-- Header (12 Grid) -->
    <div class="row mb-3">
        <div class="col-12">
            <?php include 'header.php'; ?>
        </div>
    </div>

    <!-- Menu (12 Grid) -->
    <div class="row mb-3">
        <div class="col-12">
            <?php include 'menu.php'; ?>
        </div>
    </div>

    <!-- Content Area -->
    <div class="row mb-3">
        <!-- Sidebar (3 Grid) -->
        <div class="col-md-3">
            <div class="sidebar">
                <?php include 'sidebar.php'; ?>
            </div>
        </div>

        <!-- Main Content (9 Grid) -->
        <div class="col-md-9">
            <div class="main-container">
                <?php
                // Whitelist pages for security
                $allowed_pages = ['home', 'about', 'contact', 'login', 'level', 'level_form', 'studies', 'studies_form'];
                if (in_array($page, $allowed_pages)) {
                    include 'pages/' . $page . '.php';
                } else {
                    echo "<h2>Halaman tidak ditemukan!</h2>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Footer (12 Grid) -->
    <div class="row mt-4">
        <div class="col-12">
            <?php include 'footer.php'; ?>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
