<?php require("config.php");
session_start();

include("control.php");

$sql = "SELECT `bid`, `type`, `name`, `status`, `create_time`, `update_time` FROM `MGNT_VENDOR`";
if (!empty($_GET['status'])) {
    $status = $_GET['status'];
    $sql = $sql . " WHERE `status` = '$status'";
}
$stmt = $db->query($sql);
?>

<?php include("include/v2-head.php"); ?>
<?php include("include/v2-sidebar-ski.php"); ?>

<link rel="stylesheet" href="css/mgnt_vendor.css">
<!-- <script src="vendor/new_ajax.js"></script> -->
<div class="main">
    <div class="alert alert-primary" role="alert" id="info_bar" style="display: none">修改成功</div>
    <form action="" class="mgnt_status form-inline">
        <select name="status" class="form-control" style="width:100px">
            <option value="">全部</option>
            <option value="disable">停用</option>
            <option value="enable">啟用</option>
        </select>
        <button class="btn btn-secondary mx-2" type="submit">搜尋</button>
    </form>
    <table class="vendor_table table table-dark text-center my-3 table-active">
        <thead class="thead-dark">
            <tr>
                <th class="py-3" scope="col" data-name="type">廠商類型<i class="fas fa-sort mx-2 p-0"></i></th>
                <th class="py-3" scope="col" data-name="name">廠商名稱<i class="fas fa-sort mx-2 p-0"></i></th>
                <th class="py-3" scope="col" data-name="status">廠商狀態<i class="fas fa-sort mx-2 p-0"></i></th>
                <th class="py-3" scope="col" data-name="create_time">建立時間<i class="fas fa-sort mx-2 p-0"></i></th>
                <th class="py-3" scope="col" data-name="update_time">更新時間<i class="fas fa-sort mx-2 p-0"></i></th>
                <th class="py-3" scope="col" data-name="edit">編輯</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch()) { ?>
                <tr class="tb-tr text-center">
                    <?php if ($row['status'] == 'disable') {
                            $x = sprintf('停用');
                        } else {
                            $x = sprintf('啟用');
                        } ?>
                    <td data-name="type" class="tb-td"><?= $row['type'] ?></td>
                    <td data-name="name" class="tb-td"><?= $row['name'] ?></td>
                    <td data-name="status" class="tb-td" class="change_status"><?= $x ?></td>
                    <td data-name="create_time" class="tb-td"><?= $row['create_time'] ?></td>
                    <td data-name="update_time" class="tb-td"><?= $row['update_time'] ?></td>
                    <td data-name="edit" class="tb-td">
                        <button data-status="enable" class="btn btn-secondary question" onclick="update_status(this)">啟用</button>
                        <button data-status="disable" class="btn btn-secondary question" onclick="update_status(this)">停用</button>
                    </td>
                    <input type="hidden" name="bid" value="<?= $row['bid'] ?>">
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
<?php include("include/v2-footer.php"); ?>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
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
        if (window.XMLHttpRequest) {
            var oAjax = new XMLHttpRequest();
        } else {
            // 只有在IE底下可以使用(包括IE6)
            var oAjax = new ActiveXObject("Microsoft.XMLHTTP");
        }

        let fd = new FormData();
        fd.append("status", buttonEle.dataset.status)
        console.log(buttonEle.dataset.status)
        fd.append("bid", bid_ele.value)
        console.log(bid_ele.value)
        // 2.連接伺服器
        // open(連接方法, 檔名, 異步傳輸(多件事可以一起做))
        oAjax.open('POST', "vendor/vendor_status_api.php", true);
        // console.log(`status=${button.className}&bid=${bid_ele.value}`);
        // 3.發送請求
        oAjax.send(fd);


        // 4.接收返回
        oAjax.onreadystatechange = function() {
            console.log(oAjax.response);
            if (oAjax.readyState == 4 && oAjax.status == 200) { // 讀取完成 不代表讀取成功 需再用status檢查
                swal.resetDefaults();
                    swal.setDefaults({
                        confirmButtonText: "確定",
                        confirmButtonColor: 'gray',
                        cancelButtonColor: '#D3D3D3',
                        showCloseButton: "true",
                        allowOutsideClick: "true"
                    });
                    updateVendorInfo(parentTrEle, JSON.parse(oAjax.responseText));
                    swal("修改成功!",
                        "",
                        "success");
                // JSON.parse() 把json轉成object

                // let formEle = document.querySelector('form');
                // let info_bar = document.querySelector('#info_bar');
                // info_bar.style.display = "block";
                // info_bar.className = 'alert alert-success';
                // setTimeout(function() {
                //     info_bar.style.display = "none";
                // }, 1000);
                // formEle.submit()
            } else {
                whenAjaxErr();
            }
        }
    }
     
    function updateVendorInfo(trEle, vendor) {
        let statusChn = vendor.status == 'enable' ? '啟用' : '停用';
        trEle.innerHTML = `
            <td>${vendor.type}</td>
            <td>${vendor.name}</td>
            <td class="change_status">${statusChn}</td>
            <td>${vendor.create_time}</td>
            <td>${vendor.update_time}</td>
            <td>
                <button data-status="enable" class="btn btn-secondary question" onclick="update_status(this)">啟用</button>
                <button data-status="disable" class="btn btn-secondary question" onclick="update_status(this)">停用</button>
            </td>
            <input type="hidden" name="bid" value="${vendor.bid}"/>
        `;
    }

    function whenAjaxErr() {

    };
</script>

<script>
    let $tr = $(".tb-tr");
    let $tbody = $("tbody");
    let $td = $tr.children("td");
    let direction = "asc";
    // $("th").each(function(ele) {
    //     console.log(ele)
    $("th").click(function() {
        console.log($(this));
        let dataName = $(this).data("name");
        console.log($tr);
        $tr.sort(function(a, b) {
            var v1 = $(a).find(`td[data-name="${dataName}"]`).text(),
                v2 = $(b).find(`td[data-name="${dataName}"]`).text();

            // console.log(`${v1}, ${v2}`);
            // console.log($direction ? "asc" : "desc");
            if (direction == "asc") {
                return v1 >= v2 ? -1 : 1;
            } else {
                return v1 >= v2 ? 1 : -1;
            }
        });
        direction = direction == 'asc' ? 'desc' : 'asc';
        console.log($tr);
        $tbody.append($tr)
        // $tr.appendTo($tbody)
    });
    // })
    // $peopleli.sort(function(a, b) {
    //     var an = a.getAttribute('data-name'),
    //         bn = b.getAttribute('data-name');

    //     if (an > bn) {
    //         return 1;
    //     }
    //     if (an < bn) {
    //         return -1;
    //     }
    //     return 0;
    // });

    // $peopleli.detach().appendTo($people);
    // });
</script>