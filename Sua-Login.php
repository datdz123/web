<?php
// Initialize variables
$username = "";
$password = "";
$id = "";
$error_message = "";

// Kết nối đến cơ sở dữ liệu (sử dụng thông tin kết nối của bạn)
$servername = "localhost:3306";
$database = "D16CNPM";
$db_username = "root";
$db_password = "";

$connect = mysqli_connect($servername, $db_username, $db_password, $database);
if (!$connect) {
    die("Không kết nối: " . mysqli_connect_error());
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['id'];

    // Xử lý biểu mẫu chỉnh sửa khi người dùng nhấn nút "Lưu"
    $update_query = "UPDATE tbluser SET username = '$username', password = '$password' WHERE id = '$id'";
    if (mysqli_query($connect, $update_query)) {
        echo ("Sửa thông tin thành công");
    } else {
        echo "Error: " . $update_query . "<br>" . mysqli_error($connect);
    }
} else {
    // Nếu không phải là việc gửi biểu mẫu (GET request), kiểm tra xem có tham số "id" trong URL không
    if (isset($_GET['id'])) {
        // Lấy ID từ URL
        $id = $_GET['id'];

        // Truy vấn dữ liệu của người dùng theo ID
        $query = "SELECT * FROM tbluser WHERE id = '$id'";
        $result = mysqli_query($connect, $query);

        if (!$result) {
            die("Lỗi truy vấn: " . mysqli_error($connect));
        }

        // Lấy dữ liệu của người dùng từ kết quả truy vấn
        $data = mysqli_fetch_array($result);

        // Điền dữ liệu của người dùng vào biểu mẫu chỉnh sửa
        $username = $data['username'];
        $password = $data['password'];
    } else {
        // Đảm bảo biến $data được khởi tạo nếu không có tham số "id"
        $data = [];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa form đăng nhập sinh viên</title>
    <!-- Thêm Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Chỉnh sửa form đăng nhập sinh viên</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="username">Tên người dùng:</label>
            <input type="text" class="form-control" name="username" id="username" value="<?php echo $data['username']; ?>">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" class="form-control" name="password" id="password" value="<?php echo $data['password']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
        <a href="Danhsachlogin.php" class="btn btn-warning">Quay lại</a>
    </form>
</div>
</body>
</html>
