<?php 
require_once("config.php");

$bid = $_SESSION['bid'];
$sql = "SELECT mf.name, mf.path" .
    " FROM SKI.MGNT_FUNCTION mf INNER JOIN SKI.MGNT_ADMIN_FUNCTION maf ON maf.FUNC_CODE = mf.CODE" .
    " WHERE maf.BID = '$bid'";
$rows = $db->query($sql)->fetchAll();
 ?>

<link rel="stylesheet" href="css/sidebar.css">
    <aside>
        <ul id="manage">
        <?php
        foreach($rows as $row) {
            $function_name = $row['name'];
            $function_path = $row['path'];
            echo "<li class='sidebar-item'><a href='$function_path'>$function_name</a></li>";
            // <li class="sidebar-item"><a href="#">會員管理</a></li>
            // <li class="sidebar-item"><a href="ski_areas.php">雪場資訊管理</a></li>
            // <li class="sidebar-item"><a href="#">教練管理</a></li>
            // <li class="sidebar-item">
            //     <a href="#">飯店資訊管理
            //         <div class="sidebar-submenu">
            //         <a class="submenu-item" href="#">基本資料</a>
            //         <a class="submenu-item" href="#">房型管理</a>
            //         </div>
            //     </a>
            // </li>
            // <li class="sidebar-item"><a href="#">雪具租借管理</a></li>
            // <!-- <li class="sidebar-item"><a href="#">新增商品</a></li> -->
            // <li class="sidebar-item"><a href="#">品牌廠商管理</a></li>
            // <li class="sidebar-item"><a href="#">景點管理</a></li>
            // <li class="sidebar-item"><a href="#">訂單管理</a></li> 
            // <li class="sidebar-item"><a href="vendor.php">基本資料</a></li>
        }
        ?>
        </ul>
    </aside>