<?php

$data = "";
// Kiểm tra xem có masv truyền vào không
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $servername = "localhost:3306";
    $database = "D16CNPM";
    $username = "root";
    $password = "";
    $connect = mysqli_connect($servername, $username, $password, $database);
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
    // Xử lý biểu mẫu chỉnh sửa khi người dùng nhấn nút "Lưu"
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Cập nhật thông tin sinh viên trong cơ sở dữ liệu
        $update_query = "UPDATE tbluser SET username = '$username', password='$password' WHERE id = '$id'";
        if (mysqli_query($connect, $update_query)) {
            $trangchu_message = "Sửa thành công";
        } else {
            $trangchu_message = "Sửa thất bại";
        }
    }

    mysqli_close($connect);
}
?>
<!DOCTYPE html>
<html>
<?php
include('header.php');
?>
<body>
<div class="content" id="content">
<div class="container mt-5">
    <h1 class="text-center title mb-5">Chỉnh sửa thông tin người dùng</h1>
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
</div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Sử dụng jQuery để làm mềm cuộn (scroll) của trang web từ trên xuống đối với id: submitBtn
    $('html, body').animate({
        scrollTop: $('.title').offset().top
    }, 5000) // Thời gian làm mềm cuộn (milliseconds)
    window.onscroll = function() {
        var button = document.getElementById('back-to-top-button');
        if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
            button.style.display = 'block';
        } else {
            button.style.display = 'none';
        }
    };

    // Xử lý sự kiện khi nút "Quay lại đầu trang" được nhấn
    document.getElementById('back-to-top-button').addEventListener('click', function() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    });

</script>
<script>
    // Kiểm tra nếu có thông báo trang chủ
    var trangchuMessage = "<?php echo $trangchu_message; ?>";
    if (trangchuMessage) {
        Swal.fire({
            icon: 'info',
            title: trangchuMessage,
        });
    }
</script>
