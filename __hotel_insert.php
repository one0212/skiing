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
            <li><h6>Add Hotel</h6></li>
            <li><span>飯店名稱</span><input type="text" placeholder="請輸入飯店名稱..."></li>
            <li><span>營業時間</span><input type="text" placeholder="請輸入營業時間..."></li>
            <li><span>E-mail</span><input type="text" placeholder="請輸入E-mail..."></li>
            <li><span>電話</span><input type="text" placeholder="請輸入電話..."></li>
            <li><span>地址</span><input type="text" placeholder="請輸入地址..."></li>
            <li><span>簡介</span><textarea cols="50" rows="10" placeholder="簡介..."></textarea></li>
        </ul> -->
        <h1 class="content-title">Add Hotel</h1>
        <form name="form1" onsubmit="return checkForm()" enctype="" action="" method="post">
                        <div class="form_head">
                            <label for="hotel_name">飯店名稱</label>
                            <input type="text" class="form_head_control" id="hotel_name" name="hotel_name" placeholder="請輸入飯店名稱...">
                            <small id="hotel_nameHelp" class="form-text"></small>
                        </div>
                        <div class="form_head">
                            <label for="business_hours">營業時間</label>
                            <input type="text" class="form_head_control" id="business_hours" name="business_hours" placeholder="請輸入營業時間...">
                            <small id="business_hoursHelp" class="form-text"></small>
                        </div>
                        <div class="form_head">
                            <label for="email">E-mail</label>
                            <input type="text" class="form_head_control" id="email" name="email" placeholder="請輸入E-mail...">
                            <small id="emailHelp" class="form-text"></small>
                        </div>
                        <div class="form_head">
                            <label for="phone">電話</label>
                            <input type="text" class="form_head_control" id="phone" name="phone" placeholder="請輸入電話...">
                            <small id="phoneHelp" class="form-text"></small>
                        </div>
                        <div class="form_head">
                            <label for="address">地址</label>
                            <input type="text" class="form_head_control" id="address" name="address" placeholder="請輸入電話...">
                            <small id="addressHelp" class="form-text"></small>
                        </div>
                        <div class="form_head">
                            <label for="introduction">簡介</label>
                            <textarea 
                            class="form_head_control" id="introduction" name="introduction" placeholder="簡介..."
                            cols="0" rows="10">
                            </textarea>
                            <small id="introductionHelp" class="form-text"></small>
                        </div>
        </form>


        <form action="" method="post"> 
                    <div class="form_checkbox_inform">
                        <h6>飯店</h6>
                        <div class="checkbox_area">
                            <span><input type="checkbox" name="checkbox[]" value="spa"><label>spa</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="按摩"><label>按摩</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="健身房"><label>健身房</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="游泳池"><label>游泳池</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="桑拿"><label>桑拿</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="溫泉"><label>溫泉</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="花園"><label>花園</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="熱水浴池"><label>熱水浴池 </label></span>
                            <span><input type="checkbox" name="checkbox[]" value="遊戲室"><label>遊戲室</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="蒸氣室"><label>蒸氣室</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="購物商場"><label>購物商場</label></span>
                        </div>
                    </div>
                    <div class="form_checkbox_inform">
                        <h6>可用語言</h6>
                        <div class="checkbox_area">
                            <span><input type="checkbox" name="checkbox[]" value="中文"><label>中文</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="英文"><label>英文</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="日文"><label>日文</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="韓文"><label>韓文</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="德文"><label>德文</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="法文"><label>法文</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="泰文"><label>泰文</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="葡萄牙語"><label>葡萄牙語</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="西班牙語"><label>西班牙語</label></span>
                        </div>
                    </div>
                    <div class="form_checkbox_inform">
                        <h6>餐飲</h6>
                        <div class="checkbox_area">
                            <span><input type="checkbox" name="checkbox[]" value="24小時送餐服務"><label>24小時送餐服務</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="咖啡店"><label>咖啡店</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="餐廳"><label>餐廳</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="池畔酒吧"><label>池畔酒吧</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="酒吧"><label>酒吧</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="自動販賣機"><label>自動販賣機</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="送餐服務"><label>送餐服務</label></span> 
                        </div>
                    </div>
                    <div class="form_checkbox_inform">
                        <h6>便利設施</h6>
                        <div class="checkbox_area">
                            <span><input type="checkbox" name="checkbox[]" value="可寄放行李"><label>可寄放行李</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="外幣兌換"><label>外幣兌換</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="提款機"><label>提款機</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="保險箱"><label>保險箱</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="禮賓服務"><label>禮賓服務</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="吸菸區"><label>吸菸區</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="送洗服務"><label>送洗服務</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="乾洗服務"><label>乾洗服務</label></span> 
                            <span><input type="checkbox" name="checkbox[]" value="每日房客清潔服務"><label>每日房客清潔服務</label></span>
                        </div>
                    </div>
                    <div class="form_checkbox_inform">
                        <h6>接待設施</h6>
                        <div class="checkbox_area">
                            <span><input type="checkbox" name="checkbox[]" value="24小時保全"><label>24小時保全</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="24小時櫃台服務"><label>24小時櫃台服務</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="無障礙友善設施"><label>無障礙友善設施</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="可帶寵物"><label>可帶寵物</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="會議空間"><label>會議空間</label></span>
                        </div>
                    </div>
                    <div class="form_checkbox_inform">
                        <h6>所有客房均提供</h6>
                        <div class="checkbox_area">
                            <span><input type="checkbox" name="checkbox[]" value="Mini Bar"><label>Mini Bar</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="免費瓶裝水"><label>免費瓶裝水</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="免費瓶裝水"><label>免費瓶裝水</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="Morning call服務"><label>Morning call服務</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="吹風機"><label>吹風機</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="禁菸房"><label>禁菸房</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="禁菸房"><label>禁菸房</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="沖咖啡/泡茶設備"><label>沖咖啡/泡茶設備</label></span> 
                            <span><input type="checkbox" name="checkbox[]" value="電話休憩區"><label>衛星頻道/有線電視</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="房內保險箱"><label>房內保險箱</label></span>
                            <span><input type="checkbox" name="checkbox[]" value="衛星頻道/有線電視"><label>電話休憩區</label></span>                        
                            <span><input type="checkbox" name="checkbox[]" value="冰箱"><label>冰箱</label></span>                        
                            <span><input type="checkbox" name="checkbox[]" value="空調"><label>空調</label></span>                        
                            <span><input type="checkbox" name="checkbox[]" value="遮光窗簾"><label>遮光窗簾</label></span>                        
                            <span><input type="checkbox" name="checkbox[]" value="地毯"><label>地毯</label></span>                        
                            <span><input type="checkbox" name="checkbox[]" value="書桌"><label>書桌</label></span>                        
                            <span><input type="checkbox" name="checkbox[]" value="鬧鐘"><label>鬧鐘</label></span>                        
                            <span><input type="checkbox" name="checkbox[]" value="衣櫥"><label>衣櫥</label></span>                        
                            <span><input type="checkbox" name="checkbox[]" value="浴缸"><label>浴缸</label></span>                        
                            <span><input type="checkbox" name="checkbox[]" value="盥洗用品"><label>盥洗用品</label></span>                        
                            <span><input type="checkbox" name="checkbox[]" value="烘衣機"><label>烘衣機</label></span>                        
                        </div>
                    </div>
            <button type="submit" class="form_btn"><a href="">送出</a></button>
        </form>
        <!-- <div class="form_btn">
            <ul>
                <li><a href="#"><button>預覽</button></a></li>
                <li><a href="#"><button>送出</button></a></li>  舊式醜醜按鈕
                <li><a href="#"><span>預覽</span></a></li>
                <li><a href="#"><span>送出</span></a></li>
            </ul>
        </div> -->
</div>

<?php include("include/__footer.php"); ?>