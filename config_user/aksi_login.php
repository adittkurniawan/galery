<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
$cek = mysqli_num_rows($sql);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($sql);
    $hashed_password = $data['password'];

    // Verifikasi password menggunakan password_verify()
    if (password_verify($password, $hashed_password)) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['userid'] = $data['userid'];
        $_SESSION['level'] = $data['level']; // Menyimpan peran pengguna (admin atau user)

        if ($_SESSION['level'] == 'admin') {
            $_SESSION['status'] = 'admin_login'; // Menyatakan bahwa yang login adalah admin
            echo "<script>;
            alert('Login berhasil sebagai admin');
            location.href='../admin/index.php';
            </script>";
        } else {
            $_SESSION['status'] = 'user_login'; // Menyatakan bahwa yang login adalah user
            echo "<script>;
            alert('Login berhasil sebagai user');
            location.href='../user/index.php';
            </script>";
        }
    } else {
        echo "<script>;
        alert('Password salah!');
        location.href='../login.php';
        </script>";
    }
} else {
    echo "<script>;
    alert('Username tidak ditemukan!');
    location.href='../login.php';
    </script>";
}
?>
