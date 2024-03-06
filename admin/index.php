<?php
include '../koneksi.php';

// Proses pencarian
if (isset($_GET['search'])) {
    $keyword = $_GET['search'];
    $query = "SELECT * FROM foto 
            INNER JOIN user ON foto.userid=user.userid 
            INNER JOIN album ON foto.albumid=album.albumid 
            WHERE judulfoto LIKE '%$keyword%'";
} else {
    $query = "SELECT * FROM foto 
            INNER JOIN user ON foto.userid=user.userid 
            INNER JOIN album ON foto.albumid=album.albumid";
}
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <h4 style="position:relative; right:20px">Website Galeri Foto</h4>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="../config/aksi_logout.php" class="btn btn-outline-success m-1"
                style="position:relative; left:10px; width: 50px; height: 30px;">
                <i class="fas fa-sign-out-alt"></i> <!-- Menggunakan ikon FontAwesome untuk logout -->
            </a>
        </div>
    </nav>

    <div class="container">
                <a href="../admin/index.php" class="btn btn-outline-danger m-1">Beranda</a>
                <a href="../admin/home.php" class="btn btn-outline-danger m-1">My Album</a>
                <a href="../admin/album.php" class="btn btn-outline-danger m-1">Album</a>
                <a href="../admin/foto.php" class="btn btn-outline-danger m-1">Foto</a>
                <a href="../admin/manage_admin.php" class="btn btn-outline-danger m-1">Pengguna</a>
                    <!-- Formulir pencarian -->
                    <form action="" method="GET" class="form-inline justify-content-center mb-0">
                        <div class="input-group" style="margin-left: 450px; margin-top: -45px;">
                            <div style="display: flex; align-items: center; margin-left: 50px; margin-top:5px;">
                                <input type="text" class="form-control" name="search" placeholder="Cari" style="width: 400px;">
                                <button type="  submit" class="btn btn-outline-primary" style="margin-left: 5px;"><i class="fas fa-search"></i></button>
                            </div>
                        </div> 
                    </form>
            </div>

    <div class="container mt-1">
        <div class="row">
        <?php
            // Proses pencarian
            while ($data = mysqli_fetch_array($result)) :
            ?>
            <!-- Tampilkan foto yang sesuai dengan hasil pencarian -->
            <div class="col-md-3 mt-2">
                <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
                    <div class="card mb-2">
                    <img style="height: 16rem; width: 100%; object-fit: cover;" src="../assets/img/<?php echo $data['lokasifile'] ?>" title="<?php echo $data['judulfoto'] ?>">
                        <div class="card-footer text-center">
                            <?php
                            $userid = $data['userid'];
                            $fotoid = $data['fotoid'];
                            $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
                            if (mysqli_num_rows($ceksuka) == 1) { ?>
                            <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" 
                            type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                            <?php } else { ?>
                            <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>"
                                type="submit" name="suka"><i class="fa-solid  fa-heart"></i></a>
                            <?php }
                            $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($like) . ' Suka';
                            ?>
                            <a type="button" data-bs-toggle="modal"
                                data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i
                                    class="fa-regular fa-comment"></i> </a>
                            <?php
                            $jmlkomen = mysqli_query($koneksi, "SELECT* FROM komentarfoto
                                WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($jmlkomen) . ' Komentar';
                            ?>
                            <!-- Konten footer card -->
                        </div>
                    </div>
                </a>
                <!-- Modal -->
                <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel " aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img src="../assets/img/<?php echo $data['lokasifile'] ?>"
                                            class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="m-2">
                                            <div class="">
                                                <div class="sticky-top">
                                                    <strong><?php echo $data['judulfoto'] ?></strong><br>
                                                    <span
                                                        class="badge bg-secondary"><?php echo $data['namalengkap'] ?></span>
                                                    <span
                                                        class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
                                                    <span
                                                        class="badge bg-primary"><?php echo $data['namaalbum'] ?></span>
                                                </div>
                                                <hr>
                                                <p align="left">
                                                    <?php echo $data['deskripsifoto'] ?>
                                                </p>
                                                <hr>
                                                <hr>
                                                <?php
                                                $fotoid = $data['fotoid'];
                                                $komentar = mysqli_query($koneksi, "SELECT * FROM
                                                    komentarfoto INNER JOIN user ON komentarfoto.userid=
                                                    user.userid WHERE komentarfoto.fotoid='$fotoid'");
                                                while ($row = mysqli_fetch_array($komentar)) {
                                                    ?>
                                                <div class="row align-items-center">
                                                    <div class="col-10">
                                                        <p align="left">
                                                            <strong><?php echo $row['tanggalkomentar'] ?></strong><br>
                                                            <strong><?php echo $row['namalengkap'] ?></strong>
                                                            <?php echo $row['isikomentar'] ?><br>
                                                        </p>
                                                    </div>
                                                    <div class="col-2">
                                                        <!-- Form untuk hapus komentar -->
                                                        <form action="../config/proses_komentar.php" method="POST">
                                                            <input type="hidden" name="komentarid"
                                                                value="<?php echo $row['komentarid']; ?>">
                                                            <button type="submit" class="btn btn-danger"
                                                                name="hapus_komentar">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                                <hr>
                                                <hr>
                                                <div class="sticky-bottom">
                                                    <form action="../config/proses_komentar.php" method="POST">
                                                        <div class="input-group">
                                                            <input type="hidden" name="fotoid"
                                                                value="<?php echo $data['fotoid']; ?>">
                                                            <input type="text" name="isikomentar"
                                                                class="form-control" placeholder="Tambah Komentar">
                                                            <div class="input-group-prepend">
                                                                <button type="submit" name="kirimkomentar"
                                                                    class="btn btn-outline-primary">Kirim</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile ?>
        </div>
    </div>
                                                    
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>
