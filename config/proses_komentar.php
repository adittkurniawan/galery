<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
$fotoid = $_POST['fotoid'];
$userid = $_SESSION['userid'];
$isikomentar = $_POST['isikomentar'];
$tanggalkomentar = date('Y-m-d');

$sql =  "INSERT INTO komentarfoto (fotoid, userid, isikomentar, tanggalkomentar) 
                VALUES ('$fotoid', '$userid', '$isikomentar', '$tanggalkomentar')";

if (mysqli_query($koneksi, $sql)) {
    header("location: ../admin/index.php");
} else {
    echo "eror";
}
mysqli_close($koneksi);
}
?>
