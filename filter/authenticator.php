<?php 
require_once("ski_utils.php");
session_start(); 
if (empty($_SESSION['bid'])) {
    redirectTo('login.php');
}
?>