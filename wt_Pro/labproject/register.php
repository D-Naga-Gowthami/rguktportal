<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <?php
        if (isset($_POST["submit"])) {
           $fullName = $_POST["fullname"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["conform_password"];
     
           $errors = array();
           
           if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
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
           require_once "database.php";
           $sql ="SELECT * FROM users WHERE email='$email'";
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

                $sql="INSERT INTO users(full_name,email,password) VALUES (?,?,?)";
                $stmt=mysqli_stmt_init($conn);
                $prepareStm=mysqli_stmt_prepare($stmt,$sql);
                if ($prepareStm){
                    mysqli_stmt_bind_param($stmt,"sss",$fullName,$email,$password);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Registered successfully</div>";
                }
                else{
                    die("some thing went wrong");
                }
           }
          }

          
          
      ?>
        <form action="register.php" method="post">
            <div class="form-group">
                <input type="text" name="fullname" placeholder="Full Name">
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="email">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" name="conform_password" placeholder="Conform_Password">
            </div>
            <div class="form-group">
                <input type="submit" value="Register" name="submit">
            </div>
        </form>
        <div><p>Already Registered <a href="login.php">Login Here</a></p></div>
    </div>
</body> 
</html>