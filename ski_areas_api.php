<?php
require("config.php");


$sql = "INSERT INTO `MGNT_SKI_AREAS`(
    `name`, `country`, `address`, `number_of_courses`, `acreage`, `longest_run`,
     `slop_gradient`, `vertical_drop`, `ski_image`, `ski_map`, `skiing_season`, 
     `business_hours`, `tickets`, `rentals`, `lessons`, `hostel`, `hostel_image`, 
     `access_car`, `access_bus`, `access_train`, `description`
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $db->prepare($sql);

$stmt->execute([
    $_POST['name'],
    $_POST['country'],
    $_POST['address'],
    $_POST['number_of_courses'],
    $_POST['acreage'],
    $_POST['longest_run'],
    $_POST['slop_gradient'],
    $_POST['vertical_drop'],
    $_POST['ski_image'],
    $_POST['ski_map'],
    $_POST['skiing_season'],
    $_POST['business_hours'],
    $_POST['tickets'],
    $_POST['rentals'],
    $_POST['lessons'],
    $_POST['hostel'],
    $_POST['hostel_image'],
    $_POST['access_car'],
    $_POST['access_bus'],
    $_POST['access_train'],
    $_POST['description']
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
