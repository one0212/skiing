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


$sql = "INSERT INTO `BRAND＿DATA`(
    `name`, `country`, `logo_image`, `video`, `web`, `about`, `update_time`)
        VALUES (?, ?, ?, ?, ?, ?, NOW())";


$stmt = $db->prepare($sql);

$stmt->execute([
    $_POST['name'],
    $_POST['country'],
    $_POST['logo_image'],
    $_POST['video'],
    $_POST['web'],
    $_POST['about'],
    
]);

if($stmt->rowCount() == 1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] ='新增成功';
} else{
    $result['code'] = 420;
    $result['info'] ='新增失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
