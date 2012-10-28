<?php
	require("../includes/db_in.php");
	include("functions.php");
	if(!LOGGED){
		header( 'Location: ../' );
	}else{
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$id = stripslashes($id);
			$id = mysql_real_escape_string($id);
			if($id==""){
				header( 'Location: ../user/?inputError' );
			}else{
				$query = mysql_query("DELETE FROM `applications` WHERE `id` = '{$id}'; ");
				header( 'Location: ../user/?manageApps' );
			}
		}else{
			header( 'Location: ../user/?inputError' );
		}
	}
	require("../includes/db_out.php");
?>