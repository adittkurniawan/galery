<?php
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];
$level = $_POST['level'];

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = mysqli_query($koneksi, "INSERT INTO user (username, password, email, namalengkap, alamat, level) VALUES ('$username', '$hashed_password', '$email', '$namalengkap', '$alamat', '$level')");

if ($sql) {
    echo "<script>
    alert('Pendaftaran akun berhasil');
    location.href='../login.php';
    </script>";
} else {
    echo "<script>
    alert('Terjadi kesalahan saat mendaftarkan akun');
    history.go(-1);
    </script>";
}
?>
