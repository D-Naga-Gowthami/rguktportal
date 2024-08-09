<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="blood_donation_form.css">
    <style>
        *{
    text-align: center;
}
body{
    margin-top:10px;
}
div{
    border-radius: 20px;
    padding:30px;
    margin:0 auto;
    width:500px;
    height:100%;
    /* border:2px solid white; */
    /* background-color: #83c5e6; */
    background-color: rgba(0, 0, 0, 0);
}

body span{
    margin-top: 20px;
    bottom:30px;
    margin:20px;
    font-size:30px ;
    font-weight: bold;
    /* color: blue; */
}

form{
    padding:50px;
    
}

.box{
    width:400px;
    height:30px;
    font-weight: bold;
    /* border:2px solid black; */
}

.label{
    font-size: 25px;
    padding:20px;
    font-weight: bold;
}

#blood{
    margin:20px;
    width:150px;
    height:40px;
    /* border: 2px solid black; */
}

.button{
    /* border:2px solid black; */
    width:200px;
    height:40px;
    border-radius: 15px;
}

form #bb1{
    visibility: hidden;
}
form #bb2{
    visibility: hidden;
}
form #e1{
    visibility: hidden;
}

form #bb3{
    visibility:hidden;
}
    </style>
    <title>Document</title>
</head>
<body>
    <?php
        if (isset($_POST["submit"])) {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $phonenumber = $_POST["phonenumber"];
            $blood = $_POST["blood"];
            $errors = array();
            
            if (empty($firstname) OR empty($lastname) OR empty($email) OR empty($phonenumber) OR empty($blood)) {
             array_push($errors,"All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             array_push($errors, "Email is not valid");
            }
            // if (strlen($phonenumber)<10) {
            //  array_push($errors,"Phonenumber must be at least 10 charactes long");
            // }
            //if ($password!==$passwordRepeat) {
            // array_push($errors,"Password does not match");
            //}
            require_once "database1.php";
            $sql ="SELECT * FROM blood_donators WHERE email='$email'";
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
 
                 $sql="INSERT INTO blood_donators(first_name,last_name,email,phone_number,blood_group) VALUES (?,?,?,?,?)";
                 $stmt=mysqli_stmt_init($conn);
                 $prepareStm=mysqli_stmt_prepare($stmt,$sql);
                 if ($prepareStm){
                     mysqli_stmt_bind_param($stmt,"sssss",$firstname,$lastname,$email,$phonenumber,$blood);
                     mysqli_stmt_execute($stmt);
                     echo "<div class='alert alert-success'>Registered successfully</div>";
                 }
                 else{
                     die("some thing went wrong");
                 }
            }
           }
 
    ?>
    <div id="head">
        <center><span>Blood Donatation Form</span></center>
       <center> <form name="myForm" action="blood_donation_form.php" method="post">
           <input type="text" class="box" id="box1" onblur="myBlurFunction()" name="firstname" placeholder="Enter your First Name" required><label id="bb1">Invalid</label><br><br>
            <input type="text" class="box" id="box2" onblur="myBlurFunc2()" name="lastname" placeholder="Enter your Last Name" required="1"><label id="bb2">Invalid</label><br><br>
            <input type="email" class="box" id="box3" onblur="myemail()" name="email" placeholder="Enter your email address" required="1"><label id="e1">Invalid</label><br><br>
            <input type="text" class="box" id="box4" name="phonenumber" placeholder="Enter your Mobile Number" required><br><br>
            <label for="blood" class="label">Select your Blood Group:</label>
            
            <select name="blood" id="blood" required="1">
                <option value="A+" class="seelct-box">A+</option>
                <option value="A-" class="seelct-box">A-</option>
                <option value="B+" class="seelct-box">B+</option>
                <option value="B-" class="seelct-box">B-</option>
                <option value="AB+" class="seelct-box">AB+</option>
                <option value="AB-" class="seelct-box">AB-</option>
                <option value="O+" class="seelct-box">O+</option>
                <option value="O-" class="seelct-box">O-</option>
            </select><br>
            
            <input type="submit" class="button" value="register" name="submit">
        </form></center>
    </div>

    <script>
        function Form_validation(){
            let x1=document.getElementById('box1').value;
            let x2=document.getElementById('box2').value;
            let x3=document.getElementById('box3').value;
            if(x1=="" || x2=="" || x3==""){
                alert("These boxes must be fill before submit");
                return false;
            }
        }

        function myBlurFunction() {
            let x1=document.getElementById('box1');
            let reg1=(/^[A-Za-z]+$/);
            if(!reg1.test(x1.value)){
                document.getElementById("bb1").style.visibility="visible";
            }
            else{
                document.getElementById("bb1").style.visibility='hidden';
            }

        }

        function myBlurFunc2(){
            let x2=document.getElementById("box2");
            let reg2=(/^[A-Za-z]+$/);
            if(!reg2.test(x2.value)){
                document.getElementById("bb2").style.visibility='visible';
            }
            else{
                document.getElementById("bb2").style.visibility='hidden';
            }
        }

        function myemail(){
            let x3=document.getElementById("box3");
            let reg3=/^([a-zA-Z0-9 \- \.]+)[@]([a-z]+)[\.][a-z]{2,3}$/;
            if(!reg3.test(x3.value)){
                document.getElementById("e1").style.visibility='visible';
            }
            else{
                document.getElementById("e1").style.visibility='hidden';
            }
        }

        function myBlurFunction3() {
            let x4=document.getElementById("box4");
            let reg4=/^[0-9]{10}$/;
            if(!reg4.test(x4.value)){
                document.getElementById("bb3").style.visibility="visible";
            }
            else{
                document.getElementById("bb3").style.visibility='hidden';
            }

        } 
    
    </script>
</body>

</html>

