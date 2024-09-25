<?php
  // $sname="localhost";
  // $uname="root";
  // $pass="";
  // $dbname="thakshak";
  // $conn=new mysqli($sname,$uname,$pass,$dbname);
 ?>
 <?php
// Database connection details
$hostname = "";
$username = "";
$password = ''; 
$database = ""; 

// Initialize MySQLi
$conn = mysqli_init();

// Connect to the MySQL server
if (!mysqli_real_connect($conn, $hostname, $username, $password, $database, 3306)) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
