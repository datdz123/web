
<?php
$servername = "localhost:3306";
$database = "D16CNPM";
$username = "root";
$password = "";
$connect = mysqli_connect($servername, $username, $password, $database);

if (!$connect) {
    die("Không kết nối: " . mysqli_connect_error());
    exit();
}

$masv = "";
$ho_ten = "";
$que_quan = "";
$showSuccessModal = false;
$showErrorModal = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["masv"])) { $masv = $_POST['masv']; }
    if(isset($_POST["ho_ten"])) { $ho_ten = $_POST['ho_ten']; }
    if(isset($_POST["lop"])) { $lop = $_POST['lop']; }
    if(isset($_POST["que_quan"])) { $que_quan = $_POST['que_quan']; }

    // Kiểm tra xem mã sinh viên đã tồn tại hay chưa
    $check_query = "SELECT * FROM tblsinhvien WHERE masv = '$masv'";
    $check_result = mysqli_query($connect, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $trangchu_message = "Mã sinh viên đã tồn tại. Không thể thêm.";
    } else {
        // Nếu mã sinh viên không tồn tại, thực hiện thêm bản ghi mới
        $sql = "INSERT INTO tblsinhvien (masv, ho_ten, lop, que_quan) VALUES ('$masv', '$ho_ten', '$lop', '$que_quan')";
        if (mysqli_query($connect, $sql)) {
            $trangchu_message = "Thêm sinh viên thành công";
        } else {
            $trangchu_message = "Thêm thất bại: " . mysqli_error($connect);
        }
    }
}

$query = mysqli_query($connect, "SELECT * FROM tblsinhvien");
if (!$query) {
    die("Lỗi truy vấn: " . mysqli_error($connect));
}
?>

<!-- Your HTML here -->



<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php
include('Header.php');
?>
<div id="content" class="content">
    <div class="container mt-5 content">
        <h1 class="text-center text-custom title" style="padding-bottom: 5%; padding-top: 5%; "> Quản lý Sinh viên</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="masv">Mã sinh viên:</label>
                <input type="text" class="form-control" name="masv" id="masv">
            </div>
            <div class="form-group">
                <label for="ho_ten">Họ tên:</label>
                <input type="text" class="form-control" name="ho_ten" id="ho_ten">
            </div>
            <div class="form-group">
                <label for="lop">Lớp:</label>
                <input type="text" class="form-control" name="lop" id="lop">
            </div>
            <div class="form-group">
                <label for="que_quan">Quê quan:</label>
                <textarea class="form-control" name="que_quan" id="que_quan" rows="4"></textarea>
            </div>
            <button id="submitBtn" type="submit" class="btn btn-primary d-flex mx-auto mb-5">Thêm sinh viên</button>
        </form>

        <table class="table table-bordered pt-5 custom-table ">
            <thead class="thead-light">
            <tr>
                <th>Mã sinh viên</th>
                <th>Họ tên</th>
                <th>Lớp</th>
                <th>Quê quán</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
            </thead>
            <tbody>

            <?php
            // Khởi tạo biến đếm $i = 0
            $i = 0;
            while ($data = mysqli_fetch_array($query)) {
                if ($i == 4) {
                    echo "</tr>";
                    $i = 0;
                }
                ?>
                <tr>
                    <td><?= $data["masv"]; ?></td>
                    <td><?php echo $data["ho_ten"]; ?></td>
                    <td><?php echo $data["lop"]; ?></td>
                    <td><?php echo $data["que_quan"]; ?></td>
                    <td><a href="sua_sinh_vien.php?masv=<?php echo $data['masv']; ?>">
                            <i class="fas fa-edit"></i>
                        </a></td>

                    <td> <a class="delete-link" href="xoa_sinh_vien.php?masv=<?php echo $data['masv']; ?>"  > <i class="fas fa-trash"> </i></a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

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

