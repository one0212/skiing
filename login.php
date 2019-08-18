<?php
include("config.php");
session_start();
// 因預設get方式獲取所以跑到表單的method才會執行以下判斷
if (isset($_COOKIE['logined'])) {
    echo "已登入";
} elseif (isset($_POST['account']) && isset($_POST['password'])){
        // 判斷表單內是否有account欄位
    $account = $_POST['account'];
    $password = $_POST['password'];    
    // echo "$account $password";
    
    $sql = "SELECT count(1) AS rownum FROM SKI_ADMIN WHERE account = '$account' AND password = '$password'";
    $result = mysqli_query($db,$sql);
    // 參數(資料庫連線對象, sql指令)
    $rowNum = mysqli_fetch_assoc($result)["rownum"];
    // 從SKI_admin的table查詢符合條件(帳號and密碼)的筆數
    if ($rowNum == 1) {
        setcookie('logined', 'true');
    } else {
        echo "登入失敗";
    }
    // if($_POST['account']=='one' and $_POST['password']=='1234');
    // // 找到帳號密碼相符合 
    //  {
        
    // }

}
?>
<?php
     $result = mysqli_query($db, "SELECT CURRENT_TIMESTAMP");
     echo mysqli_fetch_assoc($result)["CURRENT_TIMESTAMP"]
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php if (isset($_SESSION['user'])): ?>
    <h2><?= $_SESSION['user']?> , 您好</h2>
    <p><a href="0816_07_logout.php">登出</a></p>

<?php else: ?>
<!-- 如果帳密不符合則繼續停留在表單上 -->
    <form action="" method="post"> 
    <!-- 傳表單給自己所以不用action -->
        <input type="text" name="account" placeholder="請輸入帳號"><br>
        <input type="password" name="password" placeholder="請輸入密碼"><br>
        <input type="submit">
    </form>
<?php endif; ?>
</body>
</html>