<?php require("config.php"); 
session_start();

$page_name = '__hotel_room_date_list_edit';
$page_title = '編輯資料';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if(empty($sid)) {
    header('Location:__hotel_room_data_list.php');
    exit;
}

$sql = "SELECT * FROM `MGNT_SKI_HOTELROOM` WHERE `sid`=$sid";
$h_row = $db->query($sql)->fetch();
if(empty($h_row)) {
    header('Location:__hotel_room_data_list.php');
    exit;
}

?>
<?php include("include/__head.php"); ?>
<!-- HTML開頭＋link -->
<?php include("include/__navbar.php"); ?>
<!-- 導覽列 bootstrap的code -->

<style>
    small.form-text {
        color: red;
    }
</style>

<div style="display:flex;">
<?php include("include/__sidebar.php"); ?>
    <link rel="stylesheet" href="css/hotel_01.css">
    <div class="content">
        <form action="" id="insert-form" name="form1" method="post" onsubmit="return checkFormAndPost(event, this)">
            <h1 class="content-title">Add Room</h1>
            <div class="form_head">
                <label for="room_name">房型名稱</label>
                <input type="text" class="form_head_control" id="room_name" name="room_name" value="<?= htmlentities($h_row['room_name']) ?>" placeholder="請輸入房間名稱...">
                <small id="room_nameHelp" class="form-text"></small>
            </div>
            <div class="form_box_parallel">
            <div class="form_box form_box_room">
                <label for="room_type">房型</label>
                <input type="text" class="form_head_control" id="room_type" name="room_type" value="<?= htmlentities($h_row['room_type']) ?>" placeholder="請輸入房型...">
                <small id="room_typeHelp" class="form-text"></small>
            </div>
            <div class="form_box">
                <label for="smoke">是否禁菸</label>
                <input type="radio" class="form_head_control" id="smoke_y" name="smoke" value="1">是
                <input type="radio" class="form_head_control" id="smoke_n" name="smoke" value="0">否
            </div>
            <div class="form_box">    
                <label for="pet">寵物同行限制</label>
                <input type="radio" class="form_head_control" id="pet_y" name="pet" value="1">是
                <input type="radio" class="form_head_control" id="pet_n" name="pet" value="0">否
            </div>
            </div>
            <div class="form_other">
                <div class="form_box">
                    <label for="bed_information">床型資訊</label>
                    <select name="beds_number" id="">
                        <option value="1">1張</option>
                        <option value="2">2張</option>
                        <option value="3">3張</option>
                        <option value="4">4張</option>
                    </select>
                    <input type="text" class="form_head_control" id="bed_information" name="beds_format" value="<?= htmlentities($h_row['beds_format']) ?>" placeholder="請輸入規格...">
                    <small id="bed_informationHelp" class="form-text"></small>
                </div>
                <div class="form_box">
                    <label for="room_area">房間面積</label>
                    <input type="text" class="form_head_control" id="room_area" name="room_area" value="<?= htmlentities($h_row['room_area']) ?>" placeholder="請輸入房間面積..." required>平方
                    <small id="room_areaHelp" class="form-text"></small>
                </div>
                <div class="form_box">
                    <label for="person">可入住人數</label>
                    <input type="text" class="form_head_control" id="person" name="person" value="<?= htmlentities($h_row['person']) ?>" placeholder="請輸入人數..." required>人
                    <small id="personHelp" class="form-text"></small>
                </div>
            </div>
            <div class="form_head">
                <label for="room_introduction">房型敘述</label>
                <textarea 
                class="form_head_control" id="room_introduction" name="room_introduction" value="<?= htmlentities($h_row['room_introduction']) ?>" placeholder="簡介..."
                cols="0" rows="10">
                </textarea>
                <small id="room_introductionHelp" class="form-text"></small>
            </div>
            <div class="form_checkbox_inform">
                <h6>衛浴設備</h6>
                <div class="checkbox_area">
                    <span><input type="checkbox" name="hair_dryer" value="1"><label>吹風機</label></span>
                    <span><input type="checkbox" name="towel" value="1"><label>浴巾</label></span>
                    <span><input type="checkbox" name="robe" value="1"><label>浴袍</label></span>
                    <span><input type="checkbox" name="toiletries" value="1"><label>盥洗用品</label></span>
                    <span><input type="checkbox" name="mirror" value="1"><label>鏡子</label></span>
                </div>
            </div>
            <div class="form_checkbox_inform">
                <h6>娛樂</h6>
                <div class="checkbox_area">
                    <span><input type="checkbox" name="room_free_WiFi" value="1"><label>房內免費Wi-Fi</label></span>
                    <span><input type="checkbox" name="telephone" value="1"><label>電話</label></span>
                    <span><input type="checkbox" name="cable_television" value="1"><label>衛星頻道/有線電視</label></span>
                    <span><input type="checkbox" name="movie" value="1"><label>隨選電影系統</label></span>
                </div>
            </div>
            <div class="form_checkbox_inform">
                <h6>舒適設備</h6>
                <div class="checkbox_area">
                    <span><input type="checkbox" name="morning_cal" value="1"><label>Morning call服務</label></span>
                    <span><input type="checkbox" name="air_conditioning" value="1"><label>空調</label></span>
                    <span><input type="checkbox" name="slippers" value="1"><label>室內拖鞋</label></span>
                    <span><input type="checkbox" name="heating" value="1"><label>暖氣</label></span>
                    <span><input type="checkbox" name="indoor_fireplace" value="1"><label>室內壁爐</label></span>
                    <span><input type="checkbox" name="noise_barrier" value="1"><label>隔音設施</label></span>
                    <span><input type="checkbox" name="blackout_curtain" value="1"><label>遮光窗簾</label></span>
                    <span><input type="checkbox" name="electric_fans" value="1"><label>電風扇</label></span>
                    <span><input type="checkbox" name="alarm_clock" value="1"><label>鬧鐘</label></span>
                    <span><input type="checkbox" name="balcony" value="1"><label>陽台</label></span>
                </div>
            </div>
            <div class="form_checkbox_inform">
                <h6>餐飲服務</h6>
                <div class="checkbox_area">
                    <span><input type="checkbox" name="refrigerator" value="1"><label>冰箱</label></span>
                    <span><input type="checkbox" name="free_bottled_water" value="1"><label>免費瓶裝水</label></span>
                    <span><input type="checkbox" name="coffee_machine" value="1"><label>沖咖啡/泡茶設備</label></span>
            </div>
            <div class="form_checkbox_inform">
                <h6>格局與擺設</h6>
                <div class="checkbox_area">
                    <span><input type="checkbox" name="carpet" value="1"><label>地毯</label></span>
                    <span><input type="checkbox" name="desk" value="1"><label>書桌</label></span>
                    <span><input type="checkbox" name="workspace" value="1"><label>提供筆電友善設施</label></span>
                    <span><input type="checkbox" name="sofa" value="1"><label>沙發</label></span>
                    <span><input type="checkbox" name="kitchen" value="1"><label>廚房</label></span>
                </div>
            </div>
            <div class="form_checkbox_inform">
                <h6>衣物與洗衣設備</h6>
                <div class="checkbox_area">
                    <span><input type="checkbox" name="wardrobe" value="1"><label>衣櫥</label></span>
                    <span><input type="checkbox" name="open_wardrobe" value="1"><label>開放式衣櫥</label></span>
                    <span><input type="checkbox" name="Iron" value="1"><label>燙衣設備</label></span>
                    <span><input type="checkbox" name="dryer" value="1"><label>烘衣機</label></span>
                </div>
            </div>
            <div class="form_checkbox_inform">
                <h6>安全特色</h6>
                <div class="checkbox_area">
                    <span><input type="checkbox" name="safe" value="1"><label>房內保險箱</label></span>
                    <span><input type="checkbox" name="smoke_detector" value="1"><label>煙霧偵測器</label></span>
                </div>
            </div>
            <div class="form_checkbox_inform">
                <h6>其他</h6>
                <div class="checkbox_area">
                    <span><input type="checkbox" name="housekeeper" value="1"><label>客房清潔人員</label></span>
                </div>
            </div>

            <div class="form_head">
                <label for="accommodation_notice">住宿須知</label>
                <textarea 
                class="form_head_control" id="accommodation_notice" name="accommodation_notice" placeholder="住宿須知..."
                cols="0" rows="10">
                </textarea>
                <small id="noticeHelp" class="form-text"></small>
            </div>
        
            <button type="submit" class="form_btn">送出</button>
        </form>
    </div>
</div>


    <script>
        // let info_bar = document.querySelector('#info-bar');
        // const submit_btn = document.querySelector('#submit_btn');
        // let i, s, item;
        // const required_fields = [
        //     {
        //         id: 'name',
        //         pattern: /^\S{2,}/,
        //         info: '請填寫正確的姓名'
        //     },
        //     {
        //         id: 'email',
        //         pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
        //         info: '請填寫正確的 email 格式'
        //     },
        //     {
        //         id: 'mobile',
        //         pattern: /^09\d{2}\-?\d{3}\-?\d{3}$/,
        //         info: '請填寫正確的手機號碼格式'
        //     },
        // ];

        // // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        // for(s in required_fields){
        //     item = required_fields[s];
        //     item.el = document.querySelector('#' + item.id);
        //     item.infoEl = document.querySelector('#' + item.id + 'Help');
        // }

        // //   /[A-Z]{2}\d{8}/i  統一發票

        // function checkForm(){
        //     // 先讓所有欄位外觀回復到原本的狀態
        //     for(s in required_fields) {
        //         item = required_fields[s];
        //         item.el.style.border = '1px solid #CCCCCC';
        //         item.infoEl.innerHTML = '';
        //     }
        //     info_bar.style.display = 'none';
        //     info_bar.innerHTML = '';

        //     submit_btn.style.display = 'none';

        //     // 檢查必填欄位, 欄位值的格式
        //     let isPass = true;

        //     for(s in required_fields) {
        //         item = required_fields[s];

        //         if(! item.pattern.test(item.el.value)){
        //             item.el.style.border = '1px solid red';
        //             item.infoEl.innerHTML = item.info;
        //             isPass = false;
        //         }
        //     }

        
        checkFormAndPost(event, this){
            let fd = new FormData(document.form1);

            if(isPass) {
                fetch('__hotel_room_data_list_edit_api.php', {
                    method: 'POST',
                    body: fd,
                })
                    .then(response => {
                        return response.json();
                    })
                    .then(json => {
                        console.log(json);
                        // submit_btn.style.display = 'block';
                        // info_bar.style.display = 'block';
                        // info_bar.innerHTML = json.info;
                        if (json.success) {
                            info_bar.className = 'alert alert-success';
                        } else {
                            info_bar.className = 'alert alert-danger';
                        }
                    });
            } else {
                submit_btn.style.display = 'block';
            }
            return false; // 表單不出用傳統的 post 方式送出
        }




    </script>
</div>
<?php include("include/__footer.php"); ?>
