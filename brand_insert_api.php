<?php require("config.php"); // 連線資料


#如果品牌名稱是空值
if(empty($_POST['brand_name'])){
    exit;

}

// 建立樣板
$sql = "INSERT INTO `brand_data`
(`brand_name`, `brand_since`, `country_id`, `brand_about`, `brand_logo`) 
VALUES (?, ?, ?, ?, ?)";

$stmt = $db->prepare($sql);

$stmt->execute([
    $_POST['brand_name'],
    $_POST['brand_since'],
    $_POST['country_id'],
    $_POST['brand_about'],
    $_POST['brand_logo'],
]);
echo $stmt->rowCount();


