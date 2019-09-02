<?php require("config.php");
// 連線資料
session_start();

// 自己的php
$page_name = 'ski_areas';

$page_title = '新增雪場';



?>

<?php include("include/__head.php"); ?>
<!-- HTML開頭＋link -->
<?php include("include/__navbar.php"); ?>
<!-- 導覽列 bootstrap的code -->

<div style="display:flex;">
    <?php include("include/__sidebar.php"); ?>
    <!-- 側邊欄 -->



    <!-- 自己的html,css   code放這邊 -->
    <link rel="stylesheet" href="css/ski_areas.css">
    <div class="container">
    <a href="ski_areas_list.php" class="page-link" style="color:#aaa; margin-top:1.3rem; margin-left:2rem; width:9.3rem;"><i class="fas fa-undo-alt" style="color:#aaa; margin:0.2rem;"></i></i>雪場資料列表</a>
        <div class="card" style="margin: 2rem">
            <div class="card-body">
                <form name="form1" onsubmit="return checkForm()">
                    <div class="form_group">
                        <label for="">名稱</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <small id="nameHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">國家</label>
                        <input type="text" class="form-control" id="country" name="country">
                        <small id="countryHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">地址</label>
                        <input type="text" class="form-control" id="address" name="address">
                        <small id="addressHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">描述</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="form_group">
                        <label for="">營運期間</label>
                        <input type="text" class="form-control" id="season" name="skiing_season">
                        <small id="seasonHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">營業時間</label>
                        <input type="text" class="form-control" id="hours" name="business_hours">
                        <small id="hoursHelp" class="form-text"></small>
                    </div>

                    <div>

                    </div>

                    <div class="form-group">
                        <label for="">雪場圖片</label>
                        <input type="file" class="form-control-file" id="ski_image" name="ski_image" style="display: none" onchange="myPreviewFile(event)">
                        <button type="button" class="btn btn-info" onclick="selUploadFile(event)">選擇上傳的檔案</button>
                        <img src="" height="200" alt="Image preview..." class="img_preview" style="display: none">
                    </div>

                    <div class="form_group">
                        <label for="">面積</label>
                        <input type="text" class="form-control" id="acreage" name="acreage">
                        <small id="acreageHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">雪道數量</label>
                        <input type="text" class="form-control" id="number" name="number_of_courses">
                        <small id="numberHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">最長滑行距離</label>
                        <input type="text" class="form-control" id="longest" name="longest_run">
                        <small id="longestHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">最大斜度</label>
                        <input type="text" class="form-control" id="gradient" name="slop_gradient">
                        <small id="gradientHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">標高差</label>
                        <input type="text" class="form-control" id="vertical" name="vertical_drop">
                        <small id="verticalHelp" class="form-text"></small>
                    </div>

                    <div class="form-group">
                        <label for="">雪場地圖</label>
                        <input type="file" class="form-control-file" id="ski_map" name="ski_map" style="display: none" onchange="myPreviewFile(event)">
                        <button type="button" class="btn btn-info" onclick="selUploadFile(event)">選擇上傳的檔案</button>
                        <img src="" height="200" alt="Image preview..." class="img_preview" style="display: none">
                    </div>

                    <div class="form_group">
                        <label for="">門票</label>
                        <input type="text" class="form-control" id="tickets" name="tickets">
                        <small id="ticketsHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">租借</label>
                        <input type="text" class="form-control" id="rentals" name="rentals">
                    </div>
                    <div class="form_group">
                        <label for="">課程</label>
                        <input type="text" class="form-control" id="lessons" name="lessons">
                    </div>
                    <div class="form_group">
                        <label for="">飯店</label>
                        <input type="text" class="form-control" id="hostel" name="hostel">
                    </div>

                    <div class="form-group">
                        <label for="">飯店圖片</label>
                        <input type="file" class="form-control-file" id="hostel_image" name="hostel_image" style="display: none" onchange="myPreviewFile(event)">
                        <button type="button" class="btn btn-info" onclick="selUploadFile(event)">選擇上傳的檔案</button>
                        <img src="" height="200" alt="Image preview..." class="img_preview" style="display: none">
                    </div>

                    <p class="access">交通</p>
                    <div class="form_group">
                        <label for="">汽車</label>
                        <input type="text" class="form-control" id="car" name="access_car">
                        <small id="carHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">搭乘電車</label>
                        <input type="text" class="form-control" id="bus" name="access_bus">
                        <small id="busHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">高速巴士</label>
                        <input type="text" class="form-control" id="train" name="access_train">
                        <small id="trainHelp" class="form-text"></small>
                    </div>
                    <button type="submit" class="submit btn btn-secondary" id="submit_btn">新增雪場</button>
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
                    id: 'country',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'address',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'season',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'hours',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'acreage',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'number',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'longest',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'gradient',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'vertical',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'tickets',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'car',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'bus',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'train',
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
                    fetch('ski_areas_api.php', {
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
                                alert("雪場新增成功!");
                                window.location.href="ski_areas_list.php";
                            } else {
                                alert("雪場新增失敗!");
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