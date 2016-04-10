<?php
	require_once('_include/library/functions.php');
	require_once('_include/site_modules/Body.php');	
	require_once('_include/site_modules/Head.php');
	require_once('_include/site_modules/class_user.php');
	require_once('_include/site_modules/class_chats.php');
	
	echo '<li class="nav-header">Chat History</li>';
	$userid = san($_POST["uid"]);
	try {
		$dbh = initDb();
		$sql = 'SELECT convid FROM tbl_conv_usr WHERE status="1" AND uid="'.$userid.'"';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo '<li>
					<a class="ajax-link" href="?conv='.$res["convid"].'"><i class="glyphicon glyphicon-home"></i><span>'.$res["convid"].'</span></a>
				</li>';
		}
	} catch(PDOException $e) {}
	$dbh = null;
	

?>