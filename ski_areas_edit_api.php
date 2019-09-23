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

$ski_image=0;
$ski_map=0;
$hostel_image=0;

if(!empty($_FILES['ski_image'])){ // 有沒有上傳
    if(in_array($_FILES['ski_image']['type'], $allowed_types)) { // 檔案類型是否允許

        $ski_image=1;
    }
}

if(!empty($_FILES['ski_map'])){ // 有沒有上傳
    if(in_array($_FILES['ski_map']['type'], $allowed_types)) { // 檔案類型是否允許

        $ski_map=1;
    }
}

if(!empty($_FILES['hostel_image'])){ // 有沒有上傳
    if(in_array($_FILES['hostel_image']['type'], $allowed_types)) { // 檔案類型是否允許

        $hostel_image=1;
    }
}

$sql = "UPDATE `MGNT_SKI_AREAS` SET
    `name`=?, `country`=?, `address`=?, `number_of_courses`=?, `acreage`=?, `longest_run`=?,
     `slop_gradient`=?, `vertical_drop`=?, `ski_image`=?, `ski_map`=?, `skiing_season_s`=?,
     `skiing_season_e`=?, `business_hours_s`=?, `business_hours_e`=?, `tickets`=?, `rentals`=?, 
     `lessons`=?, `hostel`=?, `hostel_image`=?, `access_car`=?, `access_bus`=?, `access_train`=?,
     `description`=? WHERE `sid`=?";

$stmt = $db->prepare($sql);

$ggs = "SELECT * FROM `MGNT_SKI_AREAS` WHERE sid='".$_POST['sid']."' and length(ski_image)>0";
    $ggsq = $db->query($ggs);
    $ggsr = $ggsq->fetch();

    if($ski_image==0){
        $_FILES['ski_image']['name']=$ggsr['ski_image'];
    }
$ggs2 = "SELECT * FROM `MGNT_SKI_AREAS` WHERE sid='".$_POST['sid']."' and length(ski_map)>0";
    $ggsq2 = $db->query($ggs2);
    $ggsr2 = $ggsq2->fetch();

    if($ski_map==0){
        $_FILES['ski_map']['name']=$ggsr2['ski_map'];
    }
$ggs3 = "SELECT * FROM `MGNT_SKI_AREAS` WHERE sid='".$_POST['sid']."' and length(hostel_image)>0";
    $ggsq3 = $db->query($ggs3);
    $ggsr3 = $ggsq3->fetch();

    if($hostel_image==0){
        $_FILES['hostel_image']['name']=$ggsr3['hostel_image'];
    }
    
$stmt->execute([
    $_POST['name'],
    $_POST['country'],
    $_POST['address'],
    $_POST['number_of_courses'],
    $_POST['acreage'],
    $_POST['longest_run'],
    $_POST['slop_gradient'],
    $_POST['vertical_drop'],
    $_FILES['ski_image']['name'],
    $_FILES['ski_map']['name'],
    $_POST['skiing_season_s'],
    $_POST['skiing_season_e'],
    $_POST['business_hours_s'],
    $_POST['business_hours_e'],
    $_POST['tickets'],
    $_POST['rentals'],
    $_POST['lessons'],
    $_POST['hostel'],
    $_FILES['hostel_image']['name'],
    $_POST['access_car'],
    $_POST['access_bus'],
    $_POST['access_train'],
    $_POST['description'],
    $_POST['sid']
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
} else {
    $result['code'] = 420;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
