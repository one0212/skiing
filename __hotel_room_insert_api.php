<?php 
require("config.php"); 
// 連線資料
session_start();

// 自己的php

# 如果沒有輸入必要欄位, 就離開
// if(empty($_POST['room_name'])){
//     exit;
// }
try {
    $room_name = $_POST['room_name'];
    $room_type = $_POST['room_type'];
    $smoke = $_POST['smoke'];
    $pet = $_POST['pet'];
    $beds_number = $_POST['beds_number'];
    $beds_format = $_POST['beds_format'];  
    $room_area = $_POST['room_area'];  
    $person = $_POST['person'];
    $room_images = $_POST['room_images'];
    $hair_dryer = $_POST['hair_dryer'];
    $towel = $_POST['towel'];
    $robe = $_POST['robe'];
    $toiletries = $_POST['toiletries'];
    $mirror = $_POST['mirror'];
    $room_free_WiFi = $_POST['room_free_WiFi'];
    $telephone = $_POST['telephone'];
    $cable_television = $_POST['cable_television'];
    $movie = $_POST['movie'];
    $morning_call = $_POST['morning_call'];
    $air_conditioning = $_POST['air_conditioning'];
    $slippers = $_POST['slippers'];
    $heating = $_POST['heating'];
    $indoor_fireplace = $_POST['indoor_fireplace'];
    $noise_barrier = $_POST['noise_barrier'];
    $blackout_curtain = $_POST['blackout_curtain'];
    $electric_fans = $_POST['electric_fans'];
    $alarm_clock = $_POST['alarm_clock'];
    $balcony = $_POST['balcony'];
    $refrigerator = $_POST['refrigerator'];
    $free_bottled_water = $_POST['free_bottled_water'];
    $coffee_machine = $_POST['coffee_machine'];
    $carpet = $_POST['carpet'];
    $desk = $_POST['desk'];
    $workspace = $_POST['workspace'];
    $sofa = $_POST['sofa'];
    $kitchen = $_POST['kitchen'];
    $wardrobe = $_POST['wardrobe'];
    $open_wardrobe = $_POST['open_wardrobe'];
    $Iron = $_POST['Iron'];
    $dryer = $_POST['dryer'];
    $safe = $_POST['safe'];
    $smoke_detector = $_POST['smoke_detector'];
    $housekeeper = $_POST['housekeeper'];
    $accommodation_notice = $_POST['accommodation_notice'];
} catch (Exception $e) {
    error_log($e);
}

$sql = "INSERT INTO `MGNT_SKI_HOTELROOM` (`room_name`, `room_type`, `smoke`, `pet`, `beds_number`, `beds_format`, `room_area`, `person`,`room_images`, `hair_dryer`, `towel`, `robe`, `toiletries`, `mirror`, `room_free_WiFi`, `telephone`, `cable_television`, `movie`, `morning_call`, `air_conditioning`, `slippers`, `heating`, `indoor_fireplace`, `noise_barrier`, `blackout_curtain`, `electric_fans`, `alarm_clock`, `balcony`, `refrigerator`, `free_bottled_water`, `coffee_machine`, `carpet`, `desk`, `workspace`, `sofa`, `kitchen`, `wardrobe`, `open_wardrobe`, `Iron`, `dryer`, `safe`, `smoke_detector`, `housekeeper`, `accommodation_notice` ) VALUES (? ,? ,? ,? ,? ,
? ,? ,? ,? ,? ,
? ,? ,? ,? ,? ,
? ,? ,? ,? ,? ,
? ,? ,? ,? ,? ,
? ,? ,? ,? ,? ,
? ,? ,? ,? ,? ,
? ,? ,? ,? ,? ,
? ,? ,? ,?)";
$stmt = $db->prepare($sql);
$result = $stmt->execute([
    $room_name,
    $room_type,
    $smoke,
    $pet,
    $beds_number,
    $beds_format,
    $room_area,
    $person,
    $room_images,
    $hair_dryer,
    $towel,
    $robe,
    $toiletries,
    $mirror,
    $room_free_WiFi,
    $telephone,
    $cable_television,
    $movie,
    $morning_call,
    $air_conditioning,
    $slippers,
    $heating,
    $indoor_fireplace,
    $noise_barrier,
    $blackout_curtain,
    $electric_fans,
    $alarm_clock,
    $balcony,
    $refrigerator,
    $free_bottled_water,
    $coffee_machine,
    $carpet,
    $desk,
    $workspace,
    $sofa,
    $kitchen,
    $wardrobe,
    $open_wardrobe,
    $Iron,
    $dryer,
    $safe,
    $smoke_detector,
    $housekeeper,
    $accommodation_notice

]);

echo json_encode("$result", JSON_UNESCAPED_UNICODE);
// `room_images`, `hair_dryer`, `towel`, `robe`, `toiletries`, `mirror`, `room_free_WiFi`, `telephone`, `cable_television`, `movie`, `morning_call`, `air_conditioning`, `slippers`, `heating`, `indoor_fireplace`, `noise_barrier`, `blackout_curtain`, `electric_fans`, `alarm_clock`, `balcony`, `refrigerator`, `free_bottled_water`, `coffee_machine`, `carpet`, `desk`, `workspace`, `sofa`, `kitchen`, `wardrobe`, `open_wardrobe`, `Iron`, `dryer`, `safe`, `smoke_detector`, `housekeeper`, `accommodation_notice` 
// ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?

// $stmt = $pdo->prepare($sql);

// $stmt->execute([
//     $_POST['room_name'],
//     $_POST['room_type'],
//     $_POST['smoke'],
//     $_POST['pet'],
//     $_POST['beds_number'],
//     $_POST['beds_format'],
//     $_POST['room_area'],
//     $_POST['person'],
//     $_POST['room_introduction']
    //$_POST['room_images'],
    // $_POST['hair_dryer'],
    // $_POST['towel'],
    // $_POST['robe'],
    // $_POST['toiletries'],
    // $_POST['mirror'],
    // $_POST['room_free_WiFi'],
    // $_POST['telephone'],
    // $_POST['cable_television'],
    // $_POST['movie'],
    // $_POST['morning_call'],
    // $_POST['air_conditioning'],
    // $_POST['slippers'],
    // $_POST['heating'],
    // $_POST['indoor_fireplace'],
    // $_POST['noise_barrier'],
    // $_POST['blackout_curtain'],
    // $_POST['electric_fans'],
    // $_POST['alarm_clock'],
    // $_POST['balcony'],
    // $_POST['refrigerator'],
    // $_POST['free_bottled_water'],
    // $_POST['coffee_machine'],
    // $_POST['carpet'],
    // $_POST['desk'],
    // $_POST['workspace'],
    // $_POST['sofa'],
    // $_POST['kitchen'],
    // $_POST['wardrobe'],
    // $_POST['open_wardrobe'],
    // $_POST['Iron'],
    // $_POST['dryer'],
    // $_POST['safe'],
    // $_POST['smoke_detector'],
    // $_POST['housekeeper'],
    // $_POST['accommodation_notice'],
// ]);

    // if(isset($_POST["submit"])){
    //     if(!empty($POST["checkbox"])){
    //         foreach($_POST["checkbox"] as $checkbox)
    //     }
    // }


// if($stmt->rowCount()==1){
//     $result['success'] = true;
//     $result['code'] = 200;
//     $result['info'] = '新增成功';
// } else {
//     $result['code'] = 420;
//     $result['info'] = '新增失敗';
// }
// echo json_encode($result, JSON_UNESCAPED_UNICODE);

// echo $stmt->rowCount();

?>