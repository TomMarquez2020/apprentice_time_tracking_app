<!-- connect.php 
Use this to connect to database
The following code will need to be used on any script that needs the connection string:
    require_once('conn/connect.php'); -->

    <?php 					        
    $host = "localhost";
    $data = "apprenticehoursdb";
    $user = "root";        //change this to your MySQL username
    $pass = "password";        //change this to your MySQL password
    
    $con = new mysqli($host, $user, $pass, $data);
    if (!$con) {
        header ("location: nologin.html");
    }
?>