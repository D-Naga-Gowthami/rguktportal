<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script
         src="https://kit.fontawesome.com/64d58efce2.js"
         crossorigin="anonymous"
    ></script>
    <title>Document</title>
    <link rel="stylesheet" href="index1.css">
</head>
<body>
    <div class="container">
        <?php
        
        if(isset($_POST["submit"])){
            $firstname=$_POST["name"];
            $email=$_POST["email"];
            $password=$_POST["password"];
            require_once "connections1.php";
            $query = "select * from `signup_sis` where email='$email'";
            
            $result=mysqli_query($conn,$query);

            if($result){
                $row=mysqli_fetch_assoc($result);
                if($row['email']==$email){
                    if($row['password']==$password){
                        echo "<div class=alert>Login successfully</div>";
                        header('Location: homepage1.html');
                        exit(); // It's important to exit after the redirect
                    }
                    else{
                        echo "<div class='alert alert-success'>Password not matched</div>";
                    }
                }
                
            }  
            
        }

        if (isset($_POST["submit1"])) {
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
            require_once "connections1.php";
            $sql ="SELECT * FROM signup_sis WHERE email='$email'";
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
 
                 $sql="INSERT INTO signup_sis(first_name,last_name,email,password) VALUES (?,?,?,?)";
                 $stmt=mysqli_stmt_init($conn);
                 $prepareStm=mysqli_stmt_prepare($stmt,$sql);
                 if ($prepareStm){
                     mysqli_stmt_bind_param($stmt,"ssss",$firstname,$lastname,$email,$password);
                     mysqli_stmt_execute($stmt);
                     echo "<div class='alert alert-success'>Registered successfully</div>";
                     header('Location: homepage1.html');
                 }
                 else{
                     die("some thing went wrong");
                 }
            }
           } 
        ?>
        <div class="forms-container">
            <div class="signin-signup"> 
                <form method="post" class="sign-in-form">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="Username">
                    </div>
                    <div class="input-field">
                        <i class="fa fa-lock"></i>
                        <input type="email" name="email" placeholder="Enter Email">
                    </div>
                    <div class="input-field">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    <!-- <button class="btn solid"><a href="homepage1.html" class="loginbutton">Login</a></button> -->
                    <input type="submit" name="submit" value="Login" class="btn solid">
                    <p class="social-text">Or sign with social flatforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>


                <form method="post" class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="firstname" placeholder="Enter Firstname">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="lastname" placeholder="Enter Lastname">
                    </div>
                    <div class="input-field">
                        <i class="fa fa-envelope"></i>
                        <input type="text" name="email" placeholder="Email">
                    </div>
                    <div class="input-field">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" placeholder="password">
                    </div>
                    <div class="input-field">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="conformpassword" placeholder="Confirm password">
                    </div>
                    <input type="submit" value="Sign up" name="submit1" class="btn solid">
                    <p class="social-text">Or sign up with social flatforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New Here?</h3>
                    <p>
                        If you new to here sign up here 
                    </p>
                    <button class="btn transparent" id="sign-up-btn">Sign up</button>
                </div>
                <img src="images/blueteam.svg" alt="" class="image">
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us?</h3>
                    <p>
                        If you already signed up then signin
                    </p>
                    <input type="submit" name="submit1" value="Sign in" id="sign-in-btn" class="btn solid">
                </div>
                <img src="images/bluestrom.svg" alt="" class="image">
            </div>
        </div>
    </div>
    <script src="app.js"></script>
</body>
</html>