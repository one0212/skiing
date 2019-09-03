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

?>

<?php include("include/__head.php");?>
<?php include("include/__navbar.php");?>

<div style="display:flex;">
<?php include("include/__sidebar.php");?>
    
    
    <link rel="stylesheet" href="css/vendor.css">

        <div class="vendor-form">
            <form action="" method="post" >
                <div class="vendor-form-group">
                    <button type="button" class="edit edit-button" >編輯</button>
                </div>
                <div class="vendor-form-group">
                    <label for="">公司名稱</label>
                    <input id="name" type="text" name="name" value="<?= $row1['name'] ?>" readonly>
                    <small id="nameHelp" class="form-text"></small>
                </div>
                <div class="vendor-form-group">
                    <label for="">統一編號／公司行號</label>
                    <input id="company_no" type="text" name="company_no" value="<?= $row2['company_no'] ?>" readonly>
                    <small id="company_noHelp" class="form-text"></small>
                </div>
                <div class="vendor-form-group">
                    <label for="">帳戶資訊</label>
                    <input id="bank_account" type="text" name="bank_account" value="<?= $row2['bank_account'] ?>" readonly>
                    <small id="bank_accountHelp" class="form-text"></small>
                </div>
                <div class="vendor-form-group">
                    <label for="">負責人</label>
                    <input id="principal" type="text" name="principal" value="<?= $row2['principal'] ?>" readonly>
                    <small id="principalHelp" class="form-text"></small>
                </div>
                <div class="vendor-form-group">
                    <label for="">公司地址</label>
                    <input id="address" type="text" name="address" value="<?= $row2['address'] ?>" readonly>
                    <small id="addressHelp" class="form-text"></small>
                </div>
                <div class="vendor-form-group">
                    <label for="">公司網站</label>
                    <input id="web_site" type="text" name="web_site" value="<?= $row2['web_site'] ?>" readonly>
                    <small id="web_siteHelp" class="form-text"></small>
                </div>
                <div class="vendor-form-group">
                    <label for="">聯絡人<button type="button" class="vendor-button">同負責人</button></label>
                    <input id="contact_person" type="text" class="contact_person" name="contact_person" value="<?= $row2['contact_person'] ?>" readonly>
                    <small id="contact_personHelp" class="form-text"></small>
                </div>
                <div class="vendor-form-group">
                    <label for="">聯絡人電話</label>
                    <input id="contact_number" type="text" name="contact_number" value="<?= $row2['contact_number'] ?>" readonly>
                    <small id="contact_numberHelp" class="form-text"></small>
                </div>
                <div class="vendor-form-group">
                    <label for="">聯絡人e-mail</label>
                    <input id="contact_email" type="text" name="contact_email" value="<?= $row2['contact_email'] ?>" readonly>
                    <small id="contact_emailHelp" class="form-text"></small>
                </div>
                <div class="vendor-form-group">
                    <label for="">備註</label>
                    <input id="remark" type="text" name="remark" value="<?= $row2['remark'] ?>" readonly>
                    <small id="remarkHelp" class="form-text"></small>
                </div>
                <div class="vendor-form-group">
                    <button type="submit" class="edit-finished edit-button ml-auto" onclick="return checkForm()">編輯完成</button>
                </div>
            </form>
        </div>
        <!-- <input  type="button" value="">    onclick="return false"-->

    <script>
        let btn = document.querySelector('.vendor-button');
        let principal = document.querySelector('input[name="principal"]');
        let contactPerson = document.querySelector('input[name="contact_person"]');
        let finished = document.querySelector('.edit-finished');
        let inputs = document.querySelectorAll('input');

        let edit = document.querySelector('.edit');

        btn.onclick = () => {
            let principalValue = principal.value;
            contactPerson.value = principalValue;   
        }

        edit.onclick = () => {
            inputs.forEach(function(input) {
                input.removeAttribute("readOnly");
                input.style.backgroundColor = "#fff";
            })
        }
        
        let i, s, item;
        const required_fields = [
            {
                id: 'name',
                pattern: /.+/,
                info: '這是必填欄位！'
            },
            {
                id: 'bank_account',
                pattern: /.+/,
                info: '這是必填欄位！'
            },
            {
                id: 'company_no',
                pattern: /.+/,
                info: '這是必填欄位！'
            },
            {
                id: 'contact_person',
                pattern: /.+/,
                info: '這是必填欄位！'
            },
            {
                id: 'contact_email',
                // pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
                pattern: /.+/,
                info: '這是必填欄位！'
            },
            {
                id: 'contact_number',
                pattern: /.+/,
                info: '這是必填欄位！'
            },
        ];

        for(s in required_fields){
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }


        function checkForm() {

           

            for(s in required_fields) {
                item = required_fields[s];
                item.el.style.border = '1px solid rgb(111, 108, 108)';
                // item.infoEl.innerHTML = '';
            }

            // finished.style.display = 'none';

            // 檢查必填欄位, 欄位值的格式
            let isPass = true;

            for(s in required_fields) {
                item = required_fields[s];
                console.log(item);
                if(!item.pattern.test(item.el.value)){
                    item.el.style.border = '2px solid red';
                    item.infoEl.innerHTML = item.info;
                    isPass = false;
                }
            }

                
                // btn.style.display = "none";
                // finished.style.display = "none";

            //})
            // for(let i=0; i<inputs.length; i++){
            //     inputs[i].style.border = "none" ;
            //     inputs[i].style.borderBottom = "1px solid black";
            //     inputs[i].style.borderRadius = "0";
            //     console.log(inputs[i].style);

            // }
           return isPass

            btn.onclick = () => {
                let principalValue = principal.value;
                contactPerson.value = principalValue;
            
            }
            finished.onclick = () => {
                for(let i=0; i<inputs.length; i++){
                    inputs[i].style.border = "none" ;
                    // inputs[i].style.border-bottom = 1 + "px"+ ''+ "solid" + '' +  "#000";
                    finished.style.display = "none";
                    btn.style.display = "none";

                }
                return false
            //inputs.style.border = "none";
            }
        }
    </script>
<?php include("include/__footer.php");?>

