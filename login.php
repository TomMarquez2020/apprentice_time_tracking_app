<?php require_once('conn/connect.php')?>
<?php
	//login
	if (isset($_POST['loginform'])) {
		$user = mysqli_real_escape_string($con, $_POST['user']);
		$pass = mysqli_real_escape_string($con, $_POST['pass']);
 		$query="SELECT username, salt, password
				FROM passwordstbl
				JOIN personstbl ON personid = personfk
				WHERE username='".$user."'
				AND password='".$pass."'
				ORDER BY passwordid DESC
				LIMIT 1";
		
		$rs = mysqli_query($con, $query);
		$row = mysqli_fetch_assoc($rs);
		$_SESSION["user"] = $row['username']; 
		if($_SESSION["user"]) {
			header('loaction: year_calander.php');
		}
		mysqli_free_result($rs);
		mysqli_close($con);
	}
	
?>	
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>login</title>
	<link href="css/loginstyles.css" rel="stylesheet">
  </head>
  <body>
	<div id="login">
		<form name="loginform" id="loginform" method="post" action=""> 
			<label for="user">user</label>
			<input name="user" id="user" placeholder="username"type="text">
			<label for="pass">pass</label>
			<input name="pass" id="pass" placeholder="password" type="text">
			<label for="login">login</label>
			<input value="login" name="login" type="submit">
			
		</form>
		<a href="reset.php">reset password</a> 
		<a href="create.php">new user</a>
  </body>
</html>
