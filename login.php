<?php
require("config.php");
require("ski_utils.php");

session_start();
if (isset($_SESSION['bid'])) {
    console_log("已登入");
} elseif (isset($_POST['account']) && isset($_POST['password'])){

    $account = $_POST['account'];
    $password = $_POST['password'];   
    $sql = "SELECT bid FROM MGNT_ADMIN WHERE account = '$account' AND password = '$password'";
    $result = $db->query($sql)->fetch();

    if (empty($result)) {
        console_log("帳號密碼錯誤");
    } else {
        $_SESSION['bid'] = $result['bid'];
    }
}
?>
<!DOCTYPE html>
<html lang="zh-hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>SKI 管理後台</title>
</head>
<body>
<?php if (isset($_SESSION['bid'])): ?>
    <h2><?= $_SESSION['bid']?> , 您好</h2>
    <p><a href="0816_07_logout.php">登出</a></p>
<?php else: ?>
<!-- <div class="wrapper"> -->
    <header></header>
    <div class="container">
    <!-- 如果帳密不符合則繼續停留在表單上 -->
        <form action="" method="post"> 
        <!-- 傳表單給自己所以不用action -->
            <label for="" class="b-block">帳號<input class="b-block" type="text" name="account" placeholder=" 請輸入帳號"/>
            <label for="" class="b-block">密碼<input class="b-block" type="password" name="password" placeholder=" 請輸入密碼"/>
            <input class="submit" type="submit" value="登入"/>
        </form>
    </div>
    <footer></footer>
<!-- </div> -->
<?php endif; ?>

</body>
</html>