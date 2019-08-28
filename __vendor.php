<?php
require("config.php");
require("ski_utils.php");

session_start();

// 先檢查是否登入
if (isset($_SESSION['bid'])){
    // 廠商已登入，檢查廠商是否已經有資料
    $bid = $_SESSION['bid'];
    $count_vendor_sql = "SELECT count(1) FROM `MGNT_VENDOR` WHERE `bid` = $bid";
} else {
    // 沒登入，跳轉回登入頁
    error_log("未登入，跳轉回登入頁");
    header('Location: login.php');
}

  // 檢查廠商是否已經有資料
if ($count_vendor_sql != 0) {
    // 當前廠商已有資料，先撈出當前的資料
    $vendor_data = "SELECT `company_no`, `address`, `bank_account`, `principal`, `web_site`, `contact_person`, `contact_email`, `contact_number`, `remark` from `MGNT_VENDOR_DETAIL`";



/*
    $vendor_sql = "INSERT INTO `MGNT_VENDOR`(`bid`, `name`, `status`, `create_time`, `update_time`) VALUES (?, ?, 'disable', NOW(), NOW())";
    $vendor_stmt = $db->prepare($vendor_sql)->execute([
            $_POST['bid'],
            $_POST['name'],
            $_POST['create_time'],
            $_POST['update_time']
    ]);
*/
}


$vendor_detail_sql = "INSERT INTO `MGNT_VENDOR_DETAIL`(`bid`, `company_no`, `address`, `bank_account`, `principal`, `web_site`, `contact_person`, `contact_email`, `contact_number`, `remark`, `update_time`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

$vendor_detail_stmt = $db->prepare($vendor_detail_sql)->execute([
    $_POST['company_no'],
    $_POST['address'],
    $_POST['bank_account'],
    $_POST['principal'],
    $_POST['web_site'],
    $_POST['contact_person'],
    $_POST['contact_email'],
    $_POST['contact_number'],
    $_POST['remark']
])

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/vendor.css">
    
    <title>Document</title>
</head>
<body>
    <div id="wrapper" style="max-width:1024px;display:flex;">
    <?php
    include("include/__sidebar.php");
    ?>
        <div class="form">
            <form action="">
                <label for="">公司名稱</label><input type="text" name="name">
                <label for="">統一編號／公司行號</label><input type="text" name="company">
                <label for="">帳戶資訊</label><input type="text" name="bank_account">
                <label for="">負責人</label><input type="text" name="principal">
                <label for="">公司地址</label><input type="text" name="">
                <label for="">公司網站</label><input type="text" name="">
                <label for="">聯絡人<input class="checkbox" type="checkbox">同負責人</label><input type="text" name="">
                <label for="">聯絡人電話</label><input type="text" name="">
                <label for="">聯絡人e-mail</label><input type="text" name="">
                <label for="">備註</label><input type="text" name="">
            </form>
        </div>
        <!-- <input  type="button" value=""> -->
        <button class="submit">編輯完成</button>
    </div>
</body>
</html>