<?php
// db.php - Database Connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "student records";
 
$conn = mysqli_connect($host, $user, $pass, $dbname);
 
if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
}
?>


















