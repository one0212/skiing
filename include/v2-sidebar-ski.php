<?php
require("config.php");

$bid = $_SESSION['bid'];
?>
<nav class="navbar">
    <a class="navbar-brand" href="#">Navbar</a>
    <div class="d-flex justify-content-end">
    <ul class="nav">
        <?php if (isset($_SESSION['account'])) : ?>
            <li class="nav-item">
                <a class="text-light nav-link"><?= "Hello !  " . $_SESSION['account'] ?>
                    <!-- session_start();  -->
                </a>
            </li>
            <li class="nav-item">
            <a class="nav-link p-2 btn btn-secondary" href="logout.php">登出</a>
            </li>
        <?php else : ?>
            <li class="nav-item ">
               <a class="nav-link p-2 btn btn-secondary" href="login.php">登入</a>
            </li>
        <?php endif ?>
        <!-- <li><img src="" alt=""></li> -->
    </ul>
</div>
</nav>
<!-- --------------- ski ----------------- -->
<?php if($bid == "MAVL"):?>
<aside id="sidebar">
    <div class="sidebar-header">
        <a href=""><img class="svg-logo" src="images/skigo-logo.svg" alt="logo"></a>
    </div>
    <ul>
        <li>
            <a href="vendor.php">
                <i class="fas fa-user-friends"></i>公司資訊
            </a>
        </li>
        <li>
            <a href="ski_areas_list.php">
                <i class="fas fa-snowman"></i>雪場管理
            </a>
        </li>
        <li>
            <a href="__coach_list.php">
                <i class="fas fa-skiing"></i>教練管理
            </a>
        </li>
        <li class="hotel-click">
            <a href="#hotelSubmenu" data-toggle="collapse" aria-expanded="false">
                <i class="fas fa-igloo"></i>飯店管理<i class="fas fa-ellipsis-h Submenu-end"></i></a>
            <ul class="collapse active" id="hotelSubmenu">
                <li>
                    <a href="__hotel_room_data_list.php">飯店清單</a>
                </li>
                <li>
                    <a href="__hotel_insert.php">基本資料</a>
                </li>
                <li>
                    <a href="__hotel_room_list.php">房型管理</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-file-invoice-dollar fz-26"></i>訂單列表</a>
        </li>
        <li>
            <a href="ski_tickets_list.php">
                <i class="fas fa-ticket-alt"></i>票券管理</a>
        </li>
        <li>
            <a href="ski_rentals.php">
                <i class="fas fa-american-sign-language-interpreting"></i>裝備租借
            </a>
        </li>
</aside>
<!-- --------------- ski ----------------- -->
<!-- ----------------nike ------------------- -->
<?php elseif($bid == "BRTN"): ?>
<aside id="sidebar">
    <div class="sidebar-header">
        <a href=""><img class="svg-logo" src="images/skigo-logo.svg" alt="logo"></a>
    </div>
    <ul>
        <li>
            <a href="vendor.php">
                <i class="fas fa-user-friends"></i>公司資訊
            </a>
        </li>
        <li>
            <a href="BRAND_DATA.php"><i class="fas fa-skiing-nordic"></i>品牌管理</a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-box"></i>商品管理
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-file-invoice-dollar fz-26"></i>訂單列表
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-bullhorn"></i>促銷活動</a>
        </li>

</aside>
<!-- ---------------- nike ------------------- -->
<!-- ------------------ admin ------------------- -->
<?php elseif($bid == "XXXX"): ?>
<aside id="sidebar">
    <div class="sidebar-header">
        <a href=""><img class="svg-logo" src="images/skigo-logo.svg" alt="logo"></a>
    </div>
    <ul>
        <li>
            <a href="member.php">
                <i class="fas fa-user-friends"></i>會員管理
            </a>
        </li>
        <li>
            <a href="mgnt_vendor.php">
                <i class="fas fa-portrait fz-26"></i>廠商管理
            </a>
        </li>
        <li>
            <a href="Attractions.php"><i class="fas fa-mountain"></i>景點管理
        </a>
        </li>
        <li>
            <a href="#" data-toggle="collapse" aria-expanded="false">
                <i class="fas fa-search-dollar"></i>帳務管理
            </a>
        </li>

        <!-- <li class="Submenu-border">
                        <a href="#">折扣券</a>
                    </li> -->
    </ul>
</aside>
<?php endif; ?>
<!------------------ admin ------------------->

