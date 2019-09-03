<?php require("config.php"); 
// 連線資料
session_start();


// 自己的php


?>

<?php include("include/__head.php"); ?>
<!-- HTML開頭＋link -->
<?php include("include/__navbar.php"); ?>
<!-- 導覽列 bootstrap的code -->

<div style="display:flex;">
<?php include("include/__sidebar.php"); ?>
<!-- 側邊欄 -->

<!-- 自己的html,css   code放這邊 -->
    <link rel="stylesheet" href="css/hotel_01.css">
    <div class="content">
            <!-- <ul class="form_head">
                <li><h2>Add Hotel</h2></li>
                <li><span>飯店名稱</span><input type="text" placeholder="請輸入飯店名稱..."></li>
                <li><span>營業時間</span><input type="text" placeholder="請輸入營業時間..."></li>
                <li><span>E-mail</span><input type="text" placeholder="請輸入E-mail..."></li>
                <li><span>電話</span><input type="text" placeholder="請輸入電話..."></li>
                <li><span>地址</span><input type="text" placeholder="請輸入地址..."></li>
                <li><span>簡介</span><textarea cols="50" rows="10" placeholder="簡介..."></textarea></li>
            </ul> 舊的方式-->
        <form action="" id="insert-form" name="form1" method="post" onsubmit="return checkFormAndPost(event, this)">
            <h1 class="content-title">Add Room</h1>
            <div class="form_head">
                <label for="room_name">房型名稱</label>
                <input type="text" class="form_head_control" id="room_name" name="room_name"  placeholder="請輸入房間名稱...">
                <small id="room_nameHelp" class="form-text"></small>
            </div>
            <div class="form_box_parallel">
            <div class="form_box form_box_room">
                <label for="room_type">房型</label>
                <input type="text" class="form_head_control" id="room_type" name="room_type" placeholder="請輸入房型...">
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
                    <input type="text" class="form_head_control" id="bed_information" name="beds_format" placeholder="請輸入規格...">
                    <small id="bed_informationHelp" class="form-text"></small>
                </div>
                <div class="form_box">
                    <label for="room_area">房間面積</label>
                    <input type="text" class="form_head_control" id="room_area" name="room_area" placeholder="請輸入房間面積..." required>平方
                    <small id="room_areaHelp" class="form-text"></small>
                </div>
                <div class="form_box">
                    <label for="person">可入住人數</label>
                    <input type="text" class="form_head_control" id="person" name="person" placeholder="請輸入人數..." required>人
                    <small id="personHelp" class="form-text"></small>
                </div>
            </div>
            <div class="form_head">
                <label for="room_introduction">房型敘述</label>
                <textarea 
                class="form_head_control" id="room_introduction" name="room_introduction" placeholder="簡介..."
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
        
            <button type="submit" class="form_btn" id="submit_btn">送出</button>
            <!-- </form> -->
            <!-- <div class="form_btn"> -->
                <!-- <ul>
                    <li><a href="#"><button>預覽</button></a></li>
                    <li><a href="#"><button>送出</button></a></li>  舊式醜醜按鈕
                    <li><a type="submit" href="#"><span>預覽</span></a></li>
                    <li><a type="submit" href="#"><span>送出</span></a></li>
                </ul> -->
                <!-- <button type="submit" class=" ">預覽</button>
                <button type="submit" class=" ">送出</button> -->
            <!-- </div> -->
        </form>
    </div>
</div>
<script>

function checkFormAndPost(e, form) {
    e.preventDefault();

    let formData = new FormData(form);

 
    fetch('__hotel_room_insert_api.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        console.log(response.json());
        return response.json();//拿裡面的內容轉換成json
    })
    .then(json => {
        if (true) {
            alert("新增成功!");
            // setTimeout(function(){
            //     location.href = '__hotel_room_data_list.php';
            // }, 1000);
            // parent.location.href="__hotel_room_data_list.php";
        } else {
            alert("新增失敗!");
        }
    });
    
    return false; // 表單不用傳統的 post 方式送出
}

</script>
<?php include("include/__footer.php"); ?>