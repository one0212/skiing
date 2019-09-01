<?php

require __DIR__.'/config.php';

// TODO: 檢查必填欄位, 欄位值的格式
$sql = 'INSERT INTO `mgnt_coach` (`sid`, `name`, `male`, `lan`, `local`, `License`, `skiage`, `Experience`, `idea`, `skiclass`, `price`) VALUES (NULL, ?, ?, ?, ?,?,?,?, ?,?, ?)';
    // echo $sql;

    // $db->query($s);

 $stmt = $db->prepare($sql);

 $stmt->execute([
         $_POST['name'],
         $_POST['male'],
         $_POST['lang'],
         $_POST['local'],
         $_POST['lic'],
         $_POST['skiage'],
         $_POST['Experience'],
         $_POST['idea'],
         $_POST['class'],
         $_POST['price'],
 ]);

if ($stmt->rowCount() == 1) {//變動欄位數
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
