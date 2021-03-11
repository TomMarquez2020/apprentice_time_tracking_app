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