<?php require("config.php"); // 連線資料

$result = [
    'success' => false,
    'code' => 400,
    'info' => '請輸入品牌名稱',
    'post' => $_POST,

];

if(empty($_POST['name'])){ 
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}



$sql = "UPDATE `BRAND＿DATA` SET
     `name`=?,
     `country`=?, 
     `logo_image`=?,
     `video`=?,
     `web`=?,
     `about`=?
     WHERE `sid`=?";

$stmt = $db->prepare($sql);



$stmt->execute([
    $_POST['name'],
    $_POST['country'],
    $_POST['logo_image'],
    $_POST['video'],
    $_POST['web'],
    $_POST['about'],
    $_POST['sid'],
]);

if($stmt->rowCount() == 1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] ='修改成功';
} else{
    $result['code'] = 420;
    $result['info'] ='修改失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
