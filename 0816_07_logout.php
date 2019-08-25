<?php
session_start();
// session_destroy() 僅登出, 

unset($_SESSION['user']);
// unset會清掉整個session

unset($_SESSION['user']);
if(! empty($_SERVER['HTTP_REFERER'])){
    header('Location: '. $_SERVER['HTTP_REFERER']);
} else {

header('Location: login.php');
// location為拜訪完轉向哪個頁面顯示

}