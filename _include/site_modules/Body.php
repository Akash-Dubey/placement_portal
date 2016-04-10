<?php

	function show_header() {
		echo'<body class="index">
				<!-- Header -->
				<header id="header" class="alt">
					<h1 id="logo"><a href="index.php">PLUS <span>Your way to haven</span></a></h1>
					<nav id="nav">
						<ul>
							<li class="current"><a href="index.php">Welcome</a></li>
						</ul>
					</nav>
				</header>';
	}
	
	function theme_decide($color) {
		echo '<body class="skin-'.$color.'">';
	}
	
	function show_header_user() {
			echo '<div class="navbar navbar-default" role="navigation">
					<div class="navbar-inner">
						<button type="button" class="navbar-toggle pull-left animated flip">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.html"> <img src="img/logo1.png" class="hidden-xs">
							<span style= "color: black">PLUS</span> </a>
					</div>
				</div>';
	}
	
	function show_body_user() {
		echo '<h2>Welcome <span style="color:green">'.$_SESSION["uid"].'</span>
			</h2>
				<br>
				
			<div>
				<div id="ChatMessages" style="height:500px;width:400px;">
				
				</div>
				<textarea id="ChatText" name="ChatText"></textarea>
			
			</div>
			<script type="text/javascript">
					$(document).ready(function(){
						$("#ChatText").keyup(function(e){
							if(e.keyCode == 13){
								var ChatText = $("#ChatText").val();
								//alert(ChatText);
								//$("#ChatText").val(" ");
								$.ajax({
									url: "InsertMessage.php",
									type: "post",
									data: {ChatText:ChatText},
									success: function(){
										$("#ChatText").val(" ");
									},
								});
							}
						});
						setInterval(function(){
							$("#ChatMessages").load("DisplayMessages.php");
						},1500);
						$("#ChatMessages").load("DisplayMessages.php");
					});
				</script>
			</body>';
	}
		
	function show_login_window() {
		//echo generate_hash('iiita123');
		echo '<section id="banner">
			
				<!--
					".inner" is set up as an inline-block so it automatically expands
					in both directions to fit whatevers inside it. This means it wont
					automatically wrap lines, so be sure to use line breaks where
					appropriate (<br />).
				-->
				<div class="inner">
					
					<header>
						<h2>PLUS</h2>
					</header>
					<p>
					<input type="text" name="username" id = "username" size="20" tabindex="1">
					<br />
					<input type="password" name="password" id = "password" size="20" tabindex="2"></input>
					<input type="hidden" name="login_form" id = "login_form" value="1"/></input>
					<footer>
						<ul class="buttons vertical">
							<li><input class="button" name="submit" id="submit" value="Login" type="submit" tabindex="3"></input></li>
						</ul>
					</footer>
				</div>
			</section>
			<script type="text/javascript">
				$(document).ready(function(){
						$("#submit").click(function(){
							var username = $("#username").val();
							var password = $("#password").val();
							var login_form = $("#login_form").val();
							$.ajax({
								url: "loginproc.php",
								type: "post",
								data: {username:username,password:password,login_form:login_form},
								success: function(data){
									if (data == 1) 
										window.location.href="inner.php";
									else 
										alert("Login Error");
									
								},
							});
						});
				});
			</script>';
	}

	function show_body_default() {
		echo '<div class="ch-container">
			<div class="row">
				
				
				<div id="content" class="col-lg-10 col-sm-10">
				<!-- content starts -->
				<div>
					<ul class="breadcrumb">
					
						<li>
							<a href="?conv=home"><button class="pull-right btn btn-default" id="submit" >Home <i class="fa fa-arrow-circle-right"></i></button>
						</a></li>
						<li>
							<a href="?conv=logout"><button class="pull-right btn btn-default" id="submit">Logout <i class="fa fa-arrow-circle-right"></i></button>
						</a></li>
						<li>
						Welcome '.$_SESSION["uid"].'
						</li>
					</ul>
				</div>
				<div class=" row">
					<div class="col-md-3 col-sm-3 col-xs-6">
						</a>
					</div>
				</div>';
	}
	
?>