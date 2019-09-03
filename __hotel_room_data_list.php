<?php require("config.php"); 
session_start();

$page_name = 'ROOM_DATA';   
$page_title = '房型表單';


$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 10;    //每頁要顯示幾筆資料


#取得總筆數
$t_sql = 'SELECT COUNT(1) FROM `MGNT_SKI_HOTELROOM`';
$totalRows = $db->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

#總頁數 =  總筆數 / 每頁顯示幾筆資料
$totalPages = ceil($totalRows / $per_page);

#page值小於1 轉回頁面第一頁離開
if ($page < 1) {
    header('Location: MGNT_SKI_HOTELROOM.php');
    exit;
}
#page值大於總頁數 轉回頁面最後一頁離開
if ($page > $totalPages) {
    header('Location: MGNT_SKI_HOTELROOM.php?page=' . $totalPages);             //<<改自己的連結 ！！！！！！！
    exit;
}

#取得資料庫資料
$sql = sprintf(
    "SELECT * FROM `MGNT_SKI_HOTELROOM` ORDER BY `sid` ASC LIMIT %s,%s",        //<<改自己的連結 ！！！！！！！
    ($page - 1) * $per_page,
    $per_page
);

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
                        <li class="page-item"><a class="page-link bg-secondary text-light" href="?page=<?= $page-1 ?>"><i class="fas fa-chevron-left"></i></a></li>
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?= $i == $page ? 'bg-dark' : '' ?>"> <a class="page-link bg-secondary  <?= $i == $page ? 'bg-dark' : '' ?>  text-light " href="?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item"><a class="page-link bg-secondary text-light" href="?page=<?= $page+1 ?>"><i class="fas fa-chevron-right"></i></a></li>
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
                        <button type="button" class="btn btn-success "><a class="text-light" href="__hotel_room_insert.php">新增品牌</a></button>       <!-- 請修改連結！ -->
                    </div>
                </form>
            </div>
        </div>
        <div class="row  pt-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th> 
                        <th scope="col">房型名稱</th> 
                        <th scope="col">房型</th>
                        <th scope="col">是否禁菸</th>
                        <th scope="col">寵物同行限制</th> 
                        <th scope="col">可入住人數</th>
                        <th scope="col"><i class="fas fa-trash-alt"></i></th>
                        <th scope="col"><i class="fas fa-edit"></i></th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $stmt->fetch()) { ?>
                        <tr>
                            <td><?= $r['sid'] ?></td>
                            <td><?= htmlentities($r['room_name']) ?></td>
                            <td><?= htmlentities($r['room_type']) ?></td>
                            <td><?= $r['smoke'] ? '是':'否' ?></td>
                            <td><?= $r['pet'] ? '是':'否' ?></td>
                            <td><?= htmlentities($r['person']) ?></td>
                            <td><a href="javascript:delete_one(<?= $r['sid'] ?>)"><i class="fas fa-trash-alt"></i></a></td>
                            <td><a href="__hotel_room_date_list_edit.php?sid=<?= $r['sid'] ?>"><i class="fas fa-edit"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


    
    <script>
        function delete_one(sid) {
            if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                location.href = '__hotel_room_data_delete.php?sid=' + sid;
            }
        }
    </script>
</div>
<?php include("include/__footer.php"); ?>