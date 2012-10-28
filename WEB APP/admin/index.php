<?php
	include("../includes/db_in.php");
	require("../functions/functions.php");
	if(!ADMIN){
		header( 'Location: ../' );
	}
?>
<html>
	<head>
		<title>H.A.M. || Administration</title>
		<link href="../stylesheets/style.css" rel="stylesheet" />
		<script type="text/javascript" src="../javascripts/script.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
			</div>
			<div id="content">
				<ul class="menu">
					<li><a href="?addAdmin">Add Admin</a></li>
					<li><a href="?addUser">Add User</a></li>
					<li><a href="?manageAdmins">Manage Admins</a></li>
					<li><a href="?manageUsers">Manage Users</a></li>
					<li><a href="?manageApps">Manage Apps</a></li>
					<li><a href="../functions/logout.php">Logout</a></li>
				</ul>
				<?php
					if(isset($_GET['addAdmin'])){
						echo '
							<br/>
								<h1 class="text bold blueish">Add an Administrator</h1>
								<form id="add_admin" name="add_admin" class="formbox" method="POST" action="../functions/add_admin.php" >
								<li><span>Username: </span><input type="text" name="user" placeholder=" enter username" value="" /></li>
								<li><span>Password: </span><input type="text" name="pass" placeholder=" enter password" value="" /></li>
								<li><input class="f_submit" type="submit" value="Add Admin" /></li>
							</form>
						';
					}else if(isset($_GET['addUser'])){
						echo '
							<br/>
								<h1 class="text bold blueish">Add a User</h1>
								<form id="add_user" name="add_user" class="formbox" method="POST" action="../functions/add_user.php" >
								<li><span>Company Name: </span><input type="text" name="name" placeholder=" enter company name" value="" /></li>
								<li><span>Username: </span><input type="text" name="user" placeholder=" enter username" value="" /></li>
								<li><span>Password: </span><input type="text" name="pass" placeholder=" enter password" value="" /></li>
								<li><input class="f_submit" type="submit" value="Add User" /></li>
							</form>
						';
					}else if(isset($_GET['manageAdmins'])){
						$query = mysql_query("SELECT * FROM `admins` ;");
						echo '
								<h1 class="text bold blueish">Manage Administrators</h1>
								';
						echo '<ul class="admin_list">';
						for($i=1;$i<=mysql_num_rows($query);$i++){
							$row = mysql_fetch_array($query);
							echo'
								<li>
									<p><span>'.$row['username'].'</span><span class="del" onclick="delAdmin('.$row['id'].')">Delete</span></p>
								</li>
							';
						}
						echo '</ul>';
					}else if(isset($_GET['manageUsers'])){
						$query = mysql_query("SELECT * FROM `users` ;");
						echo '
								<h1 class="text bold blueish">Manage Users</h1>
								';
						echo '<ul class="admin_list">';
						for($i=1;$i<=mysql_num_rows($query);$i++){
							$row = mysql_fetch_array($query);
							echo'
								<li>
									<p><span>'.$row['username'].'</span><span class="del" onclick="delUser('.$row['id'].')">Delete</span></p>
								</li>
							';
						}
						echo '</ul>';
					}else if(isset($_GET['manageApps'])){
						$query = mysql_query("SELECT * FROM `applications` ;");
						echo '
								<h1 class="text bold blueish">Manage Applications</h1>
								';
						echo '<ul class="admin_list">';
						for($i=1;$i<=mysql_num_rows($query);$i++){
							$row = mysql_fetch_array($query);
							echo'
								<li>
									<p><span>'.$row['name'].'</span><span class="del" onclick="delApp('.$row['id'].')">Delete</span></p>
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