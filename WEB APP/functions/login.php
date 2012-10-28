<?php
	require("../includes/db_in.php");
	require("functions.php");
	if(ADMIN){
		header( 'Location: ../admin/' );
	}else if(LOGGED){
		header( 'Location: ../user/' );
	}else{
		if(isset($_POST['user'],$_POST['pass'])){
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			$user = stripslashes($user);
			$user = mysql_real_escape_string($user);
			$pass = stripslashes($pass);
			$pass = mysql_real_escape_string($pass);
			if (($user=="")||($pass=="")){
				header( 'Location: ../?loginError' );
			}else{
				$query = mysql_query("SELECT `id` FROM `users` WHERE `username` = '{$user}' AND `password` = '{$pass}' ");
				if (mysql_num_rows($query)) {
					$row = mysql_fetch_array($query);
					setcookie('USERNAME', $user, time()+(60*60*24*30), '/');
					setcookie('PASSWORD', $pass, time()+(60*60*24*30), '/');
					header( 'Location: ../user/?manageApps' ) ;
				}else{
					$query = mysql_query("SELECT `id` FROM `admins` WHERE `username` = '{$user}' AND `password` = '{$pass}' ");
					if (mysql_num_rows($query)) {
						$row = mysql_fetch_array($query);
						setcookie('ADMIN', $user, time()+(60*60*24*30), '/');
						setcookie('PASSWORD', $pass, time()+(60*60*24*30), '/');
						header( 'Location: ../admin/?manageApps' ) ;
					}else{
						header( 'Location: ../?loginError' );
					}
				}
			}
		}else{
			header( 'Location: ../' );
		}
	}
	require("../includes/db_out.php");
?>