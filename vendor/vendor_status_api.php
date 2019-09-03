<?php
require("../config.php"); 

$status = $_POST['status'];

// phpinfo();
$vendor_status_sql  = "UPDATE `MGNT_VENDOR` SET `status`=? , `update_time`= NOW() WHERE `bid` =?";
$status_stmt = $db->prepare($vendor_status_sql)->execute([
    $status,
    $_POST['bid']
]);

echo $status == 'enable' ? "啟用" : "停用";
/*
if (isset($_SESSION['bid'])){
$bid = $_SESSION['bid'];
$vendor_sql = "SELECT `status` FROM `MGNT_VENDOR` WHERE `bid` = '$bid' ";
$r = $db->query($vendor_sql)->fetch();
} else {
    // 沒登入，跳轉回登入頁
    error_log("未登入，跳轉回登入頁");
    header('Location: login.php');
}
*/