<?php
require("config.php");

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if(! empty($sid)) {
    $sql = "DELETE FROM `MGNT_SKI_RENTALS` WHERE `sid`=$sid";
    $db->query($sql);
}

header('Location: '. $_SERVER['HTTP_REFERER']);