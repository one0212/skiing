<?php session_start(); ?>

<!DOCTYPE html>
<html lang="zh-hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <title>SKI 管理後台 - 首頁</title>
</head>
<body>
<?php include("include/__sidebar.php") ?>
<?php 
    echo "歡迎! " . $_SESSION['account']
?>
<a href="logout.php">登出</a>
</body>