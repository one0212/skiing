<?php
// 建立資料庫連線
if (empty($db)) {
	$userDir = getenv('HOME');
	$config = parse_ini_file("$userDir" . DIRECTORY_SEPARATOR . "ski_db_conf.ini");
	$db = New PDO($config['dsn'],$config['username'],$config['password']);
}

// 測試連線  XAMPP的php版本，pdo 沒有 connect_error 這個屬性
//if ($db->connect_error) {
//    die("連接失敗: " . $db->connect_error);
//} 
unset($userDir, $config);
?>