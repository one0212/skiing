<?php
// 建立資料庫連線
$userDir = getenv('HOME');
$config = parse_ini_file("$userDir/config.ini");
$db = New mysqli($config['servername'],$config['username'],$config['password'],$config['dbname']);

// 測試連線
if ($db->connect_error) {
    die("連接失敗: " . $db->connect_error);
} 
echo "連接成功";
unset($userDir, $config);
?>