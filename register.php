<?php
require 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $reset_password = password_hash($_POST['reset_password'], PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $error = "Email đã được sử dụng!";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, reset_password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $email, $password, $reset_password]);
            header("Location: login.php");
            exit;
        }
    } catch(PDOException $e) {
        $error = "Lỗi: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Đăng ký</h2>
        <?php if ($error): ?>
            <p class="text-red-500 mb-4"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <div class="mb-4">
                <label class="block text-gray-700">Tên người dùng</label>
                <input type="text" name="username" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Mật khẩu</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Mật khẩu khôi phục</label>
                <input type="password" name="reset_password" required class="w-full px-3 py-2 border rounded">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Đăng ký</button>
        </form>
        <p class="mt-4 text-center">Đã có tài khoản? <a href="login.php" class="text-blue-500">Đăng nhập</a></p>
    </div>
</body>
</html>