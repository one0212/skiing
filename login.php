<?php
include("config.php");
session_start();
// 因預設get方式獲取所以跑到表單的method才會執行以下判斷
if (isset($_COOKIE['logined'])) {
    // echo "已登入";
} elseif (isset($_POST['account']) && isset($_POST['password'])){
        // 判斷表單內是否有account欄位
    $account = $_POST['account'];
    $password = $_POST['password'];    
    // echo "$account $password";
    
    $sql = "SELECT bid FROM SKI_ADMIN WHERE account = '$account' AND password = '$password'";
    $result = mysqli_query($db,$sql);
    // 參數(資料庫連線對象, sql指令)
    $bid = mysqli_fetch_assoc($result)["bid"];
    // 從SKI_admin的table查詢符合條件(帳號and密碼)的筆數
    if ($bid != null) {
        setcookie('bid', $bid);
    } else {
        // echo "登入失敗";
    }
    // if($_POST['account']=='one' and $_POST['password']=='1234');
    // // 找到帳號密碼相符合 
    //  {
        
    // }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html {
           height:100%;
        }
        body {
            min-height:100vh;
        }
        header {
            height: 80px;
            background:#000;
        }
        .container {
            width:960px;
            margin:0 auto;
        }
        form {
            background:#ccc;
            width:300px;
            height:300px;
            margin:50px auto;
            padding:30px;
            
        }
        .b-block {
            display:block;
        }
        label {
            margin:10px 0;
            padding:20px 0;
        }
        input {
            /* text-align:center; */
            width:300px;
            height:30px;
            outline:none;
            background:none;
            margin:5px 0;
            border-width:0;
            border-bottom:1px solid #000;
        }
        .submit {
            /* margin-left:200px;
            width:100px; */
            border:1px solid #000;
            border-radius:5px;
            text-align:center;
        }
        footer {
            height: 50px;
            background:#000;
            position:fixed;
            bottom:0;
            left:0;
            width: 100%;
           
        }

  
    </style>
</head>
<body>
<?php if (isset($_SESSION['user'])): ?>
    <h2><?= $_SESSION['user']?> , 您好</h2>
    <p><a href="0816_07_logout.php">登出</a></p>

<?php else: ?>
<!-- <div class="wrapper"> -->
    <header></header>
        <div class="container">
        <!-- 如果帳密不符合則繼續停留在表單上 -->
            <form action="" method="post"> 
            <!-- 傳表單給自己所以不用action -->
                <label for="" class="b-block">帳號<input class="b-block" type="text" name="account" placeholder=" 請輸入帳號" ></label>
                <label for="" class="b-block">密碼<input class="b-block" type="password" name="password" placeholder=" 請輸入密碼"></label>
                <input class="submit" type="submit" value="登入">
            </form>
        </div>
    <footer></footer>
<!-- </div> -->
<?php endif; ?>

</body>
</html>