<?php
	require_once('_include/library/functions.php');
	require_once('_include/site_modules/Body.php');	
	require_once('_include/site_modules/Head.php');
	require_once('_include/site_modules/class_user.php');
	require_once('_include/site_modules/class_chats.php');
	if(isset($_SESSION["conv"])) {
		$conv = san($_SESSION["conv"]);
		$conv = san($_SESSION["conv"]);
	} else {
		$conv = san($_POST["conv"]);
	}
	try {
		$dbh = initDb();
		$sql = 'SELECT * FROM chats WHERE convid="'.$conv.'"ORDER BY cid DESC';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
			try {
				$dbh2 = initDb();
				$sql2 = 'SELECT name FROM tbl_login WHERE uid="'.$res["cuid"].'"';
				$stmt2 = $dbh2->prepare($sql2);
				$stmt2->execute();
				while ($res2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
					echo '<!-- chat item -->
							<p class="message">
								<a href="#" class="name">
									<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
									'.$res2["name"].'
								</a>
								'.$res["ctext"].'
							</p>
						</div><!-- /.item -->';
				}
			} catch (PDOException $e2) {}
		}
	} catch(PDOException $e) {
		echo $e;
	}
	$dbh = null;

?>