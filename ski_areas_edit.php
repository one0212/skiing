<?php require("config.php");
// 連線資料
session_start();

// 自己的php
$page_name = 'ski_areas_edit';

$page_title = '編輯雪場資料';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if(empty($sid)) {
    header('Location: ski_areas_list.php');
    exit;
}

$sql = "SELECT * FROM `MGNT_SKI_AREAS` WHERE `sid`=$sid";
$row = $db->query($sql)->fetch();
if(empty($row)) {
    header('Location: ski_areas_list.php');
    exit;
}

?>

<?php include("include/__head.php"); ?>
<!-- HTML開頭＋link -->
<?php include("include/__navbar.php"); ?>
<!-- 導覽列 bootstrap的code -->

<div style="display:flex;">
    <?php include("include/__sidebar.php"); ?>
    <!-- 側邊欄 -->



    <!-- 自己的html,css   code放這邊 -->
    <link rel="stylesheet" href="css/ski_areas_edit.css">
    <div class="container">
    <a href="ski_areas_list.php" class="page-link" style="color:#aaa; margin-top:1.3rem; margin-left:2rem; width:9.3rem;"><i class="fas fa-undo-alt" style="color:#aaa; margin:0.2rem;"></i></i>雪場資料列表</a>
        <div class="card" style="margin: 2rem">
            <div class="card-body">
                <form name="form1" onsubmit="return checkForm()">
                <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                    <div class="form_group">
                        <label for="">名稱</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                        <small id="nameHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">國家</label>
                        <input type="text" class="form-control" id="country" name="country" value="<?= htmlentities($row['country']) ?>">
                        <small id="countryHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">地址</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= htmlentities($row['address']) ?>">
                        <small id="addressHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="" style="margin-bottom:1rem">描述</label><br>
                        <textarea id="description" name="description" rows="8" cols="87"><?= htmlentities($row['description']) ?></textarea>
                    </div>
                    <div class="form_group">
                        <label for="">營運期間</label>
                        <input type="text" class="form-control" id="season" name="skiing_season" value="<?= htmlentities($row['skiing_season']) ?>">
                        <small id="seasonHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">營業時間</label>
                        <input type="text" class="form-control" id="hours" name="business_hours" value="<?= htmlentities($row['business_hours']) ?>">
                        <small id="hoursHelp" class="form-text"></small>
                    </div>

                    <div>

                    </div>

                    <div class="form-group">
                        <label for="">雪場圖片</label>
                        <input type="file" class="form-control-file" id="ski_image" name="ski_image" style="display: none" onchange="myPreviewFile(event)">
                        <button type="button" class="btn btn-info" onclick="selUploadFile(event)">選擇上傳的檔案</button><br>
                        <img src="<?= 'uploads/'.htmlentities($row['ski_image']) ?>" alt="" style="width:150px">
                        <p class="p_img" style="display:none"><?= $row['ski_image'] ?></p>
                        <img src="" height="200" alt="Image preview..." class="img_preview" style="display: none">
                    </div>

                    <div class="form_group">
                        <label for="">面積</label>
                        <input type="text" class="form-control" id="acreage" name="acreage" value="<?= htmlentities($row['acreage']) ?>">
                        <small id="acreageHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">雪道數量</label>
                        <input type="text" class="form-control" id="number" name="number_of_courses" value="<?= htmlentities($row['number_of_courses']) ?>">
                        <small id="numberHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">最長滑行距離</label>
                        <input type="text" class="form-control" id="longest" name="longest_run" value="<?= htmlentities($row['longest_run']) ?>">
                        <small id="longestHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">最大斜度</label>
                        <input type="text" class="form-control" id="gradient" name="slop_gradient" value="<?= htmlentities($row['slop_gradient']) ?>">
                        <small id="gradientHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">標高差</label>
                        <input type="text" class="form-control" id="vertical" name="vertical_drop" value="<?= htmlentities($row['vertical_drop']) ?>">
                        <small id="verticalHelp" class="form-text"></small>
                    </div>

                    <div class="form-group">
                        <label for="">雪場地圖</label>
                        <input type="file" class="form-control-file" id="ski_map" name="ski_map" style="display: none" onchange="myPreviewFile(event)">
                        <button type="button" class="btn btn-info" onclick="selUploadFile(event)">選擇上傳的檔案</button><br>
                        <img src="<?= 'uploads/'.htmlentities($row['ski_map']) ?>" alt="" style="width:150px">
                        <p class="p_img" style="display:none"><?= htmlentities($row['ski_map']) ?></p>
                        <img src="" height="200" alt="Image preview..." class="img_preview" style="display: none">
                    </div>

                    <div class="form_group">
                        <label for="">門票</label>
                        <input type="text" class="form-control" id="tickets" name="tickets" value="<?= htmlentities($row['tickets']) ?>">
                        <small id="ticketsHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="" style="margin-bottom:1rem">租借</label><br>
                        <textarea id="rentals" name="rentals" rows="4" cols="87"><?= htmlentities($row['rentals']) ?></textarea>
                    </div>
                    <div class="form_group">
                        <label for="" style="margin-bottom:1rem">課程</label><br>
                        <textarea id="lessons" name="lessons" rows="4" cols="87"><?= htmlentities($row['lessons']) ?></textarea>
                    </div>
                    <div class="form_group">
                        <label for="">飯店</label>
                        <input type="text" class="form-control" id="hostel" name="hostel" value="<?= htmlentities($row['hostel']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="">飯店圖片</label>
                        <input type="file" class="form-control-file" id="hostel_image" name="hostel_image" style="display: none" onchange="myPreviewFile(event)">
                        <button type="button" class="btn btn-info" onclick="selUploadFile(event)">選擇上傳的檔案</button><br>
                        <img src="<?= 'uploads/'.htmlentities($row['hostel_image']) ?>" alt="" style="width:150px">
                        <p class="p_img" style="display:none"><?= htmlentities($row['hostel_image']) ?></p>
                        <img src="" height="200" alt="Image preview..." class="img_preview" style="display: none">
                    </div>

                    <p class="access">交通</p>
                    <div class="form_group">
                        <label for="">汽車</label>
                        <input type="text" class="form-control" id="car" name="access_car" value="<?= htmlentities($row['access_car']) ?>">
                        <small id="carHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">搭乘電車</label>
                        <input type="text" class="form-control" id="bus" name="access_bus" value="<?= htmlentities($row['access_bus']) ?>">
                        <small id="busHelp" class="form-text"></small>
                    </div>
                    <div class="form_group">
                        <label for="">高速巴士</label>
                        <input type="text" class="form-control" id="train" name="access_train" value="<?= htmlentities($row['access_train']) ?>">
                        <small id="trainHelp" class="form-text"></small>
                    </div>
                    <button type="submit" class="submit btn btn-secondary" id="submit_btn">確認修改</button>
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
                var p = me.closest('.form-group').querySelector('.p_img');
              
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
                    fetch('ski_areas_edit_api.php', {
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
                                window.location.href="ski_areas_list.php";
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
<?php include("include/__footer.php"); ?>