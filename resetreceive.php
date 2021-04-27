<?php require_once('conn/connect.php')?>
<?php
	if (isset($_POST['reset'])) {
		$pass = mysqli_real_escape_string($con, $_POST['passw']);
		
		$salt = time();
		$passworddigest = sha3($password.$salt);
		$query = "INSERT INTO passwordstbl (password, salt) VALUES ('$passworddigest', '$salt')";
		mysqli_query($con,$query);
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>reset user</title>
	<link href="css/loginstyles.css" rel="stylesheet">
  </head>
  <body>
	<form name="reset" id="reset" method="post" action=""> 
		<label for="passw">password</label>
		<input name="passw" id="passw" placeholder="new password" type="text">
		<label for="confirm">confirm</label>
		<input value="confirm" name="confirm" type="submit">
	</form>
   
  </body>
</html>