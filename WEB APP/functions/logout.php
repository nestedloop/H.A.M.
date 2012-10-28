<?php
	require("../includes/db_in.php");
	include("functions.php");
	if(LOGGED){
		setcookie('USERNAME', '', time(), '/');
		setcookie('ADMIN', '', time(), '/');
		setcookie('PASSWORD', '', time(), '/');
	}
	require("../includes/db_out.php");
	header( 'Location: ../' );
?>