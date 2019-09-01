<?php require("config.php"); 
// 連線資料
session_start();


$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if(empty($sid)) {
    header('Location: __coachlist.php');
    exit;
}
$sql = "SELECT * FROM `mgnt_coach` WHERE `sid`=$sid";
$row = $db->query($sql)->fetch();
if(empty($row)) {
    header('Location: __coachlist.php');
    exit;
}

// 自己的php


?>

<?php include("include/__head.php"); ?>
<!-- HTML開頭＋link -->
<?php include("include/__navbar.php"); ?>
<!-- 導覽列 bootstrap的code -->

<div id="wrapper" style="max-width:1024px;display:flex;">
<?php include("include/__sidebar.php"); ?>
<!-- 側邊欄 -->
<style>
    small.form-text {
        color: red;
    }
</style>
<!-- 自己的html,css   code放這邊 -->
<link rel="stylesheet" href="css/coachcss.css?115">
<div class="container">
<!-- <div style="margin-top: 2rem;"> -->
    <div class="row">
        <div class="col">
            <div class="alert alert-primary" role="alert" id="info-bar" style="display: none"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            
                
                    
                    <form name="formcoach" onsubmit="return checkForm()">
                        <input type="hidden" name="sid" value="<?= $row['sid'] ?>">
                        <div class="form-group">
                            <label for="name">教練姓名</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>">
                            <small id="nameHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="male">性別</label>
                            <input type="text" class="form-control" id="male" name="male" value="<?= htmlentities($row['male']) ?>">
                            <small id="maleHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="lan">使用語言</label>
                            <input type="text" class="form-control" id="lan" name="lan" value="<?= htmlentities($row['lan']) ?>">
                            <small id="lanHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="local"></label>當前雪場</label>
                            <input type="text" class="form-control" id="local" name="local" value="<?= htmlentities($row['local']) ?>">
                            <small id="localHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="License">證照</label>
                            <input type="text" class="form-control" id="License" name="License" value="<?= htmlentities($row['License']) ?>">
                            <small id="LicenseHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="skiage">年資</label>
                            <input type="text" class="form-control" id="skiage" name="skiage" value="<?= htmlentities($row['skiage']) ?>">
                            <small id="skiageHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="Experience">經歷</label>
                            <input type="text" class="form-control" id="Experience" name="Experience" value="<?= htmlentities($row['Experience']) ?>">
                            <small id="ExperienceHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="idea">理念</label>
                            <input type="text" class="form-control" id="idea" name="idea" value="<?= htmlentities($row['idea']) ?>">
                            <small id="ideaHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="skiclass">課程</label>
                            <input type="text" class="form-control" id="skiclass" name="skiclass" value="<?= htmlentities($row['skiclass']) ?>">
                            <small id="skiclassHelp" class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="price">價格</label>
                            <input type="text" class="form-control" id="price" name="price" value="<?= htmlentities($row['price']) ?>">
                            <small id="priceHelp" class="form-text"></small>
                        </div>
                        
                    


                        <button type="submit" class="btn btn-primary" id="submit_btn">修改</button>
                    </form>
                </div>
        <!-- </div> -->







</div>
    <script>
        let info_bar = document.querySelector('#info-bar');
        const submit_btn = document.querySelector('.coachsubmit');
        let name = document.querySelector('#name');
        let idea = document.querySelector('#idea');
        const required_fields = [
            {
                id: 'name',
                pattern: /^\S{2,}/,
                info: '請填寫正確的姓名'
            },
   
            // {
            //     id: 'class',
            //     pattern: /^\S{2,}/,
            //     info: '請填寫課程內容'
            // },
            // {
            //     id: 'price',
            //     pattern: /^\S{2,}/,
            //     info: '請填寫每堂價格'
            // },
        ];
        for(s in required_fields){
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
        }


        function checkForm(){
            
            let isPass = true;

            for(s in required_fields) {
                item = required_fields[s];

                if(! item.pattern.test(item.el.value)){
                    item.el.style.border = '1px solid red';
                    item.infoEl.innerHTML = item.info;
                    item.infoEl.style.color='red';
                    isPass = false;
                }
            }


            let fd = new FormData(document.formcoach);
           
            if(isPass) {
                fetch('__coach_edit_api.php', {
                    method: 'POST',
                    body: fd,
                })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);
                    //     // submit_btn.style.display = 'block';
                        // info_bar.style.display = 'block';
                        // info_bar.innerHTML = json.info;
                        if (json.success) {
                            alert('修改成功');
                            parent.location.href="__coachlist.php";
                        //    alert('修改成功');
                        //    document.location.href="__coachlist.php";
                        } else {
                            alert('沒有修改資料');
                        }
                    });
            } else {
                submit_btn.style.display = 'block';
            }
            return false; // 表單不出用傳統的 post 方式送出
        }




    </script>

</div>

</div>
<?php include("include/__footer.php"); ?>