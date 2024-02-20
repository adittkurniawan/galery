<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="
width=device-width, initial-scale=1">
<title>Website Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="
assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="index.php">Website Galeri Foto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="co data-bs-target="#navbarNavAltMarkup" aria-controls="
        navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
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
    $query= mysqli_query($koneksi, "SELECT * FROM foto"); 
    while ($data = mysqli_fetch_array($query)){
        ?>
        <div class="col-md-3 mt-2">
            <div class="card">
                <img style="height: 12rem;" src="assets/img/<?php echo $data['lokasifile'] ?>" class=
                "card-img-top" title="<?php echo $data['judulfoto'] ?>">
                <div class="card-footer text-center">


                <?php
                $fotoid = $data['fotoid'];
                $ceksuka= mysqli_query($koneksi, "SELECT* FROM likefoto");
                if (mysqli_num_rows ($ceksuka) == 1) { ?>
                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid' ] ?>" type="submit"name="batalsuka"><i class="fa fa-heart"></i></a>
                <?php }else{?>
                    <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit"name="suka"><i class="fa-regular fa-heart" ></i></a>
                    <?php }
                    $like = mysqli_query($koneksi, "SELECT* FROM likefoto WHERE fotoid='$fotoid'");
                    echo mysqli_num_rows ($like). 'Suka';
                    ?>
                    <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>
                            "><i class="fa-regular fa-comment">
                            </i> </a>
                            
                            <?php
                            $jmlkomen = mysqli_query($koneksi, "SELECT* FROM komentarfoto
                            WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($jmlkomen). 'Komentar';
                            ?>
                    </a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
    
</body>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>