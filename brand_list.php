<?php require("config.php");
session_start();

$page_title = '品牌列表';



//設定pagination

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 2; //每頁總筆數
$brand_sql = 'SELECT COUNT(*) FROM `brand_data`';
$brand_stmt = $db->query($brand_sql);
$totalRows = $brand_stmt->fetch(PDO::FETCH_NUM)[0]; //取得總筆數
$totalPages = ceil($totalRows / $per_page); //總頁數 =  總筆數 / 每頁顯示幾筆資料

#page值小於1 轉回頁面第一頁離開
if ($page < 1) {
    header('Location: brand_list.php');
    exit;
}
#page值大於總頁數 轉回頁面最後一頁離開
if ($page > $totalPages) {
    header('Location: brand_list.php?page=' . $totalPages);
    exit;
}

// echo "$totalPages <br>";
// echo "$totalRows <br>";
// exit;
// 設定pagination 結束

//抓取資料  brand_data join Country
$sql = sprintf(
    "SELECT * FROM `brand_data`  JOIN `Country` ON brand_data.Country_id = Country.id  ORDER BY `Brand_id` ASC LIMIT %s,%s",
    ($page - 1) * $per_page, //
    $per_page
);
$brand_sql = $db->query($sql);



?>
<?php include("include/v2-head.php"); ?>
<?php include("include/v2-sidebar-ski.php"); ?>



<!-- 自己的html,css   code放這邊 -->
<link rel="stylesheet" href="CSS/brand_list.css">


<div class="main">

    <div class="row justify-content-between">
        <div class="col-sm-6">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item "><a class="page-link bg-transparent text-light" href="?page=<?= $page - 1 ?>"><i class="angle fas fa-angle-left"></i></a></li>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?= $i == $page ? 'bg-secondary' : '' ?>"><a class="page-link bg-transparent text-light" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                    <li class="page-item "><a class="page-link bg-transparent text-light" href="?page=<?= $page + 1 ?>"><i class="angle fas fa-chevron-right"></i></a></li>
                </ul>
            </nav>
        </div>
        <div class="col-sm-6">
            <form class="form-inline justify-content-end">
                <div>
                    <button type="button" class="btn btn-outline-light"><a class="text-light" href="brand_data.php">新增品牌</a></button>
                </div>
            </form>
        </div>
    </div>



    <table class="table table-hover table-dark">
        <thead>
            <tr>
                <th scope="col">品牌排序</th>
                <th scope="col">品牌商標</th>
                <th scope="col">品牌編號</th>
                <th scope="col">品牌名稱</th>
                <th scope="col">成立年份</th>
                <th scope="col">品牌地</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($r = $brand_sql->fetch()) { ?>
                <tr>
                    <td><?= $r['Brand_id'] ?></td>
                    <td><img src="<?= 'uploads/brand/' . $r['BrandLogo'] ?>" style="width:80px">
                    <td><?= $r['BrandNumber'] ?></td>
                    <td><?= $r['BrandName'] ?></td>
                    <td><?= $r['BrandSince'] ?></td>
                    <td><?= $r['CountryName'] ?></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
</div>


<?php include("include/v2-footer.php"); ?>