<?php require 'config.php';
session_start();
// 連線資料
// require __DIR__.'/__connect_db.php';
$page_name = 'data_list';
$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 5; // 每一頁要顯示幾筆

$t_sql = 'SELECT COUNT(1) FROM `mgnt_coach` '; // 拿到總筆數

$t_stmt = $db->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數


$totalPages = ceil($totalRows / $per_page); // 取得總頁數

if ($page < 1) {
    header('Location: __coachlist.php');
    exit;
}
if ($page > $totalPages) {
    header('Location: __coachlist.php?page='.$totalPages);
    exit;
}

// $sql = sprintf('SELECT * FROM `mgnt_coach` ORDER BY `sid` DESC LIMIT %s, %s',
//         ($page - 1) * $per_page,
//             $per_page
// );
$sql = 'SELECT * FROM `mgnt_coach`';

$stmt = $db->query($sql); //1.取資料放進SMPT
// 自己的php

?>

<?php include 'include/__head.php'; ?>
<!-- HTML開頭＋link -->
<?php include 'include/__navbar.php'; ?>
<!-- 導覽列 bootstrap的code -->
<link rel="stylesheet" href="fontawesome/css/all.css?">
<!-- <?php echo rand(0, 6); ?> -->
<!-- <div id="wrapper" style="max-width:1024px;display:flex;"> -->
<div id="" style="display:flex;">
<?php include 'include/__sidebar.php'; ?>
<!-- 側邊欄 -->
<!-- <div class="container"> -->
<div style="margin-top: 2rem;">
    <!-- <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page - 1; ?>">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
            <?php
            $p_start = $page - 5;
            $p_end = $page + 5;
            for ($i = $p_start; $i <= $p_end; ++$i):
                if ($i < 1 or $i > $totalPages) {
                    continue;
                }
                ?>
            <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
            </li>
            <?php endfor; ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page + 1; ?>">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        </ul>
    </nav> -->


    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col"><i class="fas fa-trash-alt"></i></th>
            <th scope="col">#</th>
            <th scope="col">教練姓名</th>
            <th scope="col">性別</th>
            <th scope="col">使用語言</th>
            <th scope="col">雪場</th>
            <th scope="col">證照</th>
            <th scope="col">年資</th>
            <th scope="col">經歷</th>
            <th scope="col">理念</th>
            <th scope="col">課程</th>
            <th scope="col">價錢</th>
            <th scope="col"><i class="fas fa-edit"></i></th>
        </tr>
        </thead>
        <tbody>
        <?php while ($r = $stmt->fetch()) {
                //    2.將資料放進R的陣列裡
                //    echo "{$r['name']}{$r['male']} <br>"; 
                    ?>
            <tr>
                <td>
                    <a href="javascript:delete_one(<?= $r['sid']; ?>)"><i class="fas fa-trash-alt"></i></a>
                </td>
                <td><?= $r['sid']; ?></td>
                <td><?= htmlentities($r['name']); ?></td>
                <td><?= htmlentities($r['male']); ?></td>
                <td><?= htmlentities($r['lan']); ?></td>
                <td><?= htmlentities($r['local']); ?></td>
                <td><?= htmlentities($r['License']); ?></td>
                <td><?= htmlentities($r['skiage']); ?></td>
                <td><?= htmlentities($r['Experience']); ?></td>
                <td><?= htmlentities($r['idea']); ?></td>
                <td><?= htmlentities($r['skiclass']); ?></td>
                <td><?= htmlentities($r['price']); ?></td>
                <td><a href="__coach_edit.php?sid=<?= $r['sid']; ?>"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
        <?php
                } ?>


        </tbody>
    </table>
</div>

  
<!-- </div> -->


<!-- 自己的html,css   code放這邊 -->
<script>
        function delete_one(sid) {
            if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                location.href = '__coach_delete.php?sid=' + sid;
            }
        }
    </script>

</div>
<?php include 'include/__footer.php'; ?>