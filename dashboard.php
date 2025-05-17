<?php
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Chào mừng bạn đến với Dvinhkaka <?php echo htmlspecialchars($user['username']); ?>!</h2>
        <p class="text-center">Bạn đã đăng nhập thành công!.</p>
        <a href="logout.php" class="block w-full bg-red-500 text-white py-2 rounded hover:bg-red-600 text-center mt-4">Đăng xuất</a>
    </div>
</body>
</html>