<?php
require_once 'database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang tổng quan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Chào mừng bạn đến với Dvinhkaka. <?php echo htmlspecialchars($user['username']); ?>!</h2>
        <p class="text-center mb-4">Bạn đã đăng nhập thành công.</p>
        <a href="logout.php" class="block w-full bg-red-500 text-white p-2 rounded hover:bg-red-600 text-center">Đăng Xuất</a>
    </div>
</body>
</html>