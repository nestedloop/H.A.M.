<?php
	require("includes/db_in.php");
	require("functions/functions.php");
	if(ADMIN){
		header( 'Location: ../admin/' );
	}else if(LOGGED){
		header( 'Location: ../user/' );
	}
?>
<html>
	<head>
		<title>H.A.M.</title>
		<link href="stylesheets/style.css" rel="stylesheet" />
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
			</div>
			<div id="content">
				<h1 class="text bold blueish">Login Page</h1>
				<form id="login" name="login" class="formbox" method="POST" action="functions/login.php" >
					<li><label for="user">Username: </label><input type="text" name="user" placeholder=" enter username" value="" /></li>
					<li><label for="pass">Password: </label><input type="password" name="pass" placeholder=" enter password" value="" /></li>
					<li><input class="f_submit" type="submit" value="Login" /></li>
				</form>
			</div>
			<div id="footer">
			</div>
		</div>
	</body>
</html>
<?php
	require("includes/db_out.php");
?>