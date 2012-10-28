<?php
	require('../includes/db_in.php');
	$query = mysql_query("SELECT * FROM `applications` ;");
	echo '<?xml version="1.0" encoding="ISO-8859-1"?>
		<apps>';
	for($i=1;$i<=mysql_num_rows($query);$i++){
		$row = mysql_fetch_array($query);
		echo'
			<app>
				<id>'.$row['id'].'</id>
				<name>'.$row['name'].'</name>
				<short-desc>'.$row['short_desc'].'</short-desc>
				<long-desc>'.$row['long_desc'].'</long-desc>
				<category>'.$row['category'].'</category>
				<keywords>'.$row['keywords'].'</keywords>
				<icon>'.$row['icon'].'</icon>
				<version>'.$row['version'].'</version>
				<link>'.$row['link'].'</link>
				<website>'.$row['website'].'</website>
			</app>
		';
	}
	echo '</apps>';
	echo mysql_error();
	require('../includes/db_out.php');
?>