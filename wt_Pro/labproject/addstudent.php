<form method="POST">
    <input type="text" name="student_name" placeholder="student_name" rerquired autofocus>
    <input type="submit" value="Add Student" name="submit">
</form>

<?php
  if(isset($_POST['submit']))
  {
    require_once("config.php");
    $student_name=$_POST['student_name'];
    $query="INSERT INTO added_students(student_name)  VALUES('$student_name')";
    $exceQuery=mysqli_query($conn,$query) or die(mysqli_error($conn));
    echo "student has been added succesfully";
  }
?>