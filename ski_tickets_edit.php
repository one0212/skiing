<?php require("config.php");
// 連線資料
session_start();

// 自己的php
$page_name = 'ski_tickets_edit';

$page_title = '編輯票劵資料';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: ski_tickets_list.php');
    exit;
}

$sql = "SELECT * FROM `MGNT_SKI_TICKETS` WHERE `sid`=$sid";
$row = $db->query($sql)->fetch();
if (empty($row)) {
    header('Location: ski_tickets_list.php');
    exit;
}

?>

<?php include("include/v2-head.php"); ?>
<!-- HTML開頭＋link -->

<!-- 導覽列 bootstrap的code -->

<div style="display:flex;">
<?php include("include/v2-sidebar-ski.php"); ?>
    <!-- 側邊欄 -->



    <!-- 自己的html,css   code放這邊 -->
    <link rel="stylesheet" href="css/ski_areas.css">
    <div class="container">
        <a href="ski_tickets_list.php" class="page-link" style="background:#212529;color:#fff;border-radius:.25rem;width:11rem;margin-bottom:1rem;margin-top:2rem;"><i class="fas fa-undo-alt" style="color:#aaa; margin:0.2rem;"></i></i>票劵資料列表</a>
        
                <form name="form1" onsubmit="return checkForm()">
                <input type="hidden" name="sid" value="<?= ($row['sid']) ?>">
                    <div class="form-row">
                        <div class="form_group col-md-6">
                            <label for="">名稱</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                            <small id="nameHelp" class="form-text"></small>
                        </div>
                        <div class="form_group col-md-6">
                            <label for="">價格</label>
                            <input type="text" class="form-control" id="rate" name="rate" value="<?= htmlentities($row['rate']) ?>">
                            <small id="rateHelp" class="form-text"></small>
                        </div>
                    </div>
                    
                    <br>
                    <div class="tickets1">
                        <label for="">門票</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="ticket" class="custom-control-input" value="兩日票" <?php if ($row['ticket'] == "兩日票") echo ("checked"); ?>>
                            <label class="custom-control-label" for="customRadioInline1">兩日票</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="ticket" class="custom-control-input" value="一日票" <?php if ($row['ticket'] == "一日票") echo ("checked"); ?>>
                            <label class="custom-control-label" for="customRadioInline2">一日票</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline3" name="ticket" class="custom-control-input" value="半日票(5小時)" <?php if ($row['ticket'] == "半日票(5小時)") echo ("checked"); ?>>
                            <label class="custom-control-label" for="customRadioInline3">半日票(5小時)</label>
                            <small id="ticketHelp" class="form-text"></small>
                        </div>
                    </div>
                    <br>
                    <div class="type1">
                        <label for="">類型</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline4" name="type" class="custom-control-input" value="一般(大人)" <?php if ($row['type'] == "一般(大人)") echo ("checked"); ?>>
                            <label class="custom-control-label" for="customRadioInline4">一般(大人)</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline5" name="type" class="custom-control-input" value="優待(小孩、老人)" <?php if ($row['type'] == "優待(小孩、老人)") echo ("checked"); ?>>
                            <label class="custom-control-label" for="customRadioInline5">優待(小孩、老人)</label>
                            <small id="typeHelp" class="form-text"></small>
                        </div>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="" style="margin-bottom:1rem">描述</label><br>
                        <textarea class="form-control" id="description" name="description" rows="4" cols="87" style="overflow-y:hidden;resize:none;padding:0.7rem 0.8rem;line-height:1.5rem;border: 1px solid #ced4da;border-radius: 0.25rem;"></textarea>
                    </div>
                    <button type="submit" class="submit btn btn-outline-light" id="submit_btn">確認修改</button>
                </form>
      
        <script>
            const submit_btn = document.querySelector('#submit_btn');
            let i, s, item;
            const required_fields = [{
                    id: 'name',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'rate',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
            ];

            // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
            for (s in required_fields) {
                item = required_fields[s];
                item.el = document.querySelector('#' + item.id);
                item.infoEl = document.querySelector('#' + item.id + 'Help');
            }

            // 先讓所有欄位外觀回復到原本的狀態
            function checkForm() {
                for (s in required_fields) {
                    item = required_fields[s];
                    item.el.style.border = '1px solid #ced4da';
                    item.infoEl.innerHTML = '';
                }

                // 檢查必填欄位, 欄位值的格式
                let isPass = true;

                for (s in required_fields) {
                    item = required_fields[s];
                    if (!item.pattern.test(item.el.value)) {
                        item.el.style.border = '1px solid red';
                        item.infoEl.innerHTML = item.info;
                        isPass = false;
                    }
                }

                let fd = new FormData(document.form1);

                if (isPass) {
                    fetch('ski_tickets_edit_api.php', {
                            method: 'POST',
                            body: fd,
                        })
                        .then(response => {
                            return response.json(); //拿裡面的內容轉換成json
                        })
                        .then(json => {
                            console.log(json);
                            submit_btn.style.display = 'block';
                            if (json.success) {
                                alert("資料修改成功!");
                                window.location.href = "ski_tickets_list.php";
                            } else {
                                alert("資料未修改!");
                            }
                        });
                } else {
                    submit_btn.style.display = 'block';
                }
                return false; // 表單不用傳統的 post 方式送出

            }
        </script>

    </div>
</div>
<?php include("include/v2-footer.php"); ?>