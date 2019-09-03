<?php require("config.php"); // 連線資料


$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if(! empty($sid)) {
    $sql = "DELETE FROM `BRAND＿DATA` WHERE `sid`=$sid";
    $db->query($sql);
}

header('Location:'. $_SERVER['HTTP_REFERER']); //Location: : 別忘了
 