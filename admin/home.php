<?php
include '../config/koneksi.php';
session_start();
$userid = $_SESSION['userid'];

?>

<html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="co data-bs-target=" #navbarNavAltMarkup"
                aria-controls="
        navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <a href="../config/aksi_logout.php" class="btn btn-outline-success m-1">
                    <i class="fas fa-sign-out-alt"></i> <!-- Menggunakan ikon FontAwesome untuk logout -->
                </a>
        </div>
        </div>
    </nav>
            <div class="container">
                <a href="../admin/index.php" class="btn btn-outline-danger m-1">Beranda</a>
                <a href="../admin/home.php" class="btn btn-outline-danger m-1">My Album</a>
                <a href="../admin/album.php" class="btn btn-outline-danger m-1">Album</a>
                <a href="../admin/foto.php" class="btn btn-outline-danger m-1">Foto</a>
                <a href="../admin/manage_admin.php" class="btn btn-outline-danger m-1">Pengguna</a>
            </div>
            <div class="container mt-4">
    Album :
        <?php
        $album =mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
        while ($row = mysqli_fetch_array($album)) { ?>
        <a href="home.php?albumid=<?php echo $row ['albumid'] ?>" class="btn btn-outline-primary">
        <?php echo $row [ 'namaalbum'] ?></a>
        <?php } ?>
        
        <div class="row">
        <?php
        if (isset($_GET['albumid'])) {$albumid= $_GET['albumid'];
        $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid' AND albumid=
        '$albumid'");
        while ($data = mysqli_fetch_array($query)){ ?>
        
        <div class="col-md-3 mt-2">
                    <div class="card">
                    <img style="height: 16rem; width: 100%; object-fit: cover;" src="../assets/img/<?php echo $data['lokasifile'] ?>" title="<?php echo $data['judulfoto'] ?>">
                        <div class="card-footer text-center">


                        <?php
                        $fotoid = $data['fotoid'];
                        $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");if (mysqli_num_rows($ceksuka) == 1) { 
                            ?>
                        <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                        <?php }else{ ?>
                            <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-solid  fa-heart"></i></a>
                            <?php }
                            $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($like). 'Suka';
                            ?>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>
                            "><i class="fa-regular fa-comment">
                            </i> </a>
                            
                            <?php
                            $jmlkomen = mysqli_query($koneksi, "SELECT* FROM komentarfoto
                            WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($jmlkomen). 'Komentar';
                            ?>
                        </div>
                    </div>
                </div>
        <?php } }else{

            $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
            if(mysqli_num_rows($query) > 0){
                while ($data = mysqli_fetch_array($query)) {
                
            
                ?>
                <div class="col-md-3 mt-2">
                    <div class="card">
                    <img style="height: 16rem; width: 100%; object-fit: cover;" src="../assets/img/<?php echo $data['lokasifile'] ?>" title="<?php echo $data['judulfoto'] ?>">
                        <div class="card-footer text-center">


                        <?php
                        $fotoid = $data['fotoid'];
                        $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");if (mysqli_num_rows($ceksuka) == 1) { 
                            ?>
                        <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                        <?php }else{ ?>
                            <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-solid  fa-heart"></i></a>
                            <?php }
                            $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($like). 'Suka';
                            ?>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>
                            "><i class="fa-regular fa-comment">
                            </i> </a>
                            
                            <?php
                            $jmlkomen = mysqli_query($koneksi, "SELECT* FROM komentarfoto
                            WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($jmlkomen). 'Komentar';
                            ?>
                            
                        </div>
                    </div>
                </div>
                
                <?php } }
                else{
                echo  "<h2>Belum ada gambar yg diupload</h2>";
                }
            } 
            
            ?>
            </div>
        </div>

        
                                            
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>