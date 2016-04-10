<?php
	
	function show_head_login() {
		echo'<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<script type="text/javascript" src="js/jquery.js"></script>';
	}
	
	function show_head_main() {
		echo '<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
			<link href="css/charisma-app.css" rel="stylesheet">
			<link href="bower_components/fullcalendar/dist/fullcalendar.css" rel="stylesheet">
			<link href="bower_components/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
			<link href="bower_components/chosen/chosen.min.css" rel="stylesheet">
			<link href="bower_components/colorbox/example3/colorbox.css" rel="stylesheet">
			<link href="bower_components/responsive-tables/responsive-tables.css" rel="stylesheet">
			<link href="bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css" rel="stylesheet">
			<link href="css/jquery.noty.css" rel="stylesheet">
			<link href="css/noty_theme_default.css" rel="stylesheet">
			<link href="css/elfinder.min.css" rel="stylesheet">
			<link href="css/elfinder.theme.css" rel="stylesheet">
			<link href="css/jquery.iphone.toggle.css" rel="stylesheet">
			<link href="css/uploadify.css" rel="stylesheet">
			<link href="css/animate.min.css" rel="stylesheet">

			<!-- jQuery -->
			<script src="bower_components/jquery/jquery.min.js"></script>

			<!-- The HTML5 shim, for IE6-8 support of HTML5 elements 
			<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->

			<!-- The fav icon -->
			<!--link rel="shortcut icon" href="img/favicon.ico"> -->';
	}
	
	function show_head_chat() {
		echo '<head>
				<script type="text/javascript" src="js/jquery.js"></script>
				<title>Chat Application Home</title>
				
			</head>';
	}

?>