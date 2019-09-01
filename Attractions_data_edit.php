<?php require("config.php");
// 連線資料
$page_name = 'data_edit';
$page_title = '編輯資料';
// 自己的php


$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if (empty($sid)) {
    header('Location:Attractions.php');
    exit;
}

$sql = "SELECT * FROM `attractions_data` WHERE `sid`=$sid";
$row = $db->query($sql)->fetch();


if (empty($row)) {
    header('Location:Attractions.php');
    exit;
}
?>
<?php include("include/__head.php"); ?>
<?php include("include/__navbar.php"); ?>
<!-- 導覽列 bootstrap的code -->
<div id="" style="display:flex;">
    <?php include("include/__sidebar.php"); ?>
    <!-- 側邊欄 -->

    <div class="container" style="margin-top:20px">



        <div class="row">

            <div class="col-lg-2"></div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="alert alert-primary" role="alert" id="info-bar" style="display:none">

                    </div>
                    <div class="card-body">

                        <h5 class="card-title">修改資料</h5>
                        <!-- 接收表單送出去的資料 action="Attractions_add_data_api.php" -->
                        <form onsubmit="return checkForm()" name="form1">
                            <input type="hidden" name="sid" value="<?=($row['sid'])?>">
                            <select class="form-control" style="margin-top:20px" name="master_id" value="<?=htmlentities($row['master_id'])?>">
                                <option>1</option>

                            </select>


                            <select class="form-control" style="margin-top:20px" name="classification_id" value="<?=htmlentities($row['classification_id'])?>">
                                <option>2</option>

                            </select>


                            <div class="form-group" style="margin-top:100px">
                                <label for="images">Example file input</label>
                                <input type="file" class="form-control-file" id="images" name="images" value="<?=htmlentities($row['images'])?>">
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name"></label>
                                    <!-- type設定檢查欄位 id設定跟資料表欄位一樣名子  需要加name才能送出資料-->
                                    <input type="text" class="form-control" id="name" name="name" placeholder="名稱" value="<?=htmlentities($row['name'])?>">
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="address"></label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="地址" value="<?=htmlentities($row['address'])?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Business-hours"></label>
                                <input type="text" class="form-control" id="Business-hours" name="Business-hours" placeholder="營業時間" value="<?=htmlentities($row['Business-hours'])?>">
                            </div>
                            <div class="form-group">
                                <label for="Close-shop"></label>
                                <input type="text" class="form-control" id="Close-shop" name="Close-shop" placeholder="公休日" value="<?=htmlentities($row['Close-shop'])?>">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="price"></label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="費用" value="<?=htmlentities($row['price'])?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="phone"></label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="電話" value="<?=htmlentities($row['phone'])?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="information"></label>
                                    <input type="text" class="form-control" id="information" name="information" placeholder="相關資訊" value="<?=htmlentities($row['information'])?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="x,y"></label>
                                <input type="text" class="form-control" id="x,y" name="x,y" placeholder="x,y座標" value="<?=htmlentities($row['x,y'])?>">
                            </div>

                            <div class="form-group">
                                <label for="Introduction"></label>
                                <input type="text" class="form-control" id="Introduction" name="Introduction" placeholder="景點介紹" value="<?=htmlentities($row['Introduction'])?>">
                            </div>

                            <div class="col-md-12">
                                <div class="text-right ">
                                    <button type="submit" class="btn btn-primary ">送出</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>



        <script>
            let info_bar = document.querySelector('#info-bar');
            // let name = document.querySelector('#name');


            function checkForm() {
                let fd = new FormData(document.form1);

           
                // 發送ajax
                fetch('Attractions_data_edit_api.php', {
                        // 發送方式
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
                             setTimeout(function(){
                                 location.href='Attractions.php';
                             }, 1000);
                        } else {
                            info_bar.className = 'alert alert-danger';
                        }
                    });
                return false;
            }
        </script>

    </div>





    <!-- 自己的html,css   code放這邊 -->


</div>
<?php include("include/__footer.php"); ?>