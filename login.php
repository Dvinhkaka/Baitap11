<?php
session_start();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $password = $_POST["password"] ?? "";

    if (!$email) $errors["email"] = "Vui lòng nhập email.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors["email"] = "Email không hợp lệ.";
    if (!$password) $errors["password"] = "Vui lòng nhập mật khẩu.";

    if (!$errors && isset($_COOKIE["email"], $_COOKIE["password"]) && 
        $email == $_COOKIE["email"] && $password == $_COOKIE["password"]) {
        $_SESSION["username"] = $_COOKIE["username"];
        header("Location: success.php");
        exit();
    } elseif (!$errors) {
        $errors["login"] = "Sai email hoặc mật khẩu!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./reset.css" />
    <link rel="stylesheet" href="./style.css" />
    <title>Login Page</title>
    <style>
        .error-messages { color: red; font-weight: bold; }
        .error { background-color: #ffdddd; padding: 10px; border-radius: 5px; }
    </style>
  </head>
  <body>
    <div class="wrapper fade-in-down">
      <div id="form-content">
        <a href="./login.php">
          <h2 class="active">Đăng nhập</h2>
        </a>
        <a href="./register.php">
          <h2 class="inactive underline-hover">Đăng ký</h2>
        </a>
        <div class="fade-in first">
          <img src="./imgs/avatar.png" id="avatar" alt="User Icon" />
        </div>

        <?php if (!empty($errors)) : ?>
            <div class="error-messages">
                <?php foreach ($errors as $error) : ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
          <input
            type="email"
            id="Email"
            class="fade-in second"
            name="email"
            placeholder="Email"
            value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"
          />
          <input
            type="password"
            id="password"
            class="fade-in third"
            name="password"
            placeholder="Mật khẩu"
          />
          <input type="submit" class="fade-in five" value="Đăng nhập" />
        </form>
        <div id="form-footer">
          <a class="underline-hover" href="#">Quên mật khẩu?</a>
        </div>
      </div>
    </div>
  </body>
</html>