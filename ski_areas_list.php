<?php require("config.php");
// 連線資料
session_start();

// 自己的php
$page_name = 'ski_areas_list';

$page_title = '雪場資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //用戶要看第幾頁

$per_page = 1; // 每一頁要顯示幾筆

$t_sql = "SELECT COUNT(1) FROM `MGNT_SKI_AREAS` ";

$t_stmt = $db->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = $totalRows; // 取得總頁數

if ($page < 1) {
    header('Location: ski_areas_list.php');
    exit;
}
if ($page > $totalPages) {
    header('Location: ski_areas_list.php?page=' . $totalPages);
    exit;
}

$sql = sprintf(
    "SELECT * FROM `MGNT_SKI_AREAS` ORDER BY `sid` DESC LIMIT %s, %s",
    ($page - 1) * $per_page, //每頁從第幾筆#開始(用索引去看,跟primaryKey無關)
    $per_page
);
$stmt = $db->query($sql);

//$rows = $stmt->fetchAll();
?>

<?php include("include/__head.php"); ?>
<!-- HTML開頭＋link -->
<?php include("include/__navbar.php"); ?>
<!-- 導覽列 bootstrap的code -->

<div style="display:flex;">
    <?php include("include/__sidebar.php"); ?>
    <!-- 側邊欄 -->

    <!-- 自己的html,css   code放這邊 -->
    <link rel="stylesheet" href="css/ski_areas_list.css">
    <div class="container">
        <div style="margin-top: 2rem;">
            <div class="d-flex justify-content-between page_group">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 ?>" style="color:#aaa">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                        <?php
                        $p_start = $page - 5;
                        $p_end = $page + 5;
                        for ($i = $p_start; $i <= $p_end; $i++) :
                            if ($i < 1 or $i > $totalPages) continue; //跳出此次for迴圈,進入下一個for迴圈
                            ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link number" href="?page=<?= $i ?>" style="color:gray"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">
                                <i class="fas fa-chevron-right" style="color:#aaa"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="d-flex">
                    <?php while ($r = $stmt->fetch()) {  ?>
                        <a href="javascript:delete_one(<?= $r['sid'] ?>)" class="page-link" style="color:#aaa"><i class="far fa-trash-alt" style="color:#aaa; margin:0.1rem;"></i>刪除</a>
                        <a href="ski_areas_edit.php?sid=<?= $r['sid'] ?>" class="page-link" style="color:#aaa; margin-left:0.5rem;"><i class="fas fa-edit" style="color:#aaa; margin:0.1rem;"></i>編輯</a>
                    
                    <a href="ski_areas.php" class="page-link" style="color:#aaa; margin-left:0.5rem;"><i class="fas fa-plus-circle" style="color:#aaa; margin:0.1rem;"></i></i>創建</a>
                </div>
            </div>
            <table class="table table-striped table-bordered table_1">


                
                    <tr>
                        <th scope="col"><i class="fas fa-hashtag"></i></th>
                    </tr>
                    <tr>
                        <td><?= $r['sid'] ?></td>
                    </tr>
                    <tr>
                        <th scope="col">名稱</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['name']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">國家</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['country']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">地址</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['address']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">描述</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['description']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">營運期間</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['skiing_season']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">營業時間</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['business_hours']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">雪場圖片</th>
                    </tr>
                    <tr>
                        <td><img src="<?= 'uploads/'.htmlentities($r['ski_image']) ?>" alt="" style="width:150px"><p class="p_img"><?= htmlentities($r['ski_image']) ?></p></td>
                    </tr>
                    <tr>
                        <th scope="col">面積</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['acreage']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">雪道數量</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['number_of_courses']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">最長滑行距離</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['longest_run']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">最大斜度</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['slop_gradient']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">標高差</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['vertical_drop']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">雪場地圖</th>
                    </tr>
                    <tr>
                        <td><img src="<?= 'uploads/'.htmlentities($r['ski_map']) ?>" alt="" style="width:150px"><p class="p_img"><?= htmlentities($r['ski_map']) ?></p></td>
                    </tr>
                    <tr>
                        <th scope="col">門票</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['tickets']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">租借</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['rentals']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">課程</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['lessons']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">飯店</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['hostel']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">飯店圖片</th>
                    </tr>
                    <tr>
                        <td><img src="<?= 'uploads/'.htmlentities($r['hostel_image']) ?>" alt="" style="width:150px"><p class="p_img"><?= htmlentities($r['hostel_image']) ?></p></td>
                    </tr>
                    <tr>
                        <th scope="col">汽車</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['access_car']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">搭乘電車</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['access_bus']) ?></td>
                    </tr>
                    <tr>
                        <th scope="col">高速巴士</th>
                    </tr>
                    <tr>
                        <td><?= htmlentities($r['access_train']) ?></td>
                    </tr>

                <?php } ?>

            </table>
        </div>
        <script>
        function delete_one(sid) {
            if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                location.href = 'ski_areas_delete.php?sid=' + sid;
            }
        }
    </script>
    </div>
</div>
<?php include("include/__footer.php"); ?>