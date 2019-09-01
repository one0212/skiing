<?php

require __DIR__. '/config.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if(! empty($sid)) {
    $sql = "DELETE FROM `mgnt_coach` WHERE `sid`=$sid";
    $db->query($sql);
}

header('Location: '. $_SERVER['HTTP_REFERER']);