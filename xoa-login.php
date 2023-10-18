<?php
// Initialize variables
$id = "";
$error_message = "";

// Check if the form has been submitted
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Kết nối đến cơ sở dữ liệu (sử dụng thông tin kết nối của bạn)
    $servername = "localhost:3306";
    $database = "D16CNPM";
    $db_username = "root";
    $db_password = "";
    $connect = mysqli_connect($servername, $db_username, $db_password, $database);
    if (!$connect) {
        die("Không kết nối: " . mysqli_connect_error());
    }

    // Truy vấn dữ liệu của sinh viên theo masv
    $query = mysqli_query($connect, "SELECT * FROM tbluser WHERE id = '$id'");
    if (!$query) {
        die("Lỗi truy vấn: " . mysqli_error($connect));
    }
    // Lấy dữ liệu của sinh viên từ kết quả truy vấn
    $data = mysqli_fetch_array($query);
    // Xử lý biểu mẫu xóa khi người dùng nhấn nút "Xóa"
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $delete_query = "DELETE FROM tbluser WHERE id = '$id'";
        if (mysqli_query($connect, $delete_query)) {
            echo "Xóa thông tin thành công";
        } else {
            echo "Error: " . $delete_query . "<br>" . mysqli_error($connect);
        }
    }
    mysqli_close($connect);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Xóa tài khoản</title>
    <!-- Thêm Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Xóa tài khoản</h2>
    <form action="" method="get">
        <div class="form-group">
            <label for="id">ID người dùng:</label>
            <input type="text" class="form-control" name="id" id="id" value="<?php echo $id; ?>">
        </div>
        <div class="form-group">
            <label for="username">Tên người dùng:</label>
            <input type="text" class="form-control" name="username" id="username" value="<?php echo $data['username']; ?>">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" class="form-control" name="password" id="password" value="<?php echo $data['password']; ?>">
        </div>
        <button type="submit" class="btn btn-danger">Xóa</button>
        <a href="Danhsachlogin.php" class="btn btn-warning">Quay lại</a>
    </form>
</div>
</body>
</html>
