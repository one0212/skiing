<?php require 'config.php';
session_start();
// 連線資料

$page_name = 'data_list';
$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$per_page = 10; // 每一頁要顯示幾筆

$t_sql = 'SELECT COUNT(1) FROM `mgnt_coach` '; //資料集1筆的內容假設為29

// $t_stmt = $db->query($t_sql);
$totalRows =  $db->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; 
// 拿到總筆數  PDO::FETCH_NUM(索引式陣列) 不管欄位列出[0]為第一筆元素
//echo $totalRows;
//可在此exit 並且ECHO數字;
$totalPages = ceil($totalRows / $per_page); // 取得總頁數

if ($page < 1) {
    header('Location: __coachlist.php');
    exit;
}
if ($page > $totalPages) {
    header('Location: __coachlist.php?page='.$totalPages);
    exit;
}

$sql = sprintf('SELECT * FROM `mgnt_coach`');
// $sql = 'SELECT * FROM `mgnt_coach`';

$stmt = $db->query($sql); //1.取資料放進SMPT
// 自己的php

?>

<?php include 'include/v2-head.php'; ?>
<!-- HTML開頭＋link -->
<!-- <?php include 'include/__navbar.php'; ?> -->
<!-- 導覽列 bootstrap的code -->

<!-- <div id="wrapper" style="max-width:1024px;display:flex;"> -->
<div style="display:flex;">
    <?php include 'include/v2-sidebar.php'; ?>
    <!-- 側邊欄 -->
    <!-- <div class="container"> -->
    <div class="container" >
        <!-- style="margin-top: 2rem;" -->
    <div class="d-flex justify-content-end ">
            <a href="__coach_insert.php" class="page-link" style="color:#aaa"><i class="fas fa-edit"
                    style="color:#aaa; margin:0.1rem;"></i>新增</a>
    </div>
    <div class="container" style="margin-top: 2rem; color: aliceblue; ">
       

      

            <!-- <a href="javascript:delete_one(<?= $r['sid']; ?>)" class="page-link" style="color:#aaa"><i class="fas fa-edit" style="color:#aaa; margin:0.1rem;"></i>刪除</a> -->
            <!-- <a href="__coach_delete.php?sid=22" class="page-link" style="color:#aaa"><i class="fas fa-edit"
                    style="color:#aaa; margin:0.1rem;"></i>刪除</a> -->
            <!-- <a href="javascript:" onclick="document.forms[0].action='ooo.php';document.forms[0].submit()">修改設定</a>  -->


        </div>

 
        <table id="coachTable" class="table table-striped table-bordered " style=" background-color: aliceblue; ">
            <!-- <form method="post" name="form1" id="form1" action="__coach_delete.php?sid=<?= $r['sid']; ?>"> -->
            <thead class="text-nowrap">
                <tr>
                    <th scope="col">刪除
                    </th>
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
        <!-- </form> -->
    </div>


    <!-- </div> -->


    <!-- 自己的html,css   code放這邊 -->
  
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
  <!-- DataTables v1.10.16 -->
  <link href="css/jquery.dataTables.min.css" rel="stylesheet" />
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
 
      <script>
      function delete_one(sid) {
            if(confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)){
                location.href = '__coach_delete.php?sid=' + sid;
            }
        }

         $(document).ready( function () {
    $('#coachTable').DataTable(
        {
  "language": {
    "emptyTable": "無資料...",
  "processing": "處理中...",
  "loadingRecords": "載入中...",
  "lengthMenu": "顯示 _MENU_ 項結果",
  "zeroRecords": "沒有符合的結果",
  "info": "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
  "infoEmpty": "顯示第 0 至 0 項結果，共 0 項",
  "infoFiltered": "(從 _MAX_ 項結果中過濾)",
  "infoPostFix": "",
  "search": "搜尋:",
  "paginate": {
    "first": "第一頁",
    "previous": "上一頁",
    "next": "下一頁",
    "last": "最後一頁"
  },
  "aria": {
    "sortAscending": ": 升冪排列",
    "sortDescending": ": 降冪排列"
  }
  }
}
    );
} );

    </script>

</div>
<?php include 'include/__footer.php'; ?>