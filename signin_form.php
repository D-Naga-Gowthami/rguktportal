
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>
</head>
<body>
    <div>
        <?php
        
        if(isset($_POST["submit"])){
            $firstname=$_POST["name"];
            $email=$_POST["email"];
            $password=$_POST["password"];
            require_once "connections.php";
            $query = "select * from `signup_persons` where email='$email'";
            
            $result=mysqli_query($conn,$query);

            if($result){
                $row=mysqli_fetch_assoc($result);
                if($row['email']==$email){
                    if($row['password']==$password){
                        echo "<div class='alert alert-success'>Login successfully</div>";
                        header('Location: blood_type.php');
                        exit(); // It's important to exit after the redirect
                    }
                    else{
                        echo "<div class='alert alert-success'>Password not matched</div>";
                    }
                }
                
            }
            
        }
        ?>
        <form method="post">
            <div><input type="text" name="name" placeholder="Enter your Firstname"></div><br>
            <div><input type="email" name="email" placeholder="Enter your Email Address"></div><br>
            <div><input type="password" name="password" placeholder="Enter your password"></div><br>
            <div><input type="submit" name="submit" value="submit"></div>
        </form>
    </div>
</body>
</html>