<?php
	require_once('_include/library/functions.php');
	require_once('_include/site_modules/Body.php');	
	require_once('_include/site_modules/Head.php');
	require_once('_include/site_modules/class_user.php');
	require_once('_include/site_modules/class_chats.php');
	
	$uid1 = $_POST["uid1"];
	$uid2 = $_POST["uid2"];
	$m = hasher($uid1) + hasher($uid2);
	
	$conv_id = $m;
	
	if (check_exists($m)) {
		jump('inner.php?conv="'.$m.'"');
	}
	else {
		try {
			$dbh = initDb();
			$sql = 'INSERT INTO tbl_conv VALUES ('.$m.', "0")';
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
		} catch (PDOException $e){}
		$dbh = null;
		try {
			$dbh = initDb();
			$sql = 'INSERT INTO tbl_conv_usr VALUES ('.$m.',"'.$uid1.'","1")';
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
		} catch (PDOException $e){}
		$dbh = null;
		try {
			$dbh = initDb();
			$sql = 'INSERT INTO tbl_conv_usr VALUES ('.$m.',"'.$uid2.'","1")';
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
		} catch (PDOException $e){}
		$dbh = null;
		jump('inner.php?conv="'.$m.'"');
	}
	
	function check_exists($conv_id) {
		try {
			$dbh = initDb();
			$sql = 'SELECT COUNT(*) FROM tbl_conv WHERE convid = "'.$conv_id.'"';
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			$res = $stmt->fetch(PDO::FETCH_NUM);
		} catch (PDOException $e) {}
		$dbh = null;
		return $res[0];
	}
	
	function hasher($string){
		$ascii = NULL;
		for ($i = 0; $i < strlen($string); $i++) { 
			$ascii += ord($string[$i]); 
		}
		return($ascii);
	}
?>