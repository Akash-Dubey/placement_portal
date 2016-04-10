<?php
	require_once '_include/library/functions.php';
	
	class chat {
		private $cid, $cuid, $ctext, $convid;
		
		public function getcid() {
			return $this->cid;
		}
		
		public function setcid($cid) {
			$this->cid = $cid;
		}
		
		public function getconvid() {
			return $this->convid;
		}
		
		public function setconvid($convid) {
			$this->convid = $convid;
		}
		public function getcuid() {
			return $this->cuid;
		}
		
		public function setcuid($cuid) {
			$this->cuid = $cuid;
		}
		
		public function getctext() {
			return $this->ctext;
		}
		
		public function setctext($ctext) {
			$this->ctext = $ctext;
		}
		
		public function insertchat() {
			$convid = $this -> convid;
			try {
				$dbh = initDb();
				$sql = 'INSERT INTO chats VALUES (\'\',?,?,'.$convid.')';
				$stmt = $dbh->prepare($sql);
				$stmt->execute(array($this -> cuid, $this -> ctext));
			} catch(PDOException $e) {}
			$dbh = null;
		}
		
		public function DisplayMessages() {
			$dbh = initDb();
			$sql='SELECT * FROM chats ORDER BY cid ';
			$stmt=$dbh->prepare($sql);
			$stmt->execute();
			
			while($ChatData = $stmt->fetch()) {
				$sql1='SELECT * FROM tbl_login WHERE uid=?';
				$stmt1=$dbh->prepare($sql1);
				$stmt1->execute(array($ChatData["cuid"]));
				$UserData = $stmt1->fetch();
				echo '<span>'.$UserData["name"].'</span><br>
					<span>'.$ChatData["ctext"].'</span><br>';
				}
		}
			
	}

?>