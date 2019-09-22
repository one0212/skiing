<?php

// $brand = ['skiing/vendor.php',
//           'skiing/BRAND_DATA.php'];

// $ski = ['skiing/vendor.php',
//         'skiing/ski_area_list.php',
//         'skiing/__coach_list.php',
//         'skiing/__hotel_room_data_list.php',
//         'skiing/__hotel_insert.php',
//         'skiing/__hotel_room_list.php',
//         'skiing/ski_tickets_list.php',
//         'skiing/ski_rentals.php',
//     ];

$bid = $_SESSION['bid'];
if ($bid == "XXXX") {
    $admin = array(
        '/skiing/vendor/vendor_status_api.php',
        '/skiing/mgnt_vendor.php'
    );

    $request_uri = $_SERVER['REQUEST_URI'];

    foreach ($admin as $url) {
        // echo "request: $request_uri 比對權限 $url";
        if ($url == $_SERVER['REQUEST_URI']) {
            break;
        } elseif ($url === $admin[count($admin) - 1] && $url !== $_SERVER['REQUEST_URI']) {
            header("Location:home_page.php");
        }
    }
} else {
    header("Location:home_page.php");
}
