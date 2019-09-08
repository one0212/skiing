<?php require("config.php");
// 連線資料
session_start();

// 自己的php
$page_name = 'ski_rentals';

$page_title = '新增裝備租借';

?>

<?php include("include/__head.php"); ?>
<!-- HTML開頭＋link -->
<?php include("include/__navbar.php"); ?>
<!-- 導覽列 bootstrap的code -->

<div style="display:flex;">
    <?php include("include/__sidebar.php"); ?>
    <!-- 側邊欄 -->



    <!-- 自己的html,css   code放這邊 -->
    <link rel="stylesheet" href="css/ski_rentals.css">
    <div class="container">
        <a href="ski_rentals_list.php" class="page-link" style="color:#aaa; margin-top:1.3rem; margin-left:2rem; width:9.3rem;"><i class="fas fa-undo-alt" style="color:#aaa; margin:0.2rem;"></i></i>租借資料列表</a>
        <div class="card" style="margin: 2rem">
            <div class="card-body">
                <form name="form1" onsubmit="return checkForm()">
                    <div class="form_group">
                        <label for="">名稱</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <small id="nameHelp" class="form-text"></small>
                    </div>
                    <div class="form-group">
                        <label for="">裝備圖片</label>
                        <input type="file" class="form-control-file" id="image" name="image" style="display: none" onchange="myPreviewFile(event)">
                        <button type="button" class="btn btn-info" onclick="selUploadFile(event)">選擇上傳的檔案</button>
                        <img src="" height="200" alt="Image preview..." class="img_preview" style="display: none">
                    </div>
                    <br>
                    <div class="gender1">
                    <label for="">性別</label><br>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline1" name="gender" class="custom-control-input" value="男">
                        <label class="custom-control-label" for="customRadioInline1">男</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline2" name="gender" class="custom-control-input" value="女">
                        <label class="custom-control-label" for="customRadioInline2">女</label>
                        <small id="genderHelp" class="form-text"></small>
                    </div>
                    </div>
                    <br>
                    <div class="type1">
                    <label for="">類型</label><br>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline3" name="type" class="custom-control-input" value="大人">
                        <label class="custom-control-label" for="customRadioInline3">大人</label>  
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline4" name="type" class="custom-control-input" value="小孩">
                        <label class="custom-control-label" for="customRadioInline4">小孩</label>
                        <small id="typeHelp" class="form-text"></small>
                    </div>
                    </div>
                    <br>
                    <div class="size1">
                    <label for="">尺碼</label><br>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline5" name="size" class="custom-control-input" value="S">
                        <label class="custom-control-label" for="customRadioInline5">S</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline6" name="size" class="custom-control-input" value="M">
                        <label class="custom-control-label" for="customRadioInline6">M</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline7" name="size" class="custom-control-input" value="L">
                        <label class="custom-control-label" for="customRadioInline7">L</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline8" name="size" class="custom-control-input" value="XL">
                        <label class="custom-control-label" for="customRadioInline8">XL</label>
                        <small id="sizeHelp" class="form-text"></small>
                    </div>
                    </div>
                    <br>
                    <div class="time1">
                    <label for="">時間</label><br>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline9" name="time" class="custom-control-input" value="兩日">
                        <label class="custom-control-label" for="customRadioInline9">兩日</label>
                        <small id="ticketHelp" class="form-text"></small>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline10" name="time" class="custom-control-input" value="一日">
                        <label class="custom-control-label" for="customRadioInline10">一日</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="customRadioInline11" name="time" class="custom-control-input" value="半日(5小時)">
                        <label class="custom-control-label" for="customRadioInline11">半日(5小時)</label>
                        <small id="timeHelp" class="form-text"></small>
                    </div>
                    </div>
                    <br>
                    <div class="form_group">
                        <label for="">數量</label>
                        <input type="text" class="form-control" id="quantity" name="quantity">
                        <small id="quantityHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">價格</label>
                        <input type="text" class="form-control" id="price" name="price">
                        <small id="priceHelp" class="form-text"></small>
                    </div>
                    <br>
                    
                    <button type="submit" class="submit btn btn-secondary" id="submit_btn">新增</button>
                </form>
            </div>
        </div>
        <script>

            function selUploadFile(event) {
                var btn = event.target;
                var field = btn.closest('.form-group').querySelector('input');
                field.click();
            }

            function myPreviewFile(event) {

                var me = event.target;
                var preview = me.closest('.form-group').querySelector('img');
                preview.style.display = 'block';

                var file = me.files[0];
                var reader = new FileReader();

                reader.addEventListener("load", function() {
                    preview.src = reader.result;
                }, false);

                if (file) {
                    reader.readAsDataURL(file);
                }
            }
            const submit_btn = document.querySelector('#submit_btn');
            let i, s, item;
            const required_fields = [{
                    id: 'name',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'quantity',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'price',
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
                    fetch('ski_rentals_api.php', {
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
                                alert("裝備租借新增成功!");
                                window.location.href="ski_rentals_list.php";
                            } else {
                                alert("裝備租借新增失敗!");
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