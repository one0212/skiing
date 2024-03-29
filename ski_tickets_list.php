<?php require("config.php");
// 連線資料
session_start();

// 自己的php
$page_name = 'ski_tickets_list';

$page_title = '票劵資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //用戶要看第幾頁

$per_page = 5; // 每一頁要顯示幾筆

$tickets_sql = "SELECT COUNT(1) FROM `MGNT_SKI_TICKETS` ";

$t_stmt = $db->query($tickets_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數
//$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows / $per_page); // 取得總頁數

if ($page < 1) {
    header('Location: ski_tickets_list.php');
    exit;
}
if ($page > $totalPages) {
    header('Location: ski_tickets_list.php?page=' . $totalPages);
    exit;
}

$s = isset($_GET['s']) ? intval($_GET['s']) : 0;

if ($s == 1) {
    $orderby = ' ORDER BY `sid` DESC ';
} else {
    $orderby = ' ORDER BY `sid` ASC ';
}


$sql = sprintf(
    "SELECT * FROM `MGNT_SKI_TICKETS` %s LIMIT %s, %s",
    $orderby,
    ($page - 1) * $per_page,
    $per_page
);
$tickets_stmt = $db->query($sql);

//$rows = $tickets_stmt->fetchAll();
?>

<?php include("include/v2-head.php"); ?>
<!-- HTML開頭＋link -->

<!-- 導覽列 bootstrap的code -->

<div style="display:flex;">
    <?php include("include/v2-sidebar-ski.php"); ?>
    <!-- 側邊欄 -->

    <!-- 自己的html,css   code放這邊 -->
    <link rel="stylesheet" href="CSS/ski_tickets_list.css">
    <div class="container">
        <div style="margin-top: 2rem;">
            <div class="d-flex justify-content-between page_group">
                <nav aria-label="Page navigation example" class="d-flex">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= sprintf("%s&s=%s", $page - 1, $s) ?>">
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
                                <a class="page-link number" href="?page=<?= sprintf("%s&s=%s", $i, $s) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= sprintf("%s&s=%s", $page + 1, $s) ?>"">
                                <i class=" fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                    <p class="totalRows ml-3" style="margin-top:0.7rem;color:#fff;letter-spacing:0.15em;font-weight:600">共有&nbsp;<?php echo $totalRows ?>&nbsp;筆資料</p>
                </nav>
                <div class="d-flex">
                    <a href="ski_tickets.php" class="page-link" style="background:#212529;color:#fff;border-radius:.25rem;width:7rem;margin-bottom:1rem;"><i class="fas fa-plus-circle" style="color:#aaa; margin:0.1rem;"></i>創建</a>
                </div>
            </div>
            <table class="table table-hover table-dark table_1">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkAll" name="checkbox[]" value="<?php echo $r_tickets['sid'] ?>"></th>
                        <th scope="col"><i class="far fa-trash-alt"></i></th>
                        <th scope="col">

                            <?php
                            if ($s == 1) {
                                echo '<a href="ski_tickets_list.php"><i class="fas fa-sort" style="color:#fff"></i></a>';
                            } else {
                                echo '<a href="ski_tickets_list.php?s=1"><i class="fas fa-sort" style="color:#fff"></i></a>';
                            }
                            ?>

                        </th>
                        <th scope="col">名稱</th>
                        <th scope="col">門票</th>
                        <th scope="col">類型</th>
                        <th scope="col">價格</th>
                        <th scope="col">描述</th>
                        <th scope="col"><i class="fas fa-edit"></i></th>
                    </tr>
                </thead>
                <?php while ($r_tickets = $tickets_stmt->fetch()) {  ?>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="sid" value="<?= $r_tickets['sid'] ?>"></td>
                            <td><a href="javascript:delete_one(<?= $r_tickets['sid'] ?>)"><i class="far fa-trash-alt icon"></i></a></td>
                            <td><?= $r_tickets['sid'] ?></td>
                            <td><?= htmlentities($r_tickets['name']) ?></td>
                            <td><?= htmlentities($r_tickets['ticket']) ?></td>
                            <td><?= htmlentities($r_tickets['type']) ?></td>
                            <td><?= htmlentities($r_tickets['rate']) ?></td>
                            <td><?= htmlentities($r_tickets['description']) ?></td>
                            <td><a href="ski_tickets_edit.php?sid=<?= $r_tickets['sid'] ?>"><i class="fas fa-edit icon"></i></a></td>
                        </tr>
                    </tbody>
                <?php } ?>

            </table>
            <a href="javascript:delAll()" class="page-link btn-outline-light" style="background:#212529;color:#fff;border-radius:.25rem;width:5.7rem;margin-bottom:1rem;">批次刪除</a>
        </div>
        <script>
            function delete_one(sid) {
                swal({
                        title: "確認刪除資料?",
                        type: "question",
                        confirmButtonText: "確定",
                        cancelButtonText: '取消',
                        confirmButtonColor: 'gray',
                        cancelButtonColor: '#D3D3D3',
                        showCancelButton: true
                    }).then((result) => {
                        if (result.value) {
                            location.href = 'ski_tickets_delete.php?sid=' + sid;
                        }
                    })

            }

            function delAll() {
                let sid = [];
                $("tbody input:checked").each(function() {
                    if ($(this).prop('checked')) {
                        sid.push($(this).val())
                    }
                });
                if (!sid.length) {
                    swal({
                        title: "沒有選擇任何資料!",
                        type: "warning",
                        confirmButtonText: "確定",
                        confirmButtonColor: 'gray',
                        cancelButtonColor: '#D3D3D3'
                    });
                } else {
                    swal({
                        title: "確認刪除資料?",
                        type: "question",
                        confirmButtonText: "確定",
                        cancelButtonText: '取消',
                        confirmButtonColor: 'gray',
                        cancelButtonColor: '#D3D3D3',
                        showCancelButton: true
                    }).then((result) => {
                        if (result.value) {
                            location.href = 'ski_tickets_delAll.php?sid=' + sid.toString();
                        }
                    })
            
                }

            }
        </script>
    </div>
</div>
<?php include("include/v2-footer.php"); ?>
<script>
    let dataCount = $("tbody tr").length;
    $("tbody :checkbox").click(function() {
        let checked = $(this).prop("checked")
        let checkedCount = $("tbody :checked").length;
        if (checked) {
            $(this).closest("tr").addClass("active")
        } else {
            $(this).closest("tr").removeClass("active")
        }
        if (dataCount == checkedCount) {
            $("#checkAll").prop("checked", true)
        } else {
            $("#checkAll").prop("checked", false)
        }
    })
    $("#checkAll").click(function() {
        let checkAll = $(this).prop("checked")
        $("tbody :checkbox").prop("checked", checkAll)
        if (checkAll) {
            $("tbody tr").addClass("active")
        } else {
            $("tbody tr").removeClass("active")
        }
    })
</script>