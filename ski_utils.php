<?php 
	function redirectTo($php_file) {
		error_log("跳轉到頁面 - $php_file");
		header("Location: $php_file");
		exit();
	}
 ?>
