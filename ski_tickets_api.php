<?php
require("config.php");

$upload_dir = __DIR__. '/uploads/';

$sql = "INSERT INTO `MGNT_SKI_TICKETS`(
    `name`, `rate`,`type`, `ticket`, `description`
    ) VALUES (?, ?, ?, ?, ?)";
// 
$stmt = $db->prepare($sql);

$stmt->execute([
    $_POST['name'],
    $_POST['rate'],
    $_POST['type'],
    $_POST['ticket'],
    $_POST['description']
]);
 
if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
} else {
    $result['code'] = 420;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);