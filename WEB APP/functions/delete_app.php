<?php
	require("../includes/db_in.php");
	include("functions.php");
	if(!ADMIN){
		header( 'Location: ../' );
	}else{
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$id = stripslashes($id);
			$id = mysql_real_escape_string($id);
			if($id==""){
				header( 'Location: ../admin/?inputError' );
			}else{
				$query = mysql_query("DELETE FROM `applications` WHERE `id` = '{$id}'; ");
				header( 'Location: ../admin/?manageApps' );
			}
		}else{
			header( 'Location: ../admin/?inputError' );
		}
	}
	require("../includes/db_out.php");
?>