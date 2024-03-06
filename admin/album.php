<?php
session_start();
include'../config/koneksi.php';

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
    <div class="container">
                <a href="../admin/index.php" class="btn btn-outline-danger m-1">Beranda</a>
                <a href="../admin/home.php" class="btn btn-outline-danger m-1">My Album</a>
                <a href="../admin/album.php" class="btn btn-outline-danger m-1">Album</a>
                <a href="../admin/foto.php" class="btn btn-outline-danger m-1">Foto</a>
                <a href="../admin/manage_admin.php" class="btn btn-outline-danger m-1">Pengguna</a>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-header">Tambah Album</div>
                    <div class="card-body">
                        <form action="../config/aksi_album.php" method="POST">
                            <label class="form-label">Nama Album</label>
                            <input type="text" name="namaalbum" class="form-control" required>
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" required></textarea>
                            <button type="submit" class="btn btn-primary mt-2" name="tambah">Tambah Data</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mt-2">
                    <div class="card-header">Data Album</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Album</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                   $no = 1;
                   $userid = $_SESSION[ 'userid'];
                   $sql = mysqli_query($koneksi, "SELECT * FROM album
                   WHERE userid='$userid'");
                   while ($data = mysqli_fetch_array($sql)){
                   ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['namaalbum'] ?></td>
                                    <td><?php echo $data['deskripsi'] ?></td>
                                    <td><?php echo $data['tanggaldibuat'] ?></td>
                                    <td>

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#edit<?php echo $data['albumid'] ?>">
                                            Edit
                                        </button>

                                        <div class="modal fade" id="edit<?php echo $data['albumid'] ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="../config/aksi_album.php?id=<?php echo $data['albumid'] ?>"
                                                            method="POST">
                                                            <input type="hidden" name="albumid"
                                                                placeholder="<?php echo $data['albumid'] ?>">

                                                            <label class="form-label">Nama Album</label>
                                                            <input type="text" name="namaalbum"
                                                                value="<?php echo $data['namaalbum'] ?>"
                                                                class="form-control" required>
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" name="deskripsi" required>
                                        <?php echo $data['deskripsi']; ?>
                                    </textarea>

                                                            <div class="modal-footer">
                                                                <button type="submit" name="edit"
                                                                    class="btn btn-primary">Edit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
            data-bs-target="#hapus<?php echo $data['albumid'] ?>">
            Hapus
        </button>

        <div class="modal fade" id="hapus<?php echo $data['albumid'] ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../config/aksi_album.php" method="POST">
                            <input type="hidden" name="albumid" value="<?php echo $data['albumid'] ?>">
                            Apakah anda yakin akan menghapus data <strong> <?php echo $data['namaalbum'] ?> </strong> ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="hapus" class="btn btn-primary">Hapus Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
    </div>
    </div>
    </div>
    </div>


    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>

</html>