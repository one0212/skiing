<?php require 'config.php';
// 連線資料
session_start();
// 自己的php

?>

<?php include 'include/v2-head.php'; ?>
<!-- HTML開頭＋link -->

<!-- 導覽列 bootstrap的code -->

<?php include 'include/v2-sidebar-ski.php'; ?>
<div class="container" >
<!-- <div id="wrapper" style="max-width:1024px;display:flex;"> -->
    <!-- 側邊欄 -->
    <section class="coachsection">
 
        <div class="form">
 
            <form name="formcoach" onsubmit="return checkForm()">
            <div class="d-flex justify-content-end ">
                    <a href="__coach_list.php" class="page-link" style="color:#aaa"><i class="fas fa-edit" style="color:#aaa; margin:0.1rem;"></i>回編輯</a>
                </div>
                <div class="form-group">
                    <label for="name">姓名</label>
                    <input type="text" class="form-control" id="name" name="name">
                    <small id="nameHelp" class="form-text"></small>
                </div>
                <div class="form-group ">
                    <label for="">性別</label>
                    <div class="from-row">
                        <div class="custom-control custom-radio custom-control-inline col-md-1">
                            <input type="radio" id="customRadioInline1" name="male" class="custom-control-input" value="男" checked>
                            <label class="custom-control-label" for="customRadioInline1">男</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline col-md-1">
                            <input type="radio" id="customRadioInline2" name="male" class="custom-control-input" value="女">
                            <label class="custom-control-label" for="customRadioInline2">女</label>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="">語言</label>
                    <div class="from-row">
                        <div class="custom-control custom-radio custom-control-inline col-md-2">
                            <input type="radio" id="lan1" name="lang" class="custom-control-input" value="中文" checked>
                            <label class="custom-control-label" for="lan1">中文</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline col-md-2">
                            <input type="radio" id="lan2" name="lang" class="custom-control-input" value="日文">
                            <label class="custom-control-label" for="lan2">日文</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline col-md-2">
                            <input type="radio" id="lan2" name="lang" class="custom-control-input" value="英文">
                            <label class="custom-control-label" for="lan3">英文</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">目前雪場</label>
                    <select name="local">
                    <option value="-------------">------------------------------------------------</option>
                        <option value="札幌國際滑雪場">札幌國際滑雪場</option>
                        <option value="富良野滑雪場">富良野滑雪場</option>
                        <option value="上越國際滑雪場">上越國際滑雪場</option>
                        <option value="妙高杉之原滑雪場">妙高杉之原滑雪場</option>
                        <option value="苗場滑雪場">苗場滑雪場</option>
                        <option value="藏王溫泉滑雪場">藏王溫泉滑雪場</option>
                        <option value="八甲田滑雪場">八甲田滑雪場</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="lic">證照</label>
                    <input type="text" class="form-control" id="lic" name="lic">
                    <small id="licHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="Experience">經歷</label>
                    <input type="text" class="form-control" id="Experience" name="Experience">
                    <small id="ExperienceHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="skiage">年資</label>
                    <input type="text" class="form-control" id="skiage" name="skiage">
                    <small id="skiageHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="idea">理念</label>
                    <input type="text" class="form-control" id="idea" name="idea">
                    <small id="ideaHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="class">課程</label>
                    <input type="text" class="form-control" id="class" name="class">
                    <small id="classHelp" class="form-text"></small>
                </div>
                <div class="form-group">
                    <label for="price">價錢</label>
                    <input type="text" class="form-control" id="price" name="price">
                    <small id="priceHelp" class="form-text"></small>
                </div>

                <button type="submit" class="coachsubmit btn btn-primary">新增</button>
            </form>
        </div>
    </section>
    <script>
        let info_bar = document.querySelector('#info-bar');
        const submit_btn = document.querySelector('.coachsubmit');
        let name = document.querySelector('#name');
        let idea = document.querySelector('#idea');
        const required_fields = [{
                id: 'name',
                pattern: /^\S{2,}/,
                info: '請填寫正確的姓名'
            },
            {
                id: 'skiage',
                pattern: /^\S{1,}/,
                info: '請填寫年資'
            },
            {
                id: 'class',
                pattern: /^\S{2,}/,
                info: '請填寫課程內容'
            },
            {
                id: 'price',
                pattern: /^\S{2,}/,
                info: '請填寫每堂價格'
            },
        ];
        for (s in required_fields) {
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }


        function checkForm() {

            let isPass = true;

            for (s in required_fields) {
                item = required_fields[s];

                if (!item.pattern.test(item.el.value)) {
                    item.el.style.border = '1px solid red';
                    item.infoEl.innerHTML = item.info;
                    item.infoEl.style.color = 'red';
                    isPass = false;
                }
            }


            let fd = new FormData(formcoach);

            if (isPass) {
                fetch('__coach_data_insert_api.php', {
                        method: 'POST',
                        body: fd,
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        // console.log(json);
                        // submit_btn.style.display = 'block';
                        // info_bar.style.display = 'block';
                        // info_bar.innerHTML = json.info;
                        if (json.success) {
                            alert('新增成功');
                        } else {
                            alert('新增失敗');
                        }
                    });
            } else {
                submit_btn.style.display = 'block';
            }
            return false; // 表單不出用傳統的 post 方式送出
        }
    </script>



    <!-- 自己的html,css   code放這邊 -->


</div>
<?php include 'include/v2-footer.php'; ?>