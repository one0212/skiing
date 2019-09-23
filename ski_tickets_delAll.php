<?php
require("config.php");
$sid = isset($_GET['sid']) ? ($_GET['sid']) : '';

// if(! empty($sid)){
    
        // $sql = "DELETE FROM `MGNT_SKI_TICKETS` WHERE `sid` IN ($sid)";
    $db->query("DELETE FROM `MGNT_SKI_TICKETS` WHERE `sid` IN ($sid)");
    

    
// }


header('Location: '. $_SERVER['HTTP_REFERER']);