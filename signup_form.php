<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
</head>
<body>
    
    <div class="body">
    <?php
        if (isset($_POST["submit"])) {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email=$_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["conformpassword"];
      
            $errors = array();
            
            if (empty($firstname) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
             array_push($errors,"All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             array_push($errors, "Email is not valid");
            }
            if (strlen($password)<8) {
             array_push($errors,"Password must be at least 8 charactes long");
            }
            if ($password!==$passwordRepeat) {
             array_push($errors,"Password does not match");
            }
            require_once "connections.php";
            $sql ="SELECT * FROM signup_persons WHERE email='$email'";
            $result =mysqli_query($conn,$sql);
            $rowCount =mysqli_num_rows($result);
            if ($rowCount>0){
             array_push($errors,"email already exist!");
            }
 
            if (count($errors)>0) {
             foreach ($errors as  $error) {
                 echo "<div class='alert alert-danger'>$error</div>";
             }
            }
            else{
 
                 $sql="INSERT INTO signup_persons(first_name,last_name,email,password) VALUES (?,?,?,?)";
                 $stmt=mysqli_stmt_init($conn);
                 $prepareStm=mysqli_stmt_prepare($stmt,$sql);
                 if ($prepareStm){
                     mysqli_stmt_bind_param($stmt,"ssss",$firstname,$lastname,$email,$password);
                     mysqli_stmt_execute($stmt);
                     echo "<div class='alert alert-success'>Registered successfully</div>";
                 }
                 else{
                     die("some thing went wrong");
                 }
            }
           } 
    
    ?>
        <form action="signup_form.php" method="post">
        <input type="text" name="firstname" placeholder="Enter your First Name"><br><br>
            <input type="text" name="lastname" placeholder="Enter your Last Name" ><br><br>
            <input type="email" name="email" placeholder="Enter your email" ><br><br>
            <input type="password" name="password" placeholder="Enter your Password"><br><br>
            <input type="password" name="conformpassword" placeholder="Confirm your Password"><br><br>
            <input type="submit" name="submit" value="submit"> 
        </form>
        
    </div>
</body>
</html>