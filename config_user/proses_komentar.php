<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Pastikan fotoid dan isikomentar tersedia dalam $_POST
    if(isset($_POST['fotoid']) && isset($_POST['isikomentar'])){
        $fotoid = $_POST['fotoid'];
        $userid = $_SESSION['userid'];
        $isikomentar = $_POST['isikomentar'];
        $tanggalkomentar = date('Y-m-d');

        $sql =  "INSERT INTO komentarfoto (fotoid, userid, isikomentar, tanggalkomentar) 
                        VALUES ('$fotoid', '$userid', '$isikomentar', '$tanggalkomentar')";

        if (mysqli_query($koneksi, $sql)) {
            // Redirect user back to the same page
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
        mysqli_close($koneksi);
    } else {
        // Jika fotoid atau isikomentar tidak tersedia dalam $_POST, tampilkan pesan error
        echo "Form data tidak lengkap";
    }
}
?>


<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $komentarid = $_POST['komentarid'];
    $isikomentar_baru = $_POST['isikomentar_baru'];

    $sql =  "UPDATE komentarfoto SET isikomentar='$isikomentar_baru' WHERE komentarid='$komentarid'";

    if (mysqli_query($koneksi, $sql)) {
        header("location: ../user/index.php");
    } else {
        echo "eror";
    }
    mysqli_close($koneksi);
}
?>

<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $komentarid = $_POST['komentarid'];

    $sql =  "DELETE FROM komentarfoto WHERE komentarid='$komentarid'";

    if (mysqli_query($koneksi, $sql)) {
        header("location: ../user/index.php");
    } else {
        echo "eror";
    }
    mysqli_close($koneksi);
}
?>

<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus_komentar'])) {
    // Ambil komentar_id dari data yang dikirimkan melalui form
    $komentar_id = $_POST['komentar_id'];

    // Query untuk menghapus komentar berdasarkan komentar_id
    $query = "DELETE FROM komentarfoto WHERE komentar_id = '$komentar_id'";

    if (mysqli_query($koneksi, $query)) {
        // Jika penghapusan berhasil, alihkan kembali ke halaman foto dengan pesan sukses
        header("Location: ../user/foto.php?hapus_success=true");
        exit();
    } else {
        // Jika penghapusan gagal, alihkan kembali ke halaman foto dengan pesan error
        header("Location: ../user/foto.php?hapus_error=true");
        exit();
    }
} else {
    // Jika tidak ada metode POST yang terdeteksi atau data yang diperlukan tidak tersedia, alihkan kembali ke halaman foto
    header("Location: ../user/foto.php");
    exit();
}
?>
