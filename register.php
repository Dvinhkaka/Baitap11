<?php
session_start();
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST["username"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $password = $_POST["password"] ?? "";
    $repeat_password = $_POST["repeat-password"] ?? "";

    if (!$username) $errors["username"] = "Vui lòng nhập họ tên.";
    if (!$email) $errors["email"] = "Vui lòng nhập email.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors["email"] = "Email không hợp lệ.";
    if (!$password) $errors["password"] = "Vui lòng nhập mật khẩu.";
    elseif (strlen($password) < 6) $errors["password"] = "Mật khẩu phải có ít nhất 6 ký tự.";
    if ($password !== $repeat_password) $errors["repeat-password"] = "Mật khẩu xác nhận không khớp.";

    if (!$errors) {
        $success = "Đăng ký thành công! Chào mừng, $username.";
        $_POST = [];
        setcookie("username", $username, time() + 3600, "/");
        setcookie("email", $email, time() + 3600, "/");
        setcookie("password", $password, time() + 3600, "/");
        header("Location: ./login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <!-- TODO
  1) Chuyển đổi register.html thành file php và chạy trên webserver để xử lý 
  form đăng ký người dùng gồm các thông tin: 
  Họ tên: Không được để trống. 
  Email: Không được để trống và phải đúng định dạng.
  Mật khẩu: Không được để trống, ít nhất 6 ký tự (strlen()).
  Xác nhận mật khẩu: Phải giống với Mật khẩu.
  gợi ý: 
    + Kiểm tra và lọc dữ liệu đầu vào để chống XSS (htmlspecialchars()).
    + có thể sử dụng filter_var hoặc preg_match để kiểm tra biến
  2) Lỗi phát sinh sẽ được đưa vào mãng $errors = [];
  ví dụ: $errors = ["username" => "Vui lòng nhập họ tên.", "email" => "Vui lòng nhập email."];
  3) Hiển thị lỗi nếu có sai sót và giữ nguyên dữ liệu đã nhập nếu có lỗi.
  Có thể hiển thị lỗi trên đầu form hoặc lỗi ngay dưới phần nhập của lỗi.
  4) Nếu đăng ký thành công, hiển thị thông báo chào mừng. Xóa trống form đăng ký.
  -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./reset.css" />
    <link rel="stylesheet" href="./style.css" />
    <title>Register Page</title>
    <style>
        .error-messages { color: red; font-weight: bold; }
        .success-message { color: green; font-weight: bold; }
        .error { background-color: #ffdddd; padding: 10px; border-radius: 5px; }
        .success { background-color: #ddffdd; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="wrapper fade-in-down">
        <div id="form-content">
            <a href="./login.php">
                <h2 class="inactive underline-hover">Đăng nhập</h2>
            </a>
            <a href="./register.php">
                <h2 class="active">Đăng ký</h2>
            </a>
            <div class="fade-in first">
                <img src="./imgs/avatar.png" id="avatar" alt="User Icon" />
            </div>
            
            <?php if (!empty($errors)) : ?>
                <div class="error-messages">
                    <?php foreach ($errors as $error) : ?>
                        <p class="error"> <?php echo $error; ?> </p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)) : ?>
                <div class="success-message">
                    <p class="success"> <?php echo $success; ?> </p>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <input type="text" name="username" placeholder="Họ tên" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" />
                <input type="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" />
                <input type="password" name="password" placeholder="Mật khẩu" />
                <input type="password" name="repeat-password" placeholder="Xác nhận mật khẩu" />
                <input type="submit" value="Đăng ký" />         
            </form>

            <div id="form-footer">
                <a class="underline-hover" href="#">Quên mật khẩu?</a>
            </div>
        </div>
    </div>
</body>
</html>