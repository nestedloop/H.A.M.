<?php
	require("../includes/db_in.php");
	include("functions.php");
	if(!ADMIN){
		header( 'Location: ../' );
	}else{
		if(isset($_POST['user'],$_POST['pass'])){
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			$user = stripslashes($user);
			$user = mysql_real_escape_string($user);
			$pass = stripslashes($pass);
			$pass = mysql_real_escape_string($pass);
			if (($user=="")||($pass=="")){
				header( 'Location: ../admin/?inputError' );
			}else{
				$query = mysql_query("SELECT `id` FROM `admins` WHERE `username` = '{$user}'; ");
				if (mysql_num_rows($query)) {
					header( 'Location: ../admin/?adminExists' ) ;
				}else{
					mysql_query("INSERT INTO `admins` (`username`, `password`) VALUES ('{$user}', '{$pass}');");
					header( 'Location: ../admin/?manageAdmins' );
				}
			}
		}else{
			header( 'Location: ../admin/?inputError' );
		}
	}
	require("../includes/db_out.php");
?>