<?php

require("config.php");

$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST
];


// 如果沒有輸入必要欄位,就離開
if (empty($_POST['name']) or empty($_POST['sid'])) {
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "UPDATE `attractions_data` SET 

            `master_id`=?,
            `classification_id`=?,
            
            `name`=?,
            `address`=?,
            `Business-hours`=?,
            `Close-shop`=?,
            `price`=?,
            `phone`=?,
            `information`=?,
            `x,y`=?,
            `Introduction`=? 
            WHERE `sid`=?";

// 用$stmt物件 接收pdo物件
$stmt = $db->prepare($sql);

// 需要對應上面INSERT INTO
$stmt->execute([
    $_POST['master_id'],
    $_POST['classification_id'],
    
    $_POST['name'],
    $_POST['address'],
    $_POST['Business-hours'],
    $_POST['Close-shop'],
    $_POST['price'],
    $_POST['phone'],
    $_POST['information'],
    $_POST['x,y'],
    $_POST['Introduction'],
    $_POST['sid'],
]);




if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '修改失敗';
}




echo json_encode($result, JSON_UNESCAPED_UNICODE);
