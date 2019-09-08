<?php
require("config.php");

$upload_dir = __DIR__. '/uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];

$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];


if(!empty($_FILES['image'])){ // 有沒有上傳
    if(in_array($_FILES['image']['type'], $allowed_types)) { // 檔案類型是否允許

        move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir.$_FILES['image']['name']);
    }
}

$sql = "INSERT INTO `MGNT_SKI_RENTALS`(
    `name`, `image`,`gender`, `type`, `size`, `time`, `quantity`, `price`
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
// 
$stmt = $db->prepare($sql);

$stmt->execute([
    $_POST['name'],
    $_FILES['image']['name'],
    $_POST['gender'],
    $_POST['type'],
    $_POST['size'],
    $_POST['time'],
    $_POST['quantity'],
    $_POST['price']
]);
 
if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
} else {
    $result['code'] = 420;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);