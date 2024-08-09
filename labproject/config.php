<?php
    // $db =mysqli_connect("localhost","root","","attendacedata") or die('connectivity failed');

//echo phpinfo();
$servername = "localhost";
$username = "root";
$password = "";
$db="add_student";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";

?>