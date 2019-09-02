<?php require("config.php"); // 連線資料
session_start();

$page_name = 'BRAND_DATA';
$page_title = '品牌介紹';


$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

#每頁顯示幾筆資料
$per_page = 2;

#取得總筆數
$t_sql = 'SELECT COUNT(1) FROM `BRAND＿DATA`';
$totalRows = $db->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

#總頁數 =  總筆數 / 每頁顯示幾筆資料
$totalPages = ceil($totalRows / $per_page);

#page值小於1 轉回頁面第一頁離開
if($page < 1){
    header('Location: BRAND_DATA.php');     
    exit;
  }
  #page值大於總頁數 轉回頁面最後一頁離開
  if($page > $totalPages){
    header('Location: BRAND_DATA.php?page='. $totalPages);     
    exit;
  }

#取得資料庫資料
$sql = sprintf("SELECT * FROM `BRAND＿DATA` ORDER BY `sid` ASC LIMIT %s,%s",
($page-1)*$per_page,$per_page);

$stmt = $db->query($sql);








?>

<?php include("include/__head.php"); ?>
<?php include("include/__navbar.php"); ?>
<div style="display:flex;">
    <?php include("include/__sidebar.php"); ?>
    <!-- 側邊欄 -->


    <!-- 自己的html,css   code放這邊 -->

    <div class="container pt-5">
        <div class="row justify-content-between">
            <div class="col-sm-6">
                <nav aria-label="Page navigation example ">
                    <ul class="pagination ">
                        <li class="page-item"><a class="page-link bg-secondary text-light" href="#"><i class="fas fa-chevron-left"></i></a></li>
                        <?php for($i=1; $i<=$totalPages; $i++):
                        ?>
                        <li class="page-item <?= $i==$page ? 'bg-dark' : '' ?>"><a class="page-link bg-secondary  <?= $i==$page ? 'bg-dark' : '' ?> 11`2`   text-light " href="?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor;?>
                        <li class="page-item"><a class="page-link bg-secondary text-light" href="#"><i class="fas fa-chevron-right"></i></a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-sm-6">
                <form class="form-inline my-2 my-lg-0">
                    <div class="mr-3">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">搜尋</button>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-success">新增品牌</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row  pt-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">LOGO</th>
                        <th scope="col">品牌名稱</th>
                        <th scope="col">品牌地</th>
                        <th scope="col">品牌網站</th>
                        <th scope="col">品牌影片</th>
                        <th scope="col">修改時間</th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $stmt->fetch()) { ?>
                        <tr>
                            <th><?= $r['sid'] ?></th>
                            <td><?= $r['logo'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['country'] ?></td>
                            <td><?= $r['web'] ?></td>
                            <td><?= $r['video'] ?></td>
                            <td><?= $r['update_time'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("include/__footer.php"); ?>