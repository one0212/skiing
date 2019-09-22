<?php
class Vendor {
    public $bid;
    public $type;
    public $name;
    public $status;
    public $create_time;
    public $update_time;
}
?>

<?php
require("../config.php"); 

$bid = $_POST['bid'];
$status = $_POST['status'];

// phpinfo();
$vendor_status_sql  = "UPDATE `MGNT_VENDOR` SET `status`=? , `update_time`= NOW() WHERE `bid` =?";
$status_stmt = $db->prepare($vendor_status_sql)->execute([
    $status,
    $bid
]);

$vendor_status_sql  = "UPDATE `MGNT_ADMIN` SET `status`=? , `update_time`= NOW() WHERE `bid` =?";
$status_stmt = $db->prepare($vendor_status_sql)->execute([
    $status,
    $bid
]);

// $query_vendor_sql = "SELECT BID as bid, 
//                     NAME as name, 
//                     STATUS as status, 
//                     CREATE_TIME as createTime, 
//                     UPDATE_TIME as updateTime
//                     FROM `MGNT_VENDOR` 
//                     WHERE BID = '$bid'";
$query_vendor_sql = "SELECT bid,
                    type,
                    name, 
                    status, 
                    create_time, 
                    update_time
                    FROM `MGNT_VENDOR` 
                    WHERE BID = '$bid'";
$vendor = $db->query($query_vendor_sql)->fetchObject("Vendor");

echo json_encode($vendor);

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