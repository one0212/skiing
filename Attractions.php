<?php require("config.php");
// 連線資料

// 這個變數 用在<title>標籤中
$page_title = '資料列表';
// 這個變數 是用在下面引入的navbar檔案
$page_name = 'datalist';

// isset拿來判斷變數 GET是從用戶那邊過來的 intval拿到變數的整數值
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// 設定每頁顯示幾筆資料
$per_page = 10;

// SQL語法COUNT(*)可以算出資料表有幾筆資料 筆數跟內容無關
$t_sql = "SELECT COUNT(*) FROM `attractions_data` WHERE 1";
// 拿到一個資料集
$t_stmt = $db->query($t_sql);
// 拿到總筆數  這會拿到索引式陣列PDO::FETCH_NUM 代表第一個元素[0]
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
// ceil是無條件進位為整數 讓總筆數 除 每頁顯示幾筆資料 就會拿到總頁數
$totalPages = ceil($totalRows / $per_page);

// 如果page的頁數小於1 就會回到第一頁
if ($page < 1) {
    header('Location:Attractions.php');
    exit;
}

// 如果頁數超過總頁數 就會回到最後一頁 
if ($page > $totalPages) {
    header('Location:Attractions.php?page=' . $totalPages);
    exit;
}

// 顯示出 ($page-1)*$per_page第幾頁要出現  $per_page出現做多幾筆資料  DESC升冪 ASC降冪
$sql = sprintf(
    "SELECT * FROM `attractions_data` ORDER BY `sid` ASC LIMIT %s, %s",
    // ($page-1)*$per_page算出來索引
    ($page - 1) * $per_page,
    $per_page
);
$stmt = $db->query($sql);
// 拿出所有資料fetchAll() 以陣列方式呈現
// $rows = $stmt->fetchAll();

?>


<!-- 判斷$page_title這個變數是否有值 -->
<title><?= isset($page_title) ? $page_title : '景點管理' ?></title>


<?php include("include/__head.php"); ?>
<!-- HTML開頭＋link -->
<link rel="stylesheet" href="fontawesome/css/all.css">
<?php include("include/__navbar.php"); ?>
<!-- 導覽列 bootstrap的code -->


<div id="" style="display:flex; max-width:100%;">
    

    <?php include("include/__sidebar.php"); ?>
    <!-- 側邊欄 -->

    

    <div class="container" >

  
        <nav aria-label="Page navigation example" style="margin-top:100px">
            <ul class="pagination">

                <li class="page-item ">
                    <a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fas fa-caret-left"></i></a>
                <li>
                    <!-- 用for迴圈來寫頁籤 -->
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                <li>
                <?php endfor; ?>


                <li class="page-item ">
                    <a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fas fa-caret-right"></i></a>
                <li>
            </ul>
        </nav>


        <table class="table  table-dark">
            <thead>
                <tr class="table-active">
                    <th scope="col">流水號</th>
                    <th scope="col">雪場id</th>
                    <th scope="col">類型id</th>
                    <th scope="col">圖檔位置</th>
                    <th scope="col">名稱</th>
                    <th scope="col">地址</th>
                    <th scope="col">營業時間</th>
                    <th scope="col">公休日</th>
                    <th scope="col">費用</th>
                    <th scope="col">電話</th>
                    <th scope="col">相關資訊</th>
                    <th scope="col">x,y座標</th>
                    <th scope="col">景點介紹</th>
                    <th scope="col"><i class="fas fa-trash"></i></th>
                    <th scope="col"><i class="fas fa-pen-square"></i></th>
                </tr>
            </thead>
            <tbody>

                <!-- 用while迴圈搭配 fetch 把資料一筆一筆取出  資料呈現一次時使用-->
                <?php while ($a = $stmt->fetch()) { ?>
                    <tr>
                        <td><?= $a['sid'] ?> </td>
                        <td><?= $a['master_id'] ?></td>
                        <td><?= $a['classification_id'] ?></td>
                        <td><?= $a['images'] ?></td>
                        <!-- htmlentities() 資料顯示出來時可以做跳脫的動作 防止別人再新增資料寫入標籤或程式-->
                        <td><?= htmlentities($a['name']) ?></td>
                        <td><?= htmlentities($a['address']) ?></td>
                        <td><?= htmlentities($a['Business-hours']) ?></td>
                        <td><?= htmlentities($a['Close-shop']) ?></td>
                        <td><?= htmlentities($a['price']) ?></td>
                        <td><?= htmlentities($a['phone']) ?></td>
                        <td><?= htmlentities($a['information']) ?></td>
                        <td><?= htmlentities($a['x,y']) ?></td>
                        <td><?= htmlentities($a['Introduction']) ?></td>
                        <td><a href="javascript:delete_one(<?=$a['sid']?>)"><i class="fas fa-trash"></i></a></td>
                        <td><a href="Attractions_data_edit.php?sid=<?=$a['sid']?>"><i class="fas fa-pen-square"></i></a></td>
                    </tr>
                <?php }  ?>
            </tbody>
        </table>



    </div>
        <script>
            function delete_one(sid) {
                if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                    location.href='Attractions_data_delete.php?sid='+sid;
                }
                
            }
        </script>


</div>
<?php include("include/__footer.php"); ?>