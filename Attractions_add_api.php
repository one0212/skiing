<?php

   require("config.php");

$result=[
    'success'=>false,
    'code'=>400,
    'info'=>'沒有輸入名稱',
    'post'=>$_POST
];


$upload_dir = __DIR__. '/uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];

$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];


// 如果沒有輸入必要欄位,就離開
if(empty($_POST['name'])){

    echo json_encode($result,JSON_UNESCAPED_UNICODE);

    exit;
}

if(!empty($_FILES['images'])){ // 有沒有上傳
    if(in_array($_FILES['images']['type'], $allowed_types)) { // 檔案類型是否允許

        move_uploaded_file($_FILES['images']['tmp_name'], $upload_dir.$_FILES['images']['name']);
    }
}




$sql = "INSERT INTO `attractions_data`(
     `master_id`, `classification_id`,`images`, `name`, `address`, `Business-hours`, `Close-shop`, `price`, `phone`, `information`, `x,y`, `Introduction`
    ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";

// 用$stmt物件 接收pdo物件
$stmt = $db->prepare($sql);

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
]); 



// 判斷有沒有新增
if($stmt->rowCount()==1){
    $result['success']=true;
    $result['code']=200;
    $result['info']='新增成功';
}else{
    $result['code']=420;
    $result['info']='新增失敗';
}




echo json_encode($result,JSON_UNESCAPED_UNICODE);