<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ./login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./reset.css" />
    <link rel="stylesheet" href="./style.css" />
    <title>Success</title>
    <style>
        .success-message { 
            color: green; 
            font-weight: bold; 
            text-align: center; 
            margin: 20px 0;
            opacity: 0;
            animation: fadeIn 1s forwards;
        }
        .wrapper { 
            max-width: 400px; 
            margin: 50px auto; 
            padding: 20px; 
        }
        .fade-in { 
            opacity: 0; 
            animation: fadeIn 1s forwards; 
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .logout-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            margin-top: 20px;
            opacity: 0;
            animation: fadeIn 1.5s forwards;
        }
        .logout-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="wrapper fade-in-down">
        <div id="form-content">
            <a href="./login.php">
                <h2 class="inactive underline-hover">Đăng nhập</h2>
            </a>
            <a href="./register.php">
                <h2 class="inactive underline-hover">Đăng ký</h2>
            </a>
            
            <div class="fade-in first">
                <img src="./imgs/avatar.png" id="avatar" alt="User Icon" />
            </div>

            <div class="success-message">
                Đăng nhập thành công! Chào mừng, <?= htmlspecialchars($_SESSION["username"]) ?>!
            </div>
            <a href="logout.php" class="logout-btn">Đăng xuất</a>
        </div>
    </div>
</body>
</html>