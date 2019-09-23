<?php require("config.php");
// 連線資料
session_start();

// 自己的php
$page_name = 'ski_areas_list';

$page_title = '雪場資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1; //用戶要看第幾頁

$per_page = 5; // 每一頁要顯示幾筆

$sql = sprintf(
    "SELECT * FROM `MGNT_SKI_AREAS` ORDER BY `sid` DESC LIMIT %s, %s",
    ($page - 1) * $per_page, //每頁從第幾筆#開始(用索引去看,跟primaryKey無關)
    $per_page
);
$stmt = $db->query($sql);

?>

<?php include("include/v2-head.php"); ?>
<!-- HTML開頭＋link -->

<!-- 導覽列 bootstrap的code -->

<div style="display:flex;">
    <?php include("include/v2-sidebar-ski.php"); ?>
    <!-- 側邊欄 -->

    <!-- 自己的html,css   code放這邊 -->
    <link rel="stylesheet" href="CSS/ski_areas_list.css">
    <div class="container">
        <div style="margin-top: 2rem;">
            <div class="d-flex justify-content-between page_group"></div>
            <a href="ski_areas.php" class="page-link" style="color:#aaa;background:#212529;text-align:center;border:2.5px dotted;padding:1rem 0;"><i class="fas fa-plus-circle" style="color:#aaa; margin:0.1rem;"></i></i>創建</a>
            <table class="table table-striped table-bordered table_1" style="color:#fff;border-right-style:none;border-left-style:none;margin-top:1rem;">
               
                <?php while ($r = $stmt->fetch()) {  ?>
                    <tr>
                        <td style="text-align: center;padding-top:3.7rem;border-right-style:none;border-left-style:none;"><a href="ski_areas_edit.php?sid=<?= $r['sid'] ?>" class="page-link" style="color:#fff;width:40px;
                        height:39px;border-radius:50%;background:#212529;"><i class="fas fa-edit" style="color:#fff;"></i></a></td>
                        <td style="text-align: center;padding-top:4.2rem;border-right-style:none;border-left-style:none;"><?= $r['sid'] ?></td>
                        <td style="text-align: center;padding-top:4.2rem;border-right-style:none;border-left-style:none;"><?= htmlentities($r['name']) ?></td>
                        <td style="text-align: center;padding-top:4.2rem;border-right-style:none;border-left-style:none;"><?= htmlentities($r['country']) ?></td>
                        <td style="text-align: center;padding-top:4.2rem;border-right-style:none;border-left-style:none;"><?= htmlentities($r['address']) ?></td>
                        <td style="border-right-style:none;border-left-style:none;"><img src="<?= 'uploads/' . htmlentities($r['ski_image']) ?>" alt="" style="width:150px"></td>
                        <td style="border-right-style:none;border-left-style:none;padding-top:3.7rem;"><a href="javascript:delete_one(<?= $r['sid'] ?>)" class="page-link" style="color:#fff;width:40px;
                        height:39px;border-radius:50%;background:#212529;"><i class="far fa-trash-alt" style="color:#fff;"></i></a></td>
                    </tr>
                <?php } ?>

            </table>
        </div>
        <script>
            function delete_one(sid) {
                
                if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
                    location.href = 'ski_areas_delete.php?sid=' + sid;
                }
            }
        </script>
    </div>
</div>
<?php include("include/v2-footer.php"); ?>