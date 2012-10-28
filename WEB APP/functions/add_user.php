<?php
	require("../includes/db_in.php");
	include("functions.php");
	if(!ADMIN){
		header( 'Location: ../' );
	}else{
		if(isset($_POST['user'],$_POST['pass'],$_POST['name'])){
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			$name = $_POST['name'];
			$user = stripslashes($user);
			$user = mysql_real_escape_string($user);
			$pass = stripslashes($pass);
			$pass = mysql_real_escape_string($pass);
			$name = stripslashes($name);
			$name = mysql_real_escape_string($name);
			if (($user=="")||($pass=="")||($name=="")){
				header( 'Location: ../admin/?inputError' );
			}else{
				$query = mysql_query("SELECT `id` FROM `users` WHERE `username` = '{$user}'; ");
				if (mysql_num_rows($query)) {
					header( 'Location: ../admin/?userExists' ) ;
				}else{
					mysql_query("INSERT INTO `users` (`username`, `password`, `company`) VALUES ('{$user}', '{$pass}', '{$name}');");
					header( 'Location: ../admin/?manageUsers' );
				}
			}
		}else{
			header( 'Location: ../admin/?inputError' );
		}
	}
	require("../includes/db_out.php");
?>