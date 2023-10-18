<?php
// Kiểm tra xem có masv truyền vào không
if (isset($_GET['masv'])) {
    $masv = $_GET['masv'];
    $servername = "localhost:3306";
    $database = "D16CNPM";
    $username = "root";
    $password = "";
    $connect = mysqli_connect($servername, $username, $password, $database);
    if (!$connect) {
        die("Không kết nối: " . mysqli_connect_error());
    }
    // Truy vấn dữ liệu của sinh viên theo masv
    $query = mysqli_query($connect, "SELECT * FROM tblsinhvien WHERE masv = '$masv'");

    if (!$query) {
        die("Lỗi truy vấn: " . mysqli_error($connect));
    }
    // Lấy dữ liệu của sinh viên từ kết quả truy vấn
    $data = mysqli_fetch_array($query);
    // Xử lý biểu mẫu chỉnh sửa khi người dùng nhấn nút "Lưu"
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ho_ten = $_POST['ho_ten'];
        $lop = $_POST['lop'];
        $que_quan = $_POST['que_quan'];
        // Cập nhật thông tin sinh viên trong cơ sở dữ liệu
        $update_query = "UPDATE tblsinhvien SET ho_ten = '$ho_ten', lop = '$lop', que_quan = '$que_quan' WHERE masv = '$masv'";
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
    <h1 class="text-center title">Chỉnh sửa sinh viên</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="ho_ten">Họ tên:</label>
            <input type="text" class="form-control" name="ho_ten" id="ho_ten" value="<?php echo $data['ho_ten']; ?>">
        </div>
        <div class="form-group">
            <label for="lop">Lớp:</label>
            <input type="text" class="form-control" name="lop" id="lop" value="<?php echo $data['lop']; ?>">
        </div>
        <div class="form-group">
            <label for="que_quan">Quê quán:</label>
            <textarea class="form-control" name="que_quan" id="que_quan" rows="4"><?php echo $data['que_quan']; ?></textarea>
        </div>
        <button type="submit " class="btn btn-primary  text-center " style="width: 10%;">
          Sửa
        </button>
        <a href="Trangchu.php" class="btn btn-warning">Quay lại</a>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Kiểm tra nếu có thông báo trang chủ
    var trangchuMessage = "<?php echo $trangchu_message; ?>";
    if (trangchuMessage) {
        Swal.fire({
            icon: 'info',
            title: trangchuMessage,
         })
            // .then((result) => {
        //     if (result.isConfirmed) {
        //         // Kiểm tra xem loginMessage là "Login thành công" trước khi chuyển hướng
        //         if (trangchuMessage === "Sửa thành công") {
        //             window.location.href = 'Trangchu.php';
        //         }
        //     }
        // });
    }
</script>
