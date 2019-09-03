<?php require("config.php"); 

session_start();

$sql = "SELECT `bid`, `name`, `status`, `create_time`, `update_time` FROM `MGNT_VENDOR`";
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
<!-- <script src="vendor/new_ajax.js"></script> -->

   
<div class="search">
    <form  action="" class="mgnt_status">
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
            <th>更新時間</th>
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
            <td class="change_status"><?= $x ?></td>
            <td><?= $row['create_time'] ?></td>
            <td><?= $row['update_time'] ?></td>
            <td>
                <button class="enable" onclick="update_status(this)">啟用</button>
                <button class="disable" onclick="update_status(this)">停用</button>
            </td>
            <input type="hidden" name="bid" value="<?= $row['bid'] ?>">
            <!-- <td><i class="fas fa-edit"></i></td> -->
        </tr>
        <?php } ?>
    </table>
</div>
<script>

    // window.onload = function() {
       
    // }
    function update_status(buttonEle) {
        // console.log(buttonEle);
        let parentTrEle = buttonEle.parentNode.parentElement;
        // console.log(parentTrEle);
        let bid_ele = parentTrEle.querySelector('input[name="bid"]');
        // console.log(bid_ele);
        

        // 1. 建立一個Ajax物件
        // IE6 不兼容 new XMLHttpRequest()
        if(window.XMLHttpRequest){
            var oAjax = new XMLHttpRequest();
        } else {
            // 只有在IE底下可以使用(包括IE6)
            var oAjax = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        let fd = new FormData();
        fd.append("status", buttonEle.className)
        fd.append("bid", bid_ele.value)
        // 2.連接伺服器
        // open(連接方法, 檔名, 異步傳輸(多件事可以一起做))
        oAjax.open('POST', "vendor/vendor_status_api.php", true);
        // console.log(`status=${button.className}&bid=${bid_ele.value}`);
        // 3.發送請求
        oAjax.send(fd);


        // 4.接收返回
        oAjax.onreadystatechange = function() {
            console.log(oAjax.response);
            if(oAjax.readyState == 4 && oAjax.status == 200) {  // 讀取完成 不代表讀取成功 需再用status檢查
                let statusTrEle = parentTrEle.querySelector('td.change_status')
                whenAjaxSuc(statusTrEle, oAjax.responseText);
                alert('')
                let formEle = document.querySelector('form');
                formEle.submit();
            } else {
                whenAjaxErr();
            }
        }
    }

    function whenAjaxSuc(ele, respText) {
        // console.log(statusTrEle);
        ele.innerText = respText;
    }

    function whenAjaxErr() {

    }

</script>
<?php include("include/__footer.php"); ?>