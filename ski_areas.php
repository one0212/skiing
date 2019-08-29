<?php
require("config.php");
$page_name = 'ski_areas';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/vendor.css">

    <title>新增雪場</title>
    <style>
    #form {
        
    }
    .form_group {
        height: 60px;
        display: flex;
        align-items: center;
    }
    label {
        
    }
    small {
        color: red;
    }
    .access {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
</style>
</head>

<body>
    <div id="wrapper" style="max-width:1024px;display:flex;">
        <?php
        include("include/__sidebar.php");
        ?>
        <div class="alert" role="alert" id="info-bar" style="display: none"></div>
        <div class="form">
            <form name="form1" onsubmit="return checkForm()">
                <div class="form_group">
                    <label for="">名稱</label>
                    <input type="text" id="name" name="name">
                    <small id="nameHelp" class="form-text"></small>
                </div>
                <div class="form_group">
                    <label for="">國家</label>
                    <input type="text" id="country" name="country">
                    <small id="countryHelp" class="form-text"></small>
                </div>
                <div class="form_group">
                    <label for="">地址</label>
                    <input type="text" id="address" name="address">
                    <small id="addressHelp" class="form-text"></small>
                </div>
                <div class="form_group">
                    <label for="">描述</label>
                    <input type="text" id="description" name="description">
                </div>
                <div class="form_group">
                    <label for="">營運期間</label>
                    <input type="text" id="season" name="skiing_season">
                    <small id="seasonHelp" class="form-text"></small>
                </div>
                <div class="form_group">
                    <label for="">營業時間</label>
                    <input type="text" id="hours" name="business_hours">
                    <small id="hoursHelp" class="form-text"></small>
                </div>
                <div class="form_group">
                    <label for="">雪場圖片</label>
                    <input type="text" id="ski_image" name="ski_image">
                </div>
                <div class="form_group">
                    <label for="">面積</label>
                    <input type="text" id="acreage" name="acreage">
                    <small id="acreageHelp" class="form-text"></small>
                </div>
                <div class="form_group">
                    <label for="">雪道數量</label>
                    <input type="text" id="number" name="number_of_courses">
                    <small id="numberHelp" class="form-text"></small>
                </div>
                <div class="form_group">
                    <label for="">最長滑行距離</label>
                    <input type="text" id="longest" name="longest_run">
                    <small id="longestHelp" class="form-text"></small>
                </div>
                <div class="form_group">
                    <label for="">最大斜度</label>
                    <input type="text" id="gradient" name="slop_gradient">
                    <small id="gradientHelp" class="form-text"></small>
                </div>
                <div class="form_group">
                    <label for="">標高差</label>
                    <input type="text" id="vertical" name="vertical_drop">
                    <small id="verticalHelp" class="form-text"></small>
                </div>
                <div class="form_group">
                    <label for="">雪場地圖</label>
                    <input type="text" id="ski_map" name="ski_map">
                </div>
                <div class="form_group">
                    <label for="">門票</label>
                    <input type="text" id="tickets" name="tickets">
                    <small id="ticketsHelp" class="form-text"></small>
                </div>
                <div class="form_group">
                    <label for="">租借</label>
                    <input type="text" id="rentals" name="rentals">
                </div>
                <div class="form_group">
                    <label for="">課程</label>
                    <input type="text" id="lessons" name="lessons">
                </div>
                <div class="form_group">
                    <label for="">飯店</label>
                    <input type="text" id="hostel" name="hostel">
                </div>
                <div class="form_group">
                    <label for="">飯店圖片</label>
                    <input type="text" id="hostel_image" name="hostel_image">
                </div>
                <p class="access">交通</p>
                <div class="form_group">
                    <label for="">汽車</label>
                    <input type="text" id="car" name="access_car">
                    <small id="carHelp" class="form-text"></small>
                </div>
                <div class="form_group">
                    <label for="">搭乘電車</label>
                    <input type="text" id="bus" name="access_bus">
                    <small id="busHelp" class="form-text"></small>
                </div>
                <div class="form_group">
                    <label for="">高速巴士</label>
                    <input type="text" id="train" name="access_train">
                    <small id="trainHelp" class="form-text"></small>
                </div>
                <button type="submit" class="submit" id="submit_btn">新增雪場</button>
            </form>
        </div>
    <script>
            let info_bar = document.querySelector('#info-bar');
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
            for(s in required_fields){
                item = required_fields[s];
                item.el = document.querySelector('#' + item.id);
                item.infoEl = document.querySelector('#' + item.id + 'Help');
            }

            // 先讓所有欄位外觀回復到原本的狀態
            function checkForm() {
                for(s in required_fields) {
                    item = required_fields[s];
                    item.el.style.border = '1px solid #000';
                    item.infoEl.innerHTML = '';
                }
                info_bar.style.display = 'none';
                info_bar.innerHTML = '';

                submit_btn.style.display = 'none';

                // 檢查必填欄位, 欄位值的格式
                let isPass = true;

                for(s in required_fields) {
                    item = required_fields[s];
                    if(! item.pattern.test(item.el.value)){
                        item.el.style.border = '1px solid red';
                        item.infoEl.innerHTML = item.info;
                        isPass = false;
                    }
                }

                let fd = new FormData(document.form1);

                if(isPass) {
                    fetch('ski_areas_api.php', {
                        method: 'POST',
                        body: fd,
                    })
                        .then(response => {
                            return response.json();//拿裡面的內容轉換成json
                        })
                        .then(json => {
                            console.log(json);
                            submit_btn.style.display = 'block';
                            info_bar.style.display = 'block';
                            info_bar.innerHTML = json.info;
                            if (json.success) {
                                alert("成功!");
                            } else {
                                alert("失敗!");
                            }
                        });
                } else {
                    submit_btn.style.display = 'block';
                }
                return false; // 表單不用傳統的 post 方式送出

            }
        </script>
        
    </div>
    
</body>

</html>