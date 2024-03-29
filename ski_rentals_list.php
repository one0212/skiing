<?php require("config.php");
// 連線資料
session_start();

// 自己的php
$page_name = 'ski_rentals_list';

$page_title = '租借資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //用戶要看第幾頁

$per_page = 5; // 每一頁要顯示幾筆

$rentals_sql = "SELECT COUNT(1) FROM `MGNT_SKI_RENTALS` ";

$t_stmt = $db->query($rentals_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows/$per_page); // 取得總頁數

if ($page < 1) {
    header('Location: ski_rentals_list.php');
    exit;
}
if ($page > $totalPages) {
    header('Location: ski_rentals_list.php?page=' . $totalPages);
    exit;
}

$sql = sprintf(
    "SELECT * FROM `MGNT_SKI_RENTALS` ORDER BY `sid` DESC LIMIT %s, %s",
    ($page - 1) * $per_page, //每頁從第幾筆#開始(用索引去看,跟primaryKey無關)
    $per_page
);
$rentals_stmt = $db->query($sql);

//$rows = $rentals_stmt->fetchAll();
?>

<?php include("include/__head.php"); ?>
<!-- HTML開頭＋link -->
<?php include("include/__navbar.php"); ?>
<!-- 導覽列 bootstrap的code -->

<div style="display:flex;">
    <?php include("include/__sidebar.php"); ?>
    <!-- 側邊欄 -->

    <!-- 自己的html,css   code放這邊 -->
    <link rel="stylesheet" href="css/ski_tickets_list.css">
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
                        $p_start = $page - 1;
                        $p_end = $page + 1;
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
                        <a href="ski_rentals.php" class="page-link" style="color:#aaa; margin-left:0.5rem;"><i class="fas fa-plus-circle" style="color:#aaa; margin:0.1rem;"></i></i>創建</a>       
                </div>
            </div>
            <table class="table table-striped table-bordered table_1">
                
                <tr>
                    <th scope="col"><i class="far fa-trash-alt"></i></th>
                    <th scope="col"><i class="fas fa-hashtag"></i></th>
                    <th scope="col">名稱</th>
                    <th scope="col">圖片</th>
                    <th scope="col">性別</th>
                    <th scope="col">類型</th>
                    <th scope="col">尺碼</th>
                    <th scope="col">時間</th>
                    <th scope="col">數量</th>
                    <th scope="col">價格</th>
                    <th scope="col"><i class="fas fa-edit"></i></th>
                </tr>
                <?php while ($r_rentals = $rentals_stmt->fetch()) {  ?>
                <tr>
                    <td><a href="javascript:delete_one(<?= $r_rentals['sid'] ?>)"><i class="far fa-trash-alt icon"></i></a></td>
                    <td><?= $r_rentals['sid'] ?></td>
                    <td><?= htmlentities($r_rentals['name']) ?></td>
                    <td><img src="<?= 'uploads/'.htmlentities($r_rentals['image']) ?>" alt="" style="width:150px"><p class="p_img"><?= htmlentities($r_rentals['image']) ?></p></td>
                    <td><?= htmlentities($r_rentals['gender']) ?></td>
                    <td><?= htmlentities($r_rentals['type']) ?></td>
                    <td><?= htmlentities($r_rentals['size']) ?></td>
                    <td><?= htmlentities($r_rentals['time']) ?></td>
                    <td><?= htmlentities($r_rentals['quantity']) ?></td>
                    <td><?= htmlentities($r_rentals['price']) ?></td>
                    <td><a href="ski_rentals_edit.php?sid=<?= $r_rentals['sid'] ?>"><i class="fas fa-edit icon"></i></a></td>
                </tr>
            <?php } ?>

            </table>
        </div>
        <script>
        function delete_one(sid) {
            if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                location.href = 'ski_rentals_delete.php?sid=' + sid;
            }
        }
    </script>
    </div>
</div>
<?php include("include/__footer.php"); ?>