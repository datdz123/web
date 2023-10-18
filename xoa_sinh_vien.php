<?php
if (isset($_GET['masv'])) {
    $masv = $_GET['masv'];
    // Kết nối đến CSDL và thực hiện xóa
    $servername = "localhost:3306";
    $database = "D16CNPM";
    $username = "root";
    $password = "";

    $connect = mysqli_connect($servername, $username, $password, $database);

    if (!$connect) {
        die("Không kết nối: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM `tblsinhvien` WHERE masv = $masv";
    $query = mysqli_query($connect, $sql);

    mysqli_close($connect);
}
?>
