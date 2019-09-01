<?php
require __DIR__.'/config.php';

$result = [
        'success' => false,
        'code' => 400,
        'info' => '資料欄位不足',
        'post' => $_POST,
    ];
    
    
    # 如果沒有輸入必要欄位
    if(empty($_POST['name']) or empty($_POST['sid'])){
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

$sql = "UPDATE `mgnt_coach` SET 
            `name`=?,
            `male`=?,
            `lan`=?,
            `local`=?,
            `License`=?,
            `skiage`=?,
            `Experience`=?,
            `idea`=?,
            `skiclass`=?,
            `price`=?
        --     `price`=?
            WHERE `sid`=?";
// echo $sql;
          
    

    //  $db->query($sql);

 $stmt = $db->prepare($sql);

 $stmt->execute([
         $_POST['name'],
         $_POST['male'],
         $_POST['lan'],
         $_POST['local'],
         $_POST['License'],
         $_POST['skiage'],
         $_POST['Experience'],
         $_POST['idea'],
         $_POST['skiclass'],
         $_POST['price'],
         $_POST['sid'],
  ]);
//   echo $_POST['name'];

 if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
    $result['name'] = $_POST['name'];

} else {
    $result['code'] = 420;
    $result['info'] = '資料沒有修改';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);

