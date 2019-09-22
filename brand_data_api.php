<?php require("config.php"); //資料庫連線

#如果沒有輸入必要欄位 就離開
if(empty($_POST['brand_name'])){ 
    exit;
}

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



#寫入資料
$sql = "INSERT INTO `brand_data`
(`brand_name`, `brand_Since`, `country_sid`, `brand_about`, `brand_return`, `update_time`) 
VALUES (? ,? ,? ,? ,? ,NOW())";

$stmt = $db->prepare($sql);

$stmt->execute([
    $_POST['brand_name'],
    $_POST['brand_Since'],
    $_POST['country_sid'],
    $_POST['brand_about'],
    $_POST['brand_return'],

    
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