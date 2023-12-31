<?php
$servername = "localhost";
$database = "D16CNPM";
$username = "root";
$password = "";

$connect = mysqli_connect($servername, $username, $password, $database);
if (!$connect) {
    die("Không kết nối: " . mysqli_connect_error());
    exit();
}

// Định nghĩa biến và chuỗi truy vấn ban đầu
$search = "";
$query = "SELECT masv, ho_ten, lop, que_quan FROM tblsinhvien";

// Kiểm tra nếu có sử dụng chức năng tìm kiếm
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    $search = mysqli_real_escape_string($connect, $_GET["search"]);
    $query .= " WHERE masv LIKE '%$search%' OR ho_ten LIKE '%$search%'";
}

// Thực hiện truy vấn SQL
$result = mysqli_query($connect, $query);
if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html>
<?php
include('Header.php');
?>
<body>
<div class="content" id="content">
<div class="container mt-5">
    <h1 class="text-center title mb-5">Tìm kiếm sinh viên</h1>

    <!-- Form tìm kiếm -->
    <form class="mb-3" method="get">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo mã hoặc họ tên" value="<?= $search ?>">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered custom-table">
        <thead>
        <tr>
            <th>Mã sinh viên</th>
            <th>Họ tên</th>
            <th>Lớp</th>
            <th>Quê quán</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["masv"] . "</td>";
            echo "<td>" . $row["ho_ten"] . "</td>";
            echo "<td>" . $row["lop"] . "</td>";
            echo "<td>" . $row["que_quan"] . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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


