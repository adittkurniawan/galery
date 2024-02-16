<?php
session_start();
$userid = $_SESSION['userid'];
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
echo "<script> I
alert('Anda belum Login!');
location.href= ' ../index.php';
</script>";
}
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

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Website Galeri Foto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="co data-bs-target=" #navbarNavAltMarkup"
                aria-controls="
        navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2" id="navbarNavAltMark
    <div class=" navbar-nav me-auto">
                <a href="home.php" class="btn btn-primary me-2">Home</a>
                <a href="album.php" class="btn btn-primary me-2">Album</a>
                <a href="foto.php" class="btn btn-primary">Foto</a>
            </div>
            <a href="../config/aksi_logout.php" class="btn btn-outline-success m-1">
                Logout</a>
        </div>
        </div>
    </nav>

    <div class="container mt-3">
        Album :
        <?php
        $album =mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
        while ($row = mysqli_fetch_array($album)) { ?>
        <a href="home.php?albumid=<?php echo $row ['albumid'] ?>" class="btn btn-outline-primary">
        <?php echo $row [ 'namaalbum'] ?></a>
        <?php } ?>
        
        <div class="row">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <div class="col-md-3">
                    <div class="card">
                        <img style="height: 12rem;" src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
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
                            <a href=""><i class="fa-regular fa-comment "></i></a> 3 Komentar
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>