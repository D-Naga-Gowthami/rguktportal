
<?php 
$hostname='localhost';
$dbUser='root';
$dbPassword='';
$dbname='signup_details';
$conn=mysqli_connect($hostname,$dbUser,$dbPassword,$dbname);
if(!$conn)
{
    die("something went wrong");
}


?>