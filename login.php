<?php
require("config.php");
require("ski_utils.php");

session_start();
if (isset($_SESSION['bid'])) {
    error_log("已登入");
    redirectTo("home_page.php");
} elseif (isset($_POST['account']) && isset($_POST['password'])) {

    $account = $_POST['account'];
    $password = $_POST['password'];
    $sql = "SELECT bid, account FROM MGNT_ADMIN WHERE account = '$account' AND password = '$password' and status = 'enable'";
    $result = $db->query($sql)->fetch();

    if (empty($result)) {
        error_log("帳號密碼錯誤");
    } else {
        $_SESSION['bid'] = $result['bid'];
        $_SESSION['account'] = $result['account'];
        redirectTo("home_page.php");
    }
}

?>
<?php include("include/v2-head.php"); ?>
<!-- <!DOCTYPE html>
<html lang="zh-hant">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SKI 管理後台 - 登入頁</title>
</head>

<body> -->
<!-- <link rel="stylesheet" type="text/css" href="css/login.css"> -->
<!-- <header></header> -->
<!-- 如果帳密不符合則繼續停留在表單上 -->
<!-- <form class="login-form" method="post">  -->
<!-- 傳表單給自己所以不用action -->
<!-- <label for="account" class="b-block login-label">帳號<input class="b-block login-input" type="text" name="account" placeholder=" 請輸入帳號"/>
            <label for="password" class="b-block login-label">密碼<input class="b-block login-input" type="password" name="password" placeholder=" 請輸入密碼"/>
            <button class="login-button" type="submit">登入</button>
        </form> -->

<div class="container text-dark">
    <div class="row" style="height:100vh" class="">
    <div class="col-1"></div>
        <div class="card col-4 my-auto d-flex flex-row align-items-center justify-content-center" style="min-height:350x">
            <div class="card-body">
                <h5 class="card-title mt-4">登入</h5>
                <form name="" method="post" class="d-flex flex-column">
                    <div class="form-group my-3">
                        <label class="" for="" type="text" name="account">帳號</label>
                        <input type="text" class="form-control" id="" name="account" placeholder=" 請輸入帳號">
                        <small id="emailHelp" class="form-text"></small>
                    </div>
                    <div class="form-group my-3">
                        <label for="password" name="password">密碼</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder=" 請輸入密碼">
                        <small id="passwordHelp" class="form-text"></small>
                    </div>
                    <button type="submit" class="btn btn-secondary ml-auto mt-3" id="submit_btn">登入</button>
                </form>
            </div>
        </div>
<div class="col-1"></div>
        <img src="images/skigo-logo.svg" alt="" class="col-6">

    </div>

</div>
</body>

</html>