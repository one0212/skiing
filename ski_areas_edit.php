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

<?php include("include/v2-head.php"); ?>
<!-- HTML開頭＋link -->

<!-- 導覽列 bootstrap的code -->

<div>
<?php include("include/v2-sidebar.php"); ?>
    <!-- 側邊欄 -->



    <!-- 自己的html,css   code放這邊 -->
    <link rel="stylesheet" href="css/ski_areas_edit.css">
    <div class="main">
    <section class="container mt-4">
    <a href="ski_areas_list.php" class="page-link" style="background:#212529;color:#fff;border-radius:.25rem;width:10rem;margin:1rem;"><i class="fas fa-undo-alt" style="color:#fff;"></i>雪場資料列表</a>
                <form name="form1" onsubmit="return checkForm()">
                <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="">名稱</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                        <small id="nameHelp" class="form-text"></small>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">國家</label>
                        <input type="text" class="form-control" id="country" name="country" value="<?= htmlentities($row['country']) ?>">
                        <small id="countryHelp" class="form-text"></small>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">地址</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= htmlentities($row['address']) ?>">
                        <small id="addressHelp" class="form-text"></small>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" style="margin-bottom:1rem">描述</label><br>
                    <textarea class="form-control" id="description" name="description" rows="6" cols="87" style="overflow-y:hidden;resize:none;padding:0.7rem 0.8rem;line-height:1.5rem;border: 1px solid #ced4da;border-radius: 0.25rem;"><?= htmlentities($row['description']) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="">營運起始時間</label>
                    <input type="text" class="form-control" id="season_s" name="skiing_season_s" autocomplete="off" value="<?= htmlentities($row['skiing_season_s']) ?>">
                    <small id="season_sHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="">營運結束時間</label>
                    <input type="text" class="form-control" id="season_e" name="skiing_season_e" autocomplete="off" value="<?= htmlentities($row['skiing_season_e']) ?>">
                    <small id="season_eHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="">營業起始時間</label>
                    <input type="text" class="form-control" id="hours_s" name="business_hours_s" value="<?= htmlentities($row['business_hours_s']) ?>">
                    <small id="hours_sHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="">營業結束時間</label>
                    <input type="text" class="form-control" id="hours_e" name="business_hours_e" value="<?= htmlentities($row['business_hours_e']) ?>">
                    <small id="hours_eHelp" class="form-text"></small>
                </div>

                <div class="form-row">
                    <div class="form-group form_g col-md-6">
                        <label for="">雪場圖片</label><br>
                        <input type="file" class="form-control-file" id="ski_image" name="ski_image" style="display: none" onchange="myPreviewFile(event)">
                        <button type="button" class="btn btn-outline-light" onclick="selUploadFile(event)">選擇上傳的檔案</button>
                        <img src="<?= 'uploads/'.htmlentities($row['ski_image']) ?>" alt="" style="width:150px">
                        <img src="" height="200" alt="Image preview..." class="img_preview" style="display: none">
                    </div>
                    <div class="form-group form_g col-md-6">
                        <label for="">雪場地圖</label><br>
                        <input type="file" class="form-control-file" id="ski_map" name="ski_map" style="display: none" onchange="myPreviewFile(event)">
                        <button type="button" class="btn btn-outline-light" onclick="selUploadFile(event)">選擇上傳的檔案</button>
                        <img src="<?= 'uploads/'.htmlentities($row['ski_map']) ?>" alt="" style="width:150px">
                        <img src="" height="200" alt="Image preview..." class="img_preview" style="display: none">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="">面積</label>
                        <input type="text" class="form-control" id="acreage" name="acreage" value="<?= htmlentities($row['acreage']) ?>">
                        <small id="acreageHelp" class="form-text"></small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">雪道數量</label>
                        <input type="text" class="form-control" id="number" name="number_of_courses" value="<?= htmlentities($row['number_of_courses']) ?>">
                        <small id="numberHelp" class="form-text"></small>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">最長滑行距離</label>
                        <input type="text" class="form-control" id="longest" name="longest_run" value="<?= htmlentities($row['longest_run']) ?>">
                        <small id="longestHelp" class="form-text"></small>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">最大斜度</label>
                        <input type="text" class="form-control" id="gradient" name="slop_gradient" value="<?= htmlentities($row['slop_gradient']) ?>">
                        <small id="gradientHelp" class="form-text"></small>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">標高差</label>
                        <input type="text" class="form-control" id="vertical" name="vertical_drop" value="<?= htmlentities($row['vertical_drop']) ?>">
                        <small id="verticalHelp" class="form-text"></small>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">門票</label>
                    <textarea class="form-control" id="tickets" name="tickets" rows="6" style="overflow-y:hidden;resize:none;padding:0.7rem 0.8rem;line-height:1.5rem;border: 1px solid #ced4da;border-radius: 0.25rem;"><?= htmlentities($row['tickets']) ?></textarea>
                    <small id="ticketsHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="">租借</label>
                    <textarea class="form-control" id="rentals" name="rentals" rows="6" style="overflow-y:hidden;resize:none;padding:0.7rem 0.8rem;line-height:1.5rem;border: 1px solid #ced4da;border-radius: 0.25rem;"><?= htmlentities($row['rentals']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="">課程</label>
                    <textarea class="form-control" id="lessons" name="lessons" rows="6" style="overflow-y:hidden;resize:none;padding:0.7rem 0.8rem;line-height:1.5rem;border: 1px solid #ced4da;border-radius: 0.25rem;"><?= htmlentities($row['lessons']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="">飯店</label>
                    <textarea class="form-control" id="hostel" name="hostel" rows="6" style="overflow-y:hidden;resize:none;padding:0.7rem 0.8rem;line-height:1.5rem;border: 1px solid #ced4da;border-radius: 0.25rem;"><?= htmlentities($row['hostel']) ?></textarea>
                </div>

                <div class="form-row">   
                    <div class="form-group form_g col-md-6">
                        <label for="">飯店圖片</label><br>
                        <input type="file" class="form-control-file" id="hostel_image" name="hostel_image" style="display: none" onchange="myPreviewFile(event)">
                        <button type="button" class="btn btn-outline-light" onclick="selUploadFile(event)">選擇上傳的檔案</button>
                        <img src="<?= 'uploads/'.htmlentities($row['hostel_image']) ?>" alt="" style="width:150px">
                        <img src="" height="200" alt="Image preview..." class="img_preview" style="display: none">
                    </div>
                    <div class="col-md-6">
                        <p class="access">交通方式</p>
                        <div class="form-group">
                            <label for="">汽車</label>
                            <input type="text" class="form-control" id="car" name="access_car" value="<?= htmlentities($row['access_car']) ?>">
                            <small id="carHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="">搭乘電車</label>
                            <input type="text" class="form-control" id="bus" name="access_bus" value="<?= htmlentities($row['access_bus']) ?>">
                            <small id="busHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="">高速巴士</label>
                            <input type="text" class="form-control" id="train" name="access_train" value="<?= htmlentities($row['access_train']) ?>">
                            <small id="trainHelp" class="form-text"></small>
                        </div>
                    </div>
                </div>
                <button type="submit" class="submit btn btn-outline-light" id="submit_btn">確認修改</button>
            </form>
    </section>       
    </div>
        <script>
            function selUploadFile(event) {
                var btn = event.target;
                var field = btn.closest('.form_g').querySelector('input');
                field.click();
            }

            function myPreviewFile(event) {

                var me = event.target;
                var preview = me.closest('.form_g').querySelector('img');
                var p = me.closest('.form_g').querySelector('.p_img');
              
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
                    id: 'season_s',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'season_e',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'hours_s',
                    pattern: /.+/,
                    info: '這是必填項目!'
                },
                {
                    id: 'hours_e',
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
<?php include("include/v2-footer.php"); ?>
<script>
        $("#season_s").datepicker();
        $("#season_e").datepicker();
</script>