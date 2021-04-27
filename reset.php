<?php require_once('conn/connect.php')?>
<?php
	if (isset($_POST['confirmemail'])) {
		$email =  mysqli_real_escape_string($con, $_POST['email']);
		
		$query = "SELECT email FROM personstbl WHERE email = '$email'";
		$rs = mysqli_query($con, $query);
		$row = mysqli_fetch_assoc($rs);
		
		$_SESSION('code') = $rand(1000, 9999);
		
	if (isset($_POST['code'])) {
		counter = 0;
		if($_SESSION('code') == $_POST['cod'])) {
			header('loaction: resetrecieve.php');
		} else {
			echo 'code is incorrect';
			counter++;
		}
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <link href="css/loginstyles.css" rel="stylesheet">
  </head>
  <body>
	<p><?php if (!$row) {echo "corrosponding email not found*"} else {mail($row['$email', "reset password for apprenticeship tracker",'$code'])} ?></p>
	<form name="confirmemail" id="confirmemail" method="post" action=""> 
		<label for="email">email</label>
		<input name="email" id="email" placeholder="email linked to account" type="text">
		<label for="send">send email</label>
		<input value="send email" name="send" type="submit">
	</form>
	<form name="code" id="code" method="post" action="">
		<label for="cod">code</label>
		<input type="text" name="cod" id="cod" placeholder="code">
		<input value="submit code" name="subcode" type="submit">
	</form>
   
  </body>
</html>
<?php 
	mysqli_free_result($rs);
	mysqli_close($con);
?>