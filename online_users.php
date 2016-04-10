<?php
	require_once('_include/library/functions.php');
	require_once('_include/site_modules/Body.php');	
	require_once('_include/site_modules/Head.php');
	require_once('_include/site_modules/class_user.php');
	require_once('_include/site_modules/class_chats.php');
	
	echo'<li class="nav-header">Online Friends</li>';
	try {
		$dbh = initDb();
		$sql = 'SELECT name FROM tbl_login WHERE online_bit="1"';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
			echo ' <li><a class="ajax-link" href="index.html"><i class="glyphicon glyphicon-home"></i><span>'.$res["name"].'</span></a>
				</li>';
		}
	} catch(PDOException $e) {}
	$dbh = null;
?>