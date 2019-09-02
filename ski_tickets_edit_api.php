<?php
require("config.php");

$sql = "UPDATE `MGNT_SKI_TICKETS` SET
    `name`=?, `rate`=?,`type`=?, `ticket`=?, `description`=? WHERE `sid`=?";

$stmt = $db->prepare($sql);
    
$stmt->execute([
    $_POST['name'],
    $_POST['rate'],
    $_POST['type'],
    $_POST['ticket'],
    $_POST['description'],
    $_POST['sid']
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
} else {
    $result['code'] = 420;
    $result['error'] = $_POST;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
