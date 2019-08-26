<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/reset.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="vendor.css">
    
    <title>Document</title>
</head>
<body>
    <div id="wrapper" style="max-width:1024px;display:flex;">
    <?php
    include("include/__sidebar.php");
    ?>
        <div class="form">
            <form action="">
                <label for="">公司名稱</label><input type="text">
                <label for="">統一編號／公司行號</label><input type="text">
                <label for="">負責人</label><input type="text">
                <label for="">公司地址</label><input type="text">
                <label for="">公司網站</label><input type="text">
                <label for="">聯絡人<input class="checkbox" type="checkbox">同負責人</label><input type="text">
                <label for="">聯絡人電話</label><input type="text">
                <label for="">聯絡人e-mail</label><input type="text">
                <label for="">備註</label><input type="text">
            </form>
        </div>
        <!-- <input  type="button" value=""> -->
        <button class="submit">編輯完成</button>
    </div>
</body>
</html>