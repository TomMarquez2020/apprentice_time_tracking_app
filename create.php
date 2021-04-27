<?php require_once('conn/connect.php')?>
<?php
	
	if (isset($_POST['newuserform'])) {
		$query = "SELECT personid FROM personstbl WHERE username = '$username' OR email = '$email'";
		$rs = mysqli_query($con, $query);
		
		if(mysqli_fetch_assoc($rs)) {
			echo "username/email must be unique";
		}
		else {
			$firstname = mysqli_real_escape_string($con, $_POST['fname']);
			$lastname = mysqli_real_escape_string($con, $_POST['lname']);
			$username = mysqli_real_escape_string($con, $_POST['username']);
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$occupation = mysqli_real_escape_string($con, $_POST['occupation']);
		
			$occupation = mysqli_real_escape_string($con, $_POST['occupation']);
		
			$password = mysqli_real_escape_string($con, $_POST['password']);
			$salt = time();
			$passworddigest = sha3($password.$salt);
	
			$query = "INSERT INTO personstbl (username, email) VALUES ('$firstname', '$lastname', '$username', '$email')";
			mysqli_query($con,$query);
		
			$query = "INSERT INTO passwordstbl (password, salt) VALUES ('$passworddigest', '$salt')";
			mysqli_query($con,$query);
		
			$query = "INSERT INTO personoccupationstbl (perspersoccfk, occpersfk) VALUES (SELECT personid FROM personstbl WHERE email = '$email', '$occupation')";
			mysqli_query($con,$query);
		}
	}
	$query = "SELECT occupationname, occupationid FROM occupationstbl";
	$rs = mysqli_query($con, $query);
	$count = mysqli_num_rows($rs);
	
	
	
?>	
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>create user</title>
	<link href="css/loginstyles.css" rel="stylesheet">
	
  </head>
  <body>
		<form name="newuserform" id="newuserform" method="post" action=""> 
		<label for="fname">first name</label>
		<input name="fname" id="fname" placeholder="first name" type="text">
		<label for="lname">last name</label>
		<input name="lname" id="lname" placeholder="last name" type="text">
		<label for="username">username</label>
		<input name="username" id="username" placeholder="username" type="text">
		<label for="password">password</label>
		<input name="password" id="password" placeholder="password" type="text">
		<label for="email">email</label>
		<input name="email" id="email" placeholder="email" type="email">
		<label for="occupation">occupation</label>
		<select name="occupation" id="occupation">
			<?php for($i = 0; $i < $count; $i++) { $row = mysqli_fetch_assoc($rs); ?>
			<option value="<?= $row['occupationid']; ?>"> <?= $row['occupationname'];?> </option>
			<?php } ?>
			<option value="0" selected >choose occuption:</option>
		</select>
		<label for="create">create account</label>
		<input value="create" name="createaccount" id="createaccount" type="submit">
		
	</form>
	<a href="login.php">Go back</a>

  </body>
</html>
<?php 
	mysqli_free_result($rs);
	mysqli_close($con);
?>