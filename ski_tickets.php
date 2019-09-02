<?php require("config.php");
// 連線資料
session_start();

// 自己的php
$page_name = 'ski_tickets';

$page_title = '新增票劵';



?>

<?php include("include/__head.php"); ?>
<!-- HTML開頭＋link -->
<?php include("include/__navbar.php"); ?>
<!-- 導覽列 bootstrap的code -->

<div style="display:flex;">
    <?php include("include/__sidebar.php"); ?>
    <!-- 側邊欄 -->



    <!-- 自己的html,css   code放這邊 -->
    <link rel="stylesheet" href="css/ski_tickets.css">
    <div class="container">
        <a href="ski_tickets_list.php" class="page-link" style="color:#aaa; margin-top:1.3rem; margin-left:2rem; width:9.3rem;"><i class="fas fa-undo-alt" style="color:#aaa; margin:0.2rem;"></i></i>票劵資料列表</a>
        <div class="card" style="margin: 2rem">
            <div class="card-body">
                <form name="form1" onsubmit="return checkForm()">
                    <div class="form_group">
                        <label for="">名稱</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <small id="nameHelp" class="form-text"></small>
                    </div>
                    <br>
                    <div class="tickets1">
                    <label for="">門票</label><br>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="ticket" class="custom-control-input" value="兩日票">
                        <label class="custom-control-label" for="customRadioInline1">兩日票</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="ticket" class="custom-control-input" value="一日票">
                        <label class="custom-control-label" for="customRadioInline2">一日票</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline3" name="ticket" class="custom-control-input" value="半日票(5小時)">
                        <label class="custom-control-label" for="customRadioInline3">半日票(5小時)</label>
                        <small id="ticketHelp" class="form-text"></small>
                    </div>
                    </div>
                    <br>
                    <div class="type1">
                    <label for="">類型</label><br>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline4" name="type" class="custom-control-input" value="一般(大人)">
                        <label class="custom-control-label" for="customRadioInline4">一般(大人)</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline5" name="type" class="custom-control-input" value="優待(小孩、老人)">
                        <label class="custom-control-label" for="customRadioInline5">優待(小孩、老人)</label>
                        <small id="typeHelp" class="form-text"></small>
                    </div>
                    </div>
                    <div class="form_group">
                        <label for="">價格</label>
                        <input type="text" class="form-control" id="rate" name="rate">
                        <small id="rateHelp" class="form-text"></small>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="">描述</label>
                        <input type="text" class="form-control" id="description" name="description">
                        <small id="descriptionHelp" class="form-text"></small>
                    </div>
                    <button type="submit" class="submit btn btn-secondary" id="submit_btn">新增票劵</button>
                </form>
            </div>
        </div>
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
                    item.el.style.border = '1px solid #000';
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
                    fetch('ski_tickets_api.php', {
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
                                alert("票劵新增成功!");
                                window.location.href="ski_tickets_list.php";
                            } else {
                                alert("票劵新增失敗!");
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
<?php include("include/__footer.php"); ?>