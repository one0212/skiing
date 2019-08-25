<?php
// 建立資料庫連線
$userDir = getenv('HOME');
$config = parse_ini_file("$userDir/ski_db_conf.ini");
$db = New PDO($config['dsn'],$config['username'],$config['password']);

// 測試連線
if ($db->connect_error) {
    die("連接失敗: " . $db->connect_error);
} 
unset($userDir, $config);
?>