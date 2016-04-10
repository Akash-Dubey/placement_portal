<?php

	require_once '_include/library/functions.php';
	class user{
		private $uid, $name, $mail, $password;
		
		public function getuid() {
			return $this -> uid;
		}
		public function setuid($UserID) {
			$this->uid = $UserID;
		}
		
		public function getname() {
			return $this -> uname;
		}
		public function setname($UserName) {
			$this->uname = $UserName;
		}
		
		public function getmail() {
			return $this -> mail;
		}
		public function setmail($Mail) {
			$this->mail = $Mail;
		}
		
		public function getpassword() {
			return $this -> password;
		}
		public function setpassword($Pass) {
			$this->password = $Pass;
		}
		
		public function check_login() {
			$uid = $this -> uid;
			$pwd = $this -> password;
			if (! $uid|| ! $pwd) {
				return false;
			}
			$flag = false;
			try {
				$dbh = initDb();
				$sql = 'SELECT password FROM tbl_login WHERE uid="'.$uid.'"';
				$stmt = $dbh->prepare($sql);
				$stmt->execute();
				while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
					if (password_verify($pwd, $res["password"])) {
						$_SESSION["uid"] = $this -> uid;
						$flag = true;
					}
				} 
			} catch (PDOException $e) {
				echo $e;
			}
			$dbh = null;
			return $flag;
		}
		
		function update_login_record() {
			try {
				$dbh = initDb();
				$sql = 'UPDATE tbl_login SET online_bit= "1" WHERE uid="'.$this-> uid.'"';
				$stmt = $dbh->prepare($sql);
				$stmt->execute();
			} catch(PDOException $e) {}
			$dbh = null;
			try {
				$dbh = initDb();
				$sql = 'UPDATE tbl_login SET ip_addr="'.get_client_ip().'", uptime = NOW() WHERE user_id="'.$this-> uid.'"';
				$stmt = $dbh->prepare($sql);
				$stmt->execute();
			} catch(PDOException $e) {}
			$dbh = null;
		}
		
}

?>