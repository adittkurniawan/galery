<?php
session_start();
if ($_SESSION['status'] != 'login') {
echo "<script>
alert('Anda belum Login!');
location.href='../index.php';|
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

    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>