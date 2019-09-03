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
$upload_dir = __DIR__. '/uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];

$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];





$images=0;
if(!empty($_FILES['images'])){ // 有沒有上傳
    if(in_array($_FILES['images']['type'], $allowed_types)) { // 檔案類型是否允許

        
        $images=1;
    }
}


$sql = "UPDATE `attractions_data` SET 

            `master_id`=?,
            `classification_id`=?,
            `images`=?,
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

$ggs = "SELECT * FROM `attractions_data` WHERE sid='".$_POST['sid']."' and length(images)>0";
    $ggsq = $db->query($ggs);
    $ggsr = $ggsq->fetch();

    if($images==0){
        $_FILES['images']['name']=$ggsr['images'];
    }




// 需要對應上面INSERT INTO
$stmt->execute([
    $_POST['master_id'],
    $_POST['classification_id'],
    $_FILES['images']['name'],
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
