<?php 

session_start();

require_once 'db_connect.php';

// echo $_SESSION['userId'];

if(!$_SESSION['userId']) {
	header('location:'.$store_url);	
} 

if (!isset($_SESSION['temp_userId'])) {
    // User is not logged in, redirect to the login form
    header("Location: index.php");
    exit();
}


?>