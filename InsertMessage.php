<?php
	include "_include/site_modules/class_chats.php";
	include "_include/site_modules/class_user.php";
	
	
	sec_session_start();
	
	if(isset($_POST["txt"])) {
		$chaty = new chat();
		$chaty->setcuid($_POST["uid"]);
		$chaty->setconvid($_POST["conv"]);
		$chaty->setctext(($_POST["txt"]));
		$chaty->insertchat();
		echo 1;
	} else {
		echo 0;
		jump('inner.php');
	}
	
?>