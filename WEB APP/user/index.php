<?php
	include("../includes/db_in.php");
	require("../functions/functions.php");
	if(!LOGGED){
		header( 'Location: ../' );
	}
?>
<html>
	<head>
		<title>H.A.M. || User Panel</title>
		<link href="../stylesheets/style.css" rel="stylesheet" />
		<script type="text/javascript" src="../javascripts/script.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
			</div>
			<div id="content">
				<ul class="menu">
					<li><a href="?addApp">Add Application</a></li>
					<li><a href="?manageApps">Manage Applications</a></li>
					<li><a href="../functions/logout.php">Logout</a></li>
				</ul>
				<?php
					$my_id = getId();
					if(isset($_GET['addApp'])){
						echo '
							<br/>
								<h1 class="text bold blueish">Add an Application</h1>
								<form id="add_app" name="add_app" class="formbox" method="POST" action="../functions/add_app.php" >
								<li><span>Application Name: </span><input type="text" name="name" placeholder=" enter application name" value="" /></li>
								<li><span>Short Description: </span><input type="text" name="short_desc" placeholder=" enter a short description" value="" /></li>
								<li><span>Description: </span><textarea name="long_desc" placeholder=" enter description"></textarea></li>
								<li><span>Keywords: </span><input type="text" name="keywords" placeholder=" enter keywords" value="" /></li>
								<li><span>Category: </span><input type="text" name="category" placeholder=" enter category" value="" /></li>
								<li><span>Picture Link: </span><input type="text" name="pic" placeholder=" enter pic link" value="" /></li>
								<li><span>Icon Link: </span><input type="text" name="icon" placeholder=" enter icon link" value="" /></li>
								<li><span>Version: </span><input type="text" name="version" placeholder=" enter version" value="" /></li>
								<li><span>Website: </span><input type="text" name="website" placeholder=" enter link" value="" /></li>
								<li><span>Download Link: </span><input type="text" name="link" placeholder=" enter link" value="" /></li>
								<input type="hidden" value="'.$my_id.'" name="comp" />
								<li><input class="f_submit" type="submit" value="Add Application" /></li>
							</form>
						';
					}else if(isset($_GET['manageApps'])){
						$my_id = getId();
						$query = mysql_query("SELECT * FROM `applications` WHERE `company_id` = '{$my_id}' ;");
						echo'
								<h1 class="text bold blueish">Manage Applications</h1>
								';
						echo '<ul class="admin_list">';
						for($i=1;$i<=mysql_num_rows($query);$i++){
							$row = mysql_fetch_array($query);
							echo'
								<li>
									<p><span>'.$row['name'].'</span><span class="del" onclick="delAppUsr('.$row['id'].')">Delete</span></p>
								</li>
							';
						}
						echo '</ul>';
						
					}
				?>
			</div>
			<div id="footer">
			</div>
		</div>
	</body>
</html>
<?php
	include("../includes/db_out.php");
?>