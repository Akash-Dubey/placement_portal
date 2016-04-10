<?php
	require_once '_include/library/functions.php';
	require_once '_include/site_modules/class_user.php';
	
	sec_session_start();
	if (isset($_POST["login_form"]) && adc_attack()) {
		$usr = new user();
		$user = san($_POST["username"]);
		$pwd = san($_POST["password"]);
		$usr -> setuid($user);
		$usr -> setpassword($pwd);
		
		if ($usr -> check_login()) {
			$usr -> update_login_record();
			if (isset($_SESSION["fail"])) unset($_SESSION["fail"]);
			echo 1;
			//jump('inner.php');
		} else {
			if (isset($_SESSION["fail"])) {
				$_SESSION["fail"][0] = time();
				$_SESSION["fail"][1] ++;
			} else {
				$_SESSION["fail"] = array();
				$_SESSION["fail"][0] = time();
				$_SESSION["fail"][1] = 1;
			}
			$_SESSION["shown"] = 0;
			echo 0;
			//jump($_SERVER["HTTP_REFERER"]);
		}
	} else {
		echo 007;
		//echo $user.' '.$pwd;
		//jump('index.php');
	}
	
	function check_login($user, $pwd) {
		//echo '1';
		if (! $user || ! $pwd) return false;
		$flag = false;
		//echo generate_hash('iiita123');
		try {
			$dbh = initDb();
			$sql = 'SELECT * FROM tbl_user WHERE uid = "'.$user.'"';
			//echo $sql;
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array());
			while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
				//var_dump($res);
				if (password_verify($pwd, $res["password"])) {
					$_SESSION["uid"] = $res["uid"];
					//echo "hey";
					$flag = true;
				}
			} 
		} catch (PDOException $e) {}
		
		$dbh = null;
		return $flag;
	}
	
	function update_login_record() {
		try {
			$dbh = initDb();
			$sql = 'UPDATE `tbl_user` SET `ip_addr`="'.get_client_ip().'", `uptime` = NOW() WHERE uid='.$_SESSION["uid"];
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
		} catch(PDOException $e) {}
		$dbh = null;
	}
?>