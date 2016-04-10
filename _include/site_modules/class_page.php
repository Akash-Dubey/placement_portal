<?php
	require_once('_include/library/functions.php');
	require_once('_include/site_modules/Body.php');	
	require_once('_include/site_modules/Head.php');
	require_once('_include/site_modules/class_user.php');
	require_once('_include/site_modules/class_chats.php');
	
	class Page {
	
		function show_body_right() {
			echo '<div class="cal-sm-2 cal-lg-2">
					<div class="sidebar-nav">
						<div class="nav-canvas">
							<div class="nav-sm nav nav-stacked">

							</div>
							<ul class="nav nav-pills nav-stacked main-menu"  id="sexy">
								
							</ul>
						</div>
					</div>
				</div>
				<script type="text/javascript" source="js/jquery.js"></script>
				<script type="text/javascript">
					$(document).ready(function(){
						setInterval(function(){
								$("#sexy").load("online_users.php");
						},1500);
						$("#sexy").load("online_users.php");
					});
				</script>';
		}
		
		function show_body_left() {
			echo '<div class="ch-container">
					<div class="row">
						<!-- left menu starts -->
						<div class="col-sm-2 col-lg-2">
							<div class="sidebar-nav">
								<div class="nav-canvas">
								<input id="fucked" style="display:none" value="'.$_SESSION["uid"].'"></input>
									<div class="nav-sm nav nav-stacked">

									</div>
									<ul class="nav nav-pills nav-stacked main-menu" id="sexiness">
										
									</ul>
								</div>
							</div>
						</div>
						<script type="text/javascript" source="js/jquery.js"></script>
						<script type="text/javascript">
							$(document).ready(function(){
								setInterval(function(){
										var uid = $("#fucked").val();
										$.ajax({
											url: "chat_history.php",
											type: "post",
											data: {uid:uid},
											success: function(data){
												$("#sexiness").html(data);
											},
										});
								},1500);
							});
						</script>';
		}
		
		function home() {
			echo '<!-- START CONVERSATION widget -->
					<div class="box box-info">
										<div class="box-header">
											<i class="fa fa-envelope"></i>  
										</div>
										<div class="box-body">
											<form action="start_conversation.php" method="post">
												<div class="form-group">
													<input type="text" id ="uid2" class="form-control" name="uid2" placeholder="Enter Username of Friend"/>
													<input type="hidden" id ="uid1" class="form-control" name="uid1" placeholder="START CONVERSATION with:"/value="'.$_SESSION["uid"].'">
													<div class="box-footer clearfix">
										<button class="pull-right btn btn-default" id="submit">Start <i class="fa fa-arrow-circle-right"></i></button>
												</div></div>
											</form>
										</div>
										
										</div>
					</div>		
					<!-- START CONVERSATION ENDS -->
				</div>
			</div>
			<script type="text/javascript" source="js/jquery.js"></script>
			<script type="text/javascript">
					$(document).ready(function(){
						alert("d");
						$("#name").keyup(function(e){
							if(e.keyCode == 13){
								var uid1 = $(#fucked).val();
								var uid2 = $("#name").val();
								
								$.ajax({
									url: "start_conversation.php",
									type: "post",
									data: {uid1:uid1,uid2:uid2},
									success: function(data){
										alert(data);
									},
								});
							}
						});
					});';
			}				
		
		function load_conv($conv) {
			echo '<div class="box box-success">
					<div class="box-header">
						<i class="fa fa-comments-o"></i>
						<h3 class="box-title"></h3>
						<div class="box-tools pull-right" data-toggle="tooltip" title="Status">
							
						</div>
					</div>
					<div class="input-group">
							<input type="hidden" id ="puke" value="'.$conv.'"></input>
							<input type="hidden" id ="uid" value="'.$_SESSION["uid"].'"></input>
							<input class="form-control" id="msg" placeholder="Type message..."/>
						</div>
					<div class="box-body chat" id="chat-box" style="overflow:scroll;max-height:50%">
					<div class="item" id="crictical">';
			
			echo'	</div>		
					
					</div>
					
				<div class="box-footer">
				
						</div>					
				<script type="text/javascript" source="js/jquery.js"></script>
				<script type="text/javascript">
					$(document).ready(function(){
						setInterval(function(){
								var conv = $("#puke").val();
								$.ajax({
									url: "load_messages.php",
									type: "post",
									data: {conv:conv},
									success: function(data){
										$("#chat-box").html(data);
									},
								});
						},1500);
						$("#msg").keyup(function(e){
							if(e.keyCode == 13){
								var txt = $("#msg").val();
								var conv = $("#puke").val();
								var uid = $("#uid").val();
								$.ajax({
									url: "InsertMessage.php",
									type: "post",
									data: {txt:txt,uid:uid,conv:conv},
									success: function(data){
										$("#msg").val(" ");
									},
								});
							}
						});
					});
				</script>';
		}
		
		function logout() {
			try {
				$dbh = initDb();
				$sql = 'UPDATE tbl_login SET online_bit="0" WHERE uid="'.$_SESSION["uid"].'"';
				$stmt = $dbh->prepare($sql);
				echo $sql;
				$stmt->execute();
			} catch(PDOException $e) {}
			$dbh = null;
			echo '<script type="text/javascript">
				window.location.href="index.php";
				</script>';
		}
	}
?>