<!DOCTYPE html>
<html>
<?php
include('Header.php');
?>

<body>
<div id="content" class="content">
    <div class="container mt-5">
        <form action="" method="post">
            <h1 class="text-center text-custom title" style="padding-bottom: 5%; padding-top: 5%; "> Quản lý người dùng</h1>
            <div class="form-group">
                <label for="username">Tên người dùng:</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary d-flex mx-auto">Thêm tài khoản</button>
        </form>

        <?php
        $servername = "localhost:3306";
        $database = "D16CNPM";
        $username = "root";
        $password = "";

        $connect = mysqli_connect($servername, $username, $password, $database);
        //Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
        if (!$connect) {
            die("Không kết nối :" . mysqli_connect_error());
            exit();
        }

        $newUsername = "";
        $newPassword = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["username"])) { $newUsername = $_POST['username']; }
            if(isset($_POST["password"])) { $newPassword = $_POST['password']; }

            //Code xử lý, insert dữ liệu vào table tbluser
            $sql = "INSERT INTO tbluser (username, password) VALUES ('$newUsername', '$newPassword')";
            if (mysqli_query($connect, $sql)) {
                echo "Thêm tài khoản thành công";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connect);
            }
        }
        ?>

        <table class="table table-bordered mt-4 custom-table">
            <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Mật khẩu</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
            </thead>
            <tbody>

            <?php
            // Lấy dữ liệu từ database và hiển thị danh sách người dùng
            $query = mysqli_query($connect, "SELECT * FROM tbluser");
            if (!$query) {
                die("Lỗi truy vấn: " . mysqli_error($connect));
            }

            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $data["id"]; ?></td>
                    <td><?php echo $data["username"]; ?></td>
                    <td><?php echo $data["password"]; ?></td>

                    <td><a href="sua-login.php?masv=<?php echo $data['id']; ?>">
                            <i class="fas fa-edit"></i>
                        </a></td>

                    <td> <a href="xoa-login.php?masv=<?php echo $data['id']; ?>"  > <i class="fas fa-trash"> </i></a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
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

