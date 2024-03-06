<?php
include '../koneksi.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <!-- Tambahkan tautan ke library FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admin</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>
<body>
<div class="container">
            <div class="container">
                <a href="../admin/index.php" class="btn btn-outline-danger m-1">Beranda</a>
                <a href="../admin/home.php" class="btn btn-outline-danger m-1">My Album</a>
                <a href="../admin/album.php" class="btn btn-outline-danger m-1">Album</a>
                <a href="../admin/foto.php" class="btn btn-outline-danger m-1">Foto</a>
                <a href="../admin/manage_admin.php" class="btn btn-outline-danger m-1">Pengguna</a>
            </div>
    <div class="container mt-4">
       <h5>Daftar Admin</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id Admin</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Email</th>
                    <th scope="col">Level Admin</th> <!-- Tambah kolom untuk menampilkan level admin -->
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM user");
                while ($data = mysqli_fetch_array($query)) {
                    echo "<tr>";
                    echo "<td>" . $data['userid'] . "</td>";
                    echo "<td>" . $data['username'] . "</td>";
                    echo "<td>" . $data['namalengkap'] . "</td>";
                    echo "<td>" . $data['email'] . "</td>";
                    echo "<td>" . $data['level'] . "</td>"; // Menampilkan level admin
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pengguna tidak memiliki akses untuk menambah admin baru -->
    </div>

    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
