<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Website Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
</head>
<style>
        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }
    </style>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
    <h4>Website Galeri Foto</h4>
        <button class="navbar-toggler" type="button" data-bs-toggle="co data-bs-target="#navbarNavAltMarkup" aria-controls="
        navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Formulir pencarian -->
        <form action="" method="GET" class="form-inline justify-content-center mb-2">
            <div class="input-group">
                <div style="display: flex; align-items: center; margin-left: 150px; margin-top:10px;">
                    <input type="text" class="form-control" name="search" placeholder="Cari" style="width: 400px;">
                    <button type="  submit" class="btn btn-outline-primary" style="margin-left: 10px;"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMark
    <div class="navbar-nav me-auto">

    </div>
            <a href="register.php" class="btn btn-outline-primary m-1">
            Daftar</a>
            <a href="login.php" class="btn btn-outline-success m-1">
            Masuk</a>
         </div>
        </div>
    </nav>

    
    <div class="container mt-2">
        

        <div class="row">
    <?php
    include "koneksi.php";
    session_start();
    
    // Proses pencarian
    $where = "";
    if (isset($_GET['search'])) {
        $keyword = $_GET['search'];
        $where = "WHERE judulfoto LIKE '%$keyword%'";
    }

    $query= mysqli_query($koneksi, "SELECT * FROM foto $where"); 
    while ($data = mysqli_fetch_array($query)){
        ?>
        <div class="col-md-3 mt-2 mb-3">
            <div class="card">
            <img style="height: 16rem; width: 100%; object-fit: cover;" src="assets/img/<?php echo $data['lokasifile'] ?>" title="<?php echo $data['judulfoto'] ?>">
                </a>
                <div class="card-footer text-center">
                    <?php
                    $userid = $data['userid'];
                    $fotoid = $data['fotoid'];
                    $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                    if (mysqli_num_rows($ceksuka) == 1) { 
                        ?>
                        <a <?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                    <?php } else { ?>
                        <a <?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-solid fa-heart"></i></a>
                    <?php }
                    $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($like). 'Suka';
                    ?>
                    <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i></a>
                    <?php
                    $jmlkomen = mysqli_query($koneksi, "SELECT* FROM komentarfoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows($jmlkomen). 'Komentar';
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

    
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>
</html>
