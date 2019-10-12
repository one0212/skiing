<?php require("config.php"); // 連線資料
session_start();


//資料庫連線  
$country_sql = 'SELECT * FROM `country`';
$country_stmt = $db->query($country_sql);
//$countryRows = $country_stmt->fetchAll(PDO::FETCH_ASSOC);  //使用 while 迴圈
//


?> 
<?php include("include/v2-head.php"); ?>
<?php include("include/v2-sidebar-ski.php"); ?>



<!-- 自己的html,css   code放這邊 -->
<link rel="stylesheet" href="CSS/brand.css">





<div class="main">
    <section class="container">
        <div>
            <h4 class="title">品牌基本資料</h4>
            <span></span>
        </div>
        <form action="brand_insert_api.php" class="row form1" method="post">
            <!-- 品牌資料表 -->
            <div class="col-9 info_left">
                <div class="form-group">
                    <label for="brand_name">品牌名稱</label>
                    <input type="text" class="form-control" id="brand_name" name="brand_name">
                    <small id="brand_name_help" class="form-text"></small>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="brand_since">成立年份</label>
                        <input type="text" class="form-control" id="brand_since" name="brand_since">
                    </div>
                    <div class="form-group col-md-3 ml-2">
                        <label for="country_id">成立地點</label>
                        <select class="form-control" id="country_id" name="country_id">
                            <?php while ($r = $country_stmt->fetch()) { ?>
                                <option value="<?= $r['country_id'] ?>"><?= $r['country_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="brand_about">品牌故事</label>
                    <textarea class="form-control" id="brand_about" rows="3" name="brand_about"></textarea>
                </div>
            </div>
            <div class="col-3 info_right">
                <div class="container user">
                    <div class="user_figure radius_border">
                        <img id="avatar" class="upload_img" src="" alt="">
                    </div>
                    <div class="py-4 cc">
                        <label class="btn btn-outline-light">
                            <input type="file" class="form-control-file" style="display:none;" id="brand_logo" name="brand_logo" onchange="showPreview(this)">
                            <!-- <input type="text" class="form-control-file" style="display:none;" id="brand_logo" name="brand_logo" onchange="showPreview(this)">  -->
                            <span>選擇圖片</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="text-lift">
                    <button type="submit" class="btn btn-outline-light">送出</button>
                </div>
            </div>
        </form>
    </section>
</div>


<script>
    function showPreview(source) {
        var file = source.files[0];
        if (window.FileReader) {
            var fr = new FileReader();
            console.log(fr);
            var portrait = document.getElementById('avatar');
            fr.onloadend = function(e) {
                portrait.src = e.target.result;
            };
            fr.readAsDataURL(file);
            portrait.style.display = 'block';
        }
    }
</script>





<?php include("include/v2-footer.php"); ?>