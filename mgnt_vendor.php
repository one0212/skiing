<?php require("config.php"); 

session_start();

$sql = "SELECT `name`, `status`, `create_time` FROM `MGNT_VENDOR`";
if (!empty($_GET['status'])){
    $status = $_GET['status'];
    $sql = $sql . " WHERE `status` = '$status'";
}
$stmt = $db->query($sql);
?>

<?php include("include/__head.php"); ?>
<?php include("include/__navbar.php"); ?>


<div style="display:flex;">
<?php include("include/__sidebar.php"); ?>

<link rel="stylesheet" href="css/mgnt_vendor.css">

   
<div class="search">
    <form action="">
        <select name="status">
            <option value="">全部</option>
            <option value="DISABLE">停用</option>
            <option value="ENABLE">啟用</option>
        </select>
        <button type="submit">搜尋</button>
    </form>
    <table class="vendor_table" >
        <tr>
            <th>廠商名稱</th>
            <th>廠商狀態</th>
            <th>建立時間</th>
            <th>編輯</th>
        </tr>
        <tr>
            <?php while ($row = $stmt->fetch()){ ?>
                <?php if($row['status'] == 'disable'){
                    $x = sprintf('停用');
                } else {
                    $x = sprintf('啟用');
                } ?>
            <td><?= $row['name'] ?></td>
            <td><?= $x ?></td>
            <td><?= $row['create_time'] ?></td>
            <td>
                <button>啟用</button>
                <button>停用</button>
            </td>
            

            <!-- <td><i class="fas fa-edit"></i></td> -->
        </tr>
        <?php } ?>
    </table>
</div>
<?php include("include/__footer.php"); ?>