<?php
exit; // 直接終止
// die('---'); 結束之前想要echo什麼字串


require "../config.php";
// ---------------------------------

for($i=1; $i<5; $i++) {
    // $pdo -> query("INSERT INTO `address_book`(`name`,`email` ,`birthday`, `mobile`, `create_at`) VALUES
    // ('陳小華{$i}', 'jhdsj@gmail.com', '1991-02-02', '0912777888', '2019-08-20 12:00:00')");


    $s = "INSERT INTO `MGNT_VENDOR`(`bid`, `name`, `status`, `create_time`, `update_time`) VALUES ('sn0{$i}', '小明{$i}', 'disable', NOW(), Now()) ";
    //    echo $s;
    //    break;
    $db->query($s);
}