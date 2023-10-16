
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kết nối đến cơ sở dữ liệu (sử dụng thông tin kết nối của bạn)
    $servername = "localhost:3306";
    $database = "D16CNPM";
    $db_username = "root";
    $db_password = "";

    $connect = mysqli_connect($servername, $db_username, $db_password, $database);
    if (!$connect) {
        die("Không kết nối: " . mysqli_connect_error());
    }

    // Truy vấn dữ liệu của sinh viên theo username và password
    $query = "SELECT * FROM tbluser WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connect, $query);

    if (!$result) {
        die("Lỗi truy vấn: " . mysqli_error($connect));
    }

    // Kiểm tra kết quả truy vấn
    if (mysqli_num_rows($result) == 1) {
        // Đăng nhập thành công, chuyển hướng đến trang quản lý sinh viên
        header("Location: Trangchu.php");
        exit();
    } else {
        // Đăng nhập không thành công, hiển thị thông báo lỗi
        $error_message = "Tên người dùng hoặc mật khẩu không chính xác.";
    }

    mysqli_close($connect);
}
?>

<title>Todo List</title>
<!-- Required meta tags -->
<meta charset="utf-8" />
<!-- <meta
  name="viewport"
  content="width=device-width, initial-scale=1, shrink-to-fit=no"
/> -->

<!-- Bootstrap CSS -->
<link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous"
/>
<!-- icon -->
<link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
        crossorigin="anonymous"
/>
<link rel="stylesheet" href="CSS/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="CSS/Login.css" />

<header>
    <a href="#" class="logo">Phạm Quang Đạt</a>
</header>
<section>
    <img src="images/stars.png" id="stars" alt="">
    <img src="images/moon.png" alt="" id="moon">
    <h2 id="text">Moon Light</h2>
    <!--    <a href="#content" id="btn">Todo</a>-->
    <img src="images/mountains_behind.png" alt="" id="mountains_behind">
    <img src="images/mountains_front.png" alt="" id="mountains_front">
    <div class="login-container">
        <h2>Đăng Nhập</h2>

        <form>
            <div class="input-box">
            <span class="icon">
              <i class="fa-solid fa-envelope"></i>
            </span>

                <input required type="text" id="email">
                <label for="email">Tên tài khoản</label>
            </div>

            <div class="input-box">
            <span class="icon">
              <i class="fa-solid fa-lock"></i>
            </span>

                <input required type="password" id="contraseña">
                <label for="contraseña">Mật khẩu</label>
            </div>

            <div class="remember-forgot">
                <label>
                    <input type="checkbox"> Ghi nhớ mật khẩu
                </label>


            </div>

            <button type="submit">Đăng Nhập</button>
        </form>

        <div class="create-account">
            <a href="#">Đăng Ký</a>
        </div>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="javascript.js"></script>

