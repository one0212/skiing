<?php
require("config.php");
require("ski_utils.php");

session_start();


  // 檢查廠商是否透過表單送出請求
  if (!empty($_POST) and !empty($_SESSION['bid'])) {
// print_r($_POST); exit;
    $vendor_detail_sql1 = "UPDATE `MGNT_VENDOR` SET `name`=? WHERE `bid` = ?";
    $vendor_detail_sql2 = "UPDATE `MGNT_VENDOR_DETAIL` SET
    `company_no` =?,
    `address` =?,
    `bank_account` =?, 
    `principal` =?, 
    `web_site` =?, 
    `contact_person` =?, 
    `contact_email` =?, 
    `contact_number` =?, 
    `remark` =? 
    WHERE `bid` =?";


/*
    $vendor_sql = "INSERT INTO `MGNT_VENDOR`(`bid`, `name`, `status`, `create_time`, `update_time`) VALUES (?, ?, 'disable', NOW(), NOW())";
    $vendor_stmt = $db->prepare($vendor_sql)->execute([
            $_POST['bid'],
            $_POST['name'],
            $_POST['create_time'],
            $_POST['update_time']
    ]);
*/

// $stmt = $pdo->prepare($sql);
    $vendor_detail_stmt1 = $db->prepare($vendor_detail_sql1)->execute([
        $_POST['name'],
        $_SESSION['bid']
    ]);
    
    $vendor_detail_stmt2 = $db->prepare($vendor_detail_sql2)->execute([
        $_POST['company_no'],
        $_POST['address'],
        $_POST['bank_account'],
        $_POST['principal'],
        $_POST['web_site'],
        $_POST['contact_person'],
        $_POST['contact_email'],
        $_POST['contact_number'],
        $_POST['remark'],
        $_SESSION['bid']
    ]);

    // echo $vendor_detail_stmt->rowCount();
}


// 先檢查是否登入
if (isset($_SESSION['bid'])){
    // 廠商已登入，檢查廠商是否已經有資料
    $bid = $_SESSION['bid'];
    $vendor_sql1 = "SELECT `name` FROM `MGNT_VENDOR` WHERE `bid` = '$bid' ";
    $vendor_sql2 = "SELECT `company_no`, `address`, `bank_account`, `principal`, `web_site`, `contact_person`, `contact_email`, `contact_number`, `remark`, `update_time` FROM `MGNT_VENDOR_DETAIL` WHERE `bid` = '$bid' ";
// echo $vendor_sql; exit;
    $row1 = $db->query($vendor_sql1)->fetch();
    $row2 = $db->query($vendor_sql2)->fetch();
} else {
    // 沒登入，跳轉回登入頁
    error_log("未登入，跳轉回登入頁");
    header('Location: login.php');
}

// echo $row2;

// $row2 = $pdo->query($sql)->fetch();
if(empty($row1) and empty($row2)) {
    header('Location: login.php');
    exit;
}

?>

<?php include("include/__head.php");?>
<?php include("include/__navbar.php");?>

<div id="wrapper" style="max-width:1024px;display:flex;">
<?php include("include/__sidebar.php");?>
    
    
    
    <link rel="stylesheet" href="css/vendor.css">

        <div class="vendor-form">
            <form action="" method="post">
                <div class="vendor-form-group">
                    <label for="">公司名稱</label>
                    <input type="text" name="name" value="<?= $row1['name'] ?>">
                </div>
                <div class="vendor-form-group">
                    <label for="">統一編號／公司行號</label>
                    <input type="text" name="company_no" value="<?= $row2['company_no'] ?>">
                </div>
                <div class="vendor-form-group">
                    <label for="">帳戶資訊</label>
                    <input type="text" name="bank_account" value="<?= $row2['bank_account'] ?>">
                </div>
                <div class="vendor-form-group">
                    <label for="">負責人</label>
                    <input type="text" name="principal" value="<?= $row2['principal'] ?>">
                </div>
                <div class="vendor-form-group">
                    <label for="">公司地址</label>
                    <input type="text" name="address" value="<?= $row2['address'] ?>">
                </div>
                <div class="vendor-form-group">
                    <label for="">公司網站</label>
                    <input type="text" name="web_site" value="<?= $row2['web_site'] ?>">
                </div>
                <div class="vendor-form-group">
                    <label for="">聯絡人<input class="vendor-checkbox" type="checkbox" onclick="">同負責人</label>
                    <input type="text" name="contact_person" value="<?= $row2['contact_person'] ?>">
                </div>
                <div class="vendor-form-group">
                    <label for="">聯絡人電話</label>
                    <input type="text" name="contact_number" value="<?= $row2['contact_number'] ?>">
                </div>
                <div class="vendor-form-group">
                    <label for="">聯絡人e-mail</label>
                    <input type="text" name="contact_email" value="<?= $row2['contact_email'] ?>">
                </div>
                <div class="vendor-form-group">
                    <label for="">備註</label>
                    <input type="text" name="remark" value="<?= $row2['remark'] ?>">
                </div>
                <div class="vendor-form-group">
                    <button class="vendor-submit">編輯完成</button>
                </div>
            </form>
        </div>
        <!-- <input  type="button" value=""> -->
    </div>
<?php include("include/__footer.php");?>

