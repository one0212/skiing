<?php
session_start();
// 因預設get方式獲取所以跑到表單的method才會執行以下判斷

$accounts = [
    'one' => '00',
    'one1' => '01',
    'one2' => '02',
    'one3' => '03',
    'one4' => '04',
];

if(isset($_POST['account'])){
// 判斷表單內account有沒有值

    if(isset($accounts[$_POST['account']])){
        // 密碼是否有值
        if($_POST['password']==$accounts[$_POST['account']]){
            // 密碼配對
            $_SESSION['user'] = $_POST['account'];
        }
    }


    // if($_POST['account']=='one' and $POST['password']=='1234')
    // // 找到帳號密碼相符合 
    //  {
    //     $_SESSION['user'] = $_POST['account'];
    //     // 將帳號設置給session
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
</head>
<body>
<?php if (isset($_SESSION['user'])): ?>
    <h2><?= $_SESSION['user']?> , 您好</h2>
    <p><a href="0816_07_logout.php">登出</a></p>

<?php else: ?>
<!-- 如果帳密不符合則繼續停留在表單上 -->
    <form action="" method="post"> 
    <!-- 傳表單給自己所以不用action -->
        <input type="text" name="account" placeholder="帳號"><br>
        <input type="password" name="password" placeholder="密碼"><br>
        <input type="submit">
    </form>
<?php endif; ?>
</body>
</html>