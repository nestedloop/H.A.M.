<?php
	function getId(){
		$user = $_COOKIE['USERNAME'];
		$query = mysql_query("SELECT `id` FROM `users` WHERE `username` = '{$user}' ; ");
		$row = mysql_fetch_array($query);
		$id = $row['id'];
		return $id;
	}
	function is_logged() {
		$logged = FALSE;
		if ((isset($_COOKIE['USERNAME']))&&(isset($_COOKIE['PASSWORD']))) {
			$user = $_COOKIE['USERNAME'];
			$pass = $_COOKIE['PASSWORD'];
			$user = stripslashes($user);
			$user = mysql_real_escape_string($user);
			$pass = stripslashes($pass);
			$pass = mysql_real_escape_string($pass);
			$query = mysql_query("SELECT `id` FROM `users` WHERE `username` = '{$user}' AND `password` = '{$pass}' ");
			if (mysql_num_rows($query)) {
				$logged=TRUE;
			}
		}
		if ((isset($_COOKIE['ADMIN']))&&(isset($_COOKIE['PASSWORD']))) {
			$user = $_COOKIE['ADMIN'];
			$pass = $_COOKIE['PASSWORD'];
			$user = stripslashes($user);
			$user = mysql_real_escape_string($user);
			$pass = stripslashes($pass);
			$pass = mysql_real_escape_string($pass);
			$query = mysql_query("SELECT `id` FROM `admins` WHERE `username` = '{$user}' AND `password` = '{$pass}' ");
			if (mysql_num_rows($query)) {
				$logged=TRUE;
			}
		}
		return  $logged;
	}
	
	function is_admin() {
		$logged = FALSE;
		if ((isset($_COOKIE['ADMIN']))&&(isset($_COOKIE['PASSWORD']))) {
			$user = $_COOKIE['ADMIN'];
			$pass = $_COOKIE['PASSWORD'];
			$user = stripslashes($user);
			$user = mysql_real_escape_string($user);
			$pass = stripslashes($pass);
			$pass = mysql_real_escape_string($pass);
			$query = mysql_query("SELECT `id` FROM `admins` WHERE `username` = '{$user}' AND `password` = '{$pass}' ");
			if (mysql_num_rows($query)) {
				$logged=TRUE;
			}
		}
		return  $logged;
	}
	define('LOGGED' , is_logged()); 
	define('ADMIN' , is_admin()); 
?>