<?php
	require("../includes/db_in.php");
	include("functions.php");
	if(!LOGGED){
		header( 'Location: ../' );
	}else{
		if(isset($_POST['website'],$_POST['comp'],$_POST['name'],$_POST['short_desc'],$_POST['long_desc'],$_POST['keywords'],$_POST['category'],$_POST['pic'],$_POST['icon'],$_POST['version'],$_POST['link'])){
			$comp = $_POST['comp'];
			$name = $_POST['name'];
			$website = $_POST['website'];
			$short_desc = $_POST['short_desc'];
			$long_desc = $_POST['long_desc'];
			$keywords = $_POST['keywords'];
			$category = $_POST['category'];
			$pic = $_POST['pic'];
			$icon = $_POST['icon'];
			$version = $_POST['version'];
			$link = $_POST['link'];
			$comp = stripslashes($comp);
			$comp = mysql_real_escape_string($comp);
			$name = stripslashes($name);
			$name = mysql_real_escape_string($name);
			$website = stripslashes($website);
			$website = mysql_real_escape_string($website);
			$short_desc = stripslashes($short_desc);
			$short_desc = mysql_real_escape_string($short_desc);
			$long_desc = stripslashes($long_desc);
			$long_desc = mysql_real_escape_string($long_desc);
			$keywords = stripslashes($keywords);
			$keywords = mysql_real_escape_string($keywords);
			$category = stripslashes($category);
			$category = mysql_real_escape_string($category);
			$pic = stripslashes($pic);
			$pic = mysql_real_escape_string($pic);
			$icon = stripslashes($icon);
			$icon = mysql_real_escape_string($icon);
			$version = stripslashes($version);
			$version = mysql_real_escape_string($version);
			$link = stripslashes($link);
			$link = mysql_real_escape_string($link);
			if (($website=="")||($comp=="")||($name=="")||($short_desc=="")||($long_desc=="")||($keywords=="")||($category=="")||($pic=="")||($icon=="")||($version=="")||($link=="")){
				header( 'Location: ../user/?inputError' );
			}else{
				mysql_query("INSERT INTO `applications` (`website`, `company_id`, `name`, `short_desc`, `long_desc`, `keywords`, `category`, `pic`, `icon`, `version`, `link`) VALUES ('{$website}', '{$comp}', '{$name}', '{$short_desc}', '{$long_desc}', '{$keywords}', '{$category}', '{$pic}', '{$icon}', '{$version}', '{$link}');");
				header( 'Location: ../user/?manageApps' );
			}
		}else{
			header( 'Location: ../user/?inputError' );
		}
	}
	require("../includes/db_out.php");
?>