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
        exit();
    }
    $sql = "DELETE FROM `tblsinhvien` WHERE masv = $masv";
    $query = mysqli_query($connect, $sql);
    if ($query) {
        // Xóa thành công
        $delete_message = "Xoá thành công";
    } else {
        // Xóa thất bại
        $delete_message = "Xoá thất bại: " . mysqli_error($connect);
    }

    mysqli_close($connect);
    header('location:trangchu.php');
}

?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // Kiểm tra nếu có thông báo xoá
    var deleteMessage = "<?php echo isset($_GET['delete_message']) ? $_GET['delete_message'] : ''; ?>";
    if (deleteMessage) {
        Swal.fire({
            icon: 'info',
            title: deleteMessage,
        });
    }
</script>
