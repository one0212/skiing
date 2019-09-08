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

$image=0;

if(!empty($_FILES['image'])){ // 有沒有上傳
    if(in_array($_FILES['image']['type'], $allowed_types)) { // 檔案類型是否允許

        $image=1;
    }
}

$sql = "UPDATE `MGNT_SKI_RENTALS` SET
    `name`=?, `image`=?,`gender`=?, `type`=?, `size`=?, `time`=?, `quantity`=?, `price`=? WHERE `sid`=?";

$stmt = $db->prepare($sql);
    
$ggs = "SELECT * FROM `MGNT_SKI_RENTALS` WHERE sid='".$_POST['sid']."' and length(image)>0";
    $ggsq = $db->query($ggs);
    $ggsr = $ggsq->fetch();

    if($image==0){
        $_FILES['image']['name']=$ggsr['image'];
    }

$stmt->execute([
    $_POST['name'],
    $_FILES['image']['name'],
    $_POST['gender'],
    $_POST['type'],
    $_POST['size'],
    $_POST['time'],
    $_POST['quantity'],
    $_POST['price'],
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
