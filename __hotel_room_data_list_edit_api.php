<?php 
require("config.php"); 

$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];


# 如果沒有輸入必要欄位
// if(empty($_POST['room_name']) or empty($_POST['sid'])){
//     echo json_encode($result, JSON_UNESCAPED_UNICODE);
//     exit;
// }

// TODO: 檢查必填欄位, 欄位值的格式

# \[value\-\d\]

$sql = "UPDATE `MGNT_SKI_HOTELROOM` SET 
            `room_name`=?, `room_type`=?, `smoke`=?, `pet`=?, `beds_number`=?, `beds_format`=?, `room_area`=?, `person`=?,`room_images`=?, `hair_dryer`=?, `towel`=?, `robe`=?, `toiletries`=?, `mirror`=?, `room_free_WiFi`=?, `telephone`=?, `cable_television`=?, `movie`=?, `morning_call`=?, `air_conditioning`=?, `slippers`=?, `heating`=?, `indoor_fireplace`=?, `noise_barrier`=?, `blackout_curtain`=?, `electric_fans`=?, `alarm_clock`=?, `balcony`=?, `refrigerator`=?, `free_bottled_water`=?, `coffee_machine`=?, `carpet`=?, `desk`=?, `workspace`=?, `sofa`=?, `kitchen`=?, `wardrobe`=?, `open_wardrobe`=?, `Iron`=?, `dryer`=?, `safe`=?, `smoke_detector`=?, `housekeeper`=?, `accommodation_notice`=?
            WHERE `sid`=?";

$stmt = $db->prepare($sql);

$stmt->execute([
        $_POST['room_name'],
        $_POST['room_type'],
        $_POST['smoke'],
        $_POST['pet'],
        $_POST['beds_number'],
        $_POST['beds_format'],
        $_POST['room_area'],
        $_POST['person'],
        $_POST['room_images'],
        $_POST['hair_dryer'],
        $_POST['towel'],
        $_POST['robe'],
        $_POST['toiletries'],
        $_POST['mirror'],
        $_POST['room_free_WiFi'],
        $_POST['telephone'],
        $_POST['cable_television'],
        $_POST['movie'],
        $_POST['morning_call'],
        $_POST['air_conditioning'],
        $_POST['slippers'],
        $_POST['heating'],
        $_POST['indoor_fireplace'],
        $_POST['noise_barrier'],
        $_POST['blackout_curtain'],
        $_POST['electric_fans'],
        $_POST['alarm_clock'],
        $_POST['balcony'],
        $_POST['refrigerator'],
        $_POST['free_bottled_water'],
        $_POST['coffee_machine'],
        $_POST['carpet'],
        $_POST['desk'],
        $_POST['workspace'],
        $_POST['sofa'],
        $_POST['kitchen'],
        $_POST['wardrobe'],
        $_POST['open_wardrobe'],
        $_POST['Iron'],
        $_POST['dryer'],
        $_POST['safe'],
        $_POST['smoke_detector'],
        $_POST['housekeeper'],
        $_POST['accommodation_notice'],
        $_POST['sid'],
]);

if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '資料沒有修改';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);








