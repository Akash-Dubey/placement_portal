<?php
	require_once('_include/library/functions.php');
	require_once('_include/site_modules/Body.php');	
	require_once('_include/site_modules/Head.php');
	require_once('_include/site_modules/class_user.php');
	require_once('_include/site_modules/class_chats.php');
	require_once('_include/site_modules/class_page.php');
	
	$pg = new Page();
	
	sec_session_start();
	if(!isset($_SESSION["uid"])) {
		jump('index.php');
	}

	$uid = $_SESSION["uid"];
	theme_decide('blue');
	show_head_main();
	show_head_chat();
	show_header_user();
	$pg -> show_body_left();
	show_body_default();
	$pg -> show_body_right();
	
	if (isset($_GET["conv"])) {
		$conv = san($_GET["conv"]);
		if ($conv == 'home') {
			$pg -> home();
		} else if ($conv == 'logout'){
			$pg -> logout();
		}else { 
			$pg -> load_conv($conv);
		}
	} else {
		$pg -> home();
	}
	
	
	/*echo'<html>
		<head>
			<script type="text/javascript" src="js/jquery.js"></script>
			<title>Chat Application Home</title>
			<script>
				$(document).ready(function(){
					$("#ChatText").keyup(function(e){
						if(e.keyCode == 13){
						var ChatText = $("#ChatText").val();
							$.ajax({
								type:"POST",
								url:"InsertMessage.php";
								data:{ChatText: ChatText},
								success:function(){
									$("#ChatText").val("");
								}
							});
						}
					});
					
					setInterval(function(){
						$("#ChatMessages").load("DisplayMessages.php");
					},1500);
					$("#ChatMessages").load("DisplayMessages.php");
				
				});
			</script>
		</head>
		<body>
			<!--h2>Welcome <span style="color:green"><?php echo $_SESSION["uname"];?></span></h2-->
			<br>
			
			<div>
				<div id="ChatMessages">
				
				</div>
				<textarea id="ChatText" name="ChatText"></textarea>
			
			</div>
			
		</body>
		</html>';
		
		
		*********************************
		'<head>
				<script type="text/javascript" src="js/jquery.js"></script>
				<title>Chat Application Home</title>
				<script>
					
					$(document).ready(function(){
						
						$("#chat").keyup(function(e){
							alert("Hai!!");
							if(e.keyCode == 13){
								
								var chat = $("#form-control").val();
								$.ajax({
									type:"POST",
									url:"InsertMessage.php";
									data:{chat: chat},
									success:function(){
										$("#form-control").val("");
									}
								});
							}
						});
						
						setInterval(function(){
							$("#message").load("DisplayMessages.php");
						},1500);
						$("#message").load("DisplayMessages.php");
					
					});
				</script>
			</head>';
		
		
		
		*/
?>