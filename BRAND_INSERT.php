<?php require("config.php"); // 連線資料
session_start();

$page_name = 'BRAND_INSERT';
$page_title = '品牌新增';

?>

<?php include("include/__head.php"); ?>
<?php include("include/__navbar.php"); ?>
<div style="display:flex;">
    <?php include("include/__sidebar.php"); ?>

    <!-- html Start ------------------------------------------->
    <div class="container pt-5">

        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title mb-3" style="font-size:68px;">ADD</h2>
                        <div class="alert alert-success " role="alert" id="info-bar" style="display:none"></div>
                        <form name="form1" onsubmit="return checkForm()">

                            <div class="form-group ">
                                <label for="name">品牌名稱</label>
                                <input type="text" class="form-control" id="name" name="name">
                                <small id="nameHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="country">品牌產地</label>
                                <select class="form-control" id="country" name="country">
                                    <option>-請選擇-</option>
                                    <option>法國</option>
                                    <option>德國</option>
                                    <option>日本</option>
                                    <option>台灣</option>
                                </select>
                            </div>
                            <!-- <div class="form-group ">
                                <label for="country">品牌產地</label>
                                <input type="text" class="form-control" id="country" name="country">
                                <small id="countryHelp" class="form-text"></small>
                            </div> -->
                            <div class="form-group">
                                <label for="logo_image">品牌商標</label>
                                <input type="text" class="form-control" id="logo_image" name="logo_image">
                                <small id="logo_imageHelp" class="form-text"></small>
                            </div>

                            <div class="form-group">
                                <label for="video">宣傳影片</label>
                                <input type="text" class="form-control" id="video" name="video">
                                <small id="videoHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="web">品牌網站</label>
                                <input type="text" class="form-control" id="web" name="web">
                                <small id="webHelp" class="form-text"></small>
                            </div>
                            <div class="form-group">
                                <label for="about">品牌介紹</label>
                                <textarea class="form-control" id="about" name="about" rows="3"></textarea>
                                <small id="aboutHelp" class="form-text"></small>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submit_btn">新增</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            let info_bar = document.querySelector('#info-bar');


            function checkForm() {
                // TODO: 檢查必填欄位, 欄位值的格式

                let fd = new FormData(document.form1);

                fetch('BRAND_INSERT_API.php', {
                        method: 'POST',
                        body: fd,
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);
                        info_bar.style.display = 'block';
                        info_bar.innerHTML = json.info;
                        if (json.success) {
                            info_bar.className = 'alert alert-success';
                        } else {
                            info_bar.className = 'alert alert-danger';
                        }
                    });

                return false; // 表單不出用傳統的 post 方式送出
            }
        </script>
    </div>
    <?php include("include/__footer.php"); ?>