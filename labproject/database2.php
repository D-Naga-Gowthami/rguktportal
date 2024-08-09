<?php 
$hostname='localhost';
$dbUser='root';
$dbPassword='';
$dbname='donation';
$conn=mysqli_connect($hostname,$dbUser,$dbPassword,$dbname);
if(!$conn)
{
    die("something went wrong");
}

//<---!onsubmit="return Form_validation()--->
?>