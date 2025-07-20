<?php error_reporting(0);
    session_start();
include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Posyandu</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2196F3;
            --secondary-color: #FFC107;
            --dark-color: #1976D2;
            --light-color: #BBDEFB;
        }
        
        /* Page Transition Animations */
        .fade-enter {
            opacity: 0;
            animation: fadeIn 0.5s ease-in forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .container {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        /* Smooth Page Transitions */
        .page-transition {
            transition: opacity 0.3s ease-in-out;
        }
        
        .page-transition.fade-out {
            opacity: 0;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: 600;
        }
        
        .nav-link {
            color: white !important;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--secondary-color) !important;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,.1);
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        
        .btn-primary:hover {
            background-color: var(--dark-color);
        }
        
        .header-image {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            function isi_otomatis(){
                var id = $("#id").val();
                $.ajax({
                    url: 'proses-ajax.php',
                    data:"id="+id ,
                }).success(function (data) {
                    var json = data,
                    obj = JSON.parse(json);
                    $('#nama_anak').val(obj.nama_anak);
                    $('#tanggal_lahir').val(obj.tanggal_lahir);
                    $('#jenis_kelamin').val(obj.jenis_kelamin);
     
                });
            }
        </script>
</head>

<body>
<div class="container-fluid px-0">
    <!-- Header Image -->
    <div class="position-relative mb-4">
        <img src="pos.jpg" class="w-100" style="max-height: 300px; object-fit: cover;" alt="Posyandu Header">
        <div class="position-absolute bottom-0 w-100 py-3" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
            <div class="container">
                <h1 class="text-white mb-0">Sistem Informasi Posyandu</h1>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg sticky-top mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-heartbeat me-2"></i>
                Posyandu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" 
                    aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <?php if(isset($_SESSION['nama_admin'])) { 
				?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="?module=home">
                                <i class="fas fa-home me-2"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?module=ibuhamil">
                                <i class="fas fa-female me-2"></i>Ibu Hamil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?module=dataanak">
                                <i class="fas fa-baby me-2"></i>Balita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?module=penimbangan">
                                <i class="fas fa-weight me-2"></i>Penimbangan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?module=imunisasi">
                                <i class="fas fa-syringe me-2"></i>Imunisasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?module=vitamin">
                                <i class="fas fa-pills me-2"></i>Vitamin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?module=datakematian">
                                <i class="fas fa-file-medical me-2"></i>Kematian
                            </a>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-print me-2"></i>Laporan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <li>
                                    <a class="dropdown-item" href="laporan/databalita.php" target="_blank">
                                        <i class="fas fa-file-alt me-2"></i>Laporan Data Balita
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="laporan/datakematian.php" target="_blank">
                                        <i class="fas fa-file-medical me-2"></i>Laporan Data Kematian Ibu & Anak
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <?php } else { ?>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Laporan Data Balita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Laporan Data Kematian Ibu & Anak</a>
                        </li>
                    </ul>
                    <?php }

                    if(isset($_SESSION['nama_admin'])) { ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt me-2"></i>Keluar
                            </a>
                        </li>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>

        <div class="container py-4">
            <?php include 'content.php';?>
        </div>

        <footer class="bg-light py-4 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="mb-0" style="color: var(--primary-color);">
                            <i class="fas fa-heart me-2"></i>
                            Sistem Informasi Posyandu © <?php echo date('Y'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>


</body>
</html>