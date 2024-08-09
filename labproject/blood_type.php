<?php
  include 'database1.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <style>
        body{
            background-image: url("https://wallpapercave.com/wp/wp4323537.png");
            background-repeat:no-repeat;
            height:100%;
            margin:50px;
            background-size: cover;
            background-repeat: no-repeat;
            align-items: center;
        }
        label{

            font-size:40px;
        }
        #blood{
            border:2px solid black;
            margin:20px;
            width:150px;
            height:40px;
        }
        select{
            margin:20px;
        }
        #submit{
            width:150px;
            height:40px;
        }

        /* .table{
            border:2px solid black;
        } */
        table{
            border: none;
        }
       
    </style>
</head>
<body>
<div>
    
    <center><form method="post">
        <!-- <input type="text" name="blood"> -->

        <select name="blood" id="blood" required>
        <option value="A+" class="seelct-box">A+</option>
                <option value="A-" class="seelct-box">A-</option>
                <option value="B+" class="seelct-box">B+</option>
                <option value="B-" class="seelct-box">B-</option>
                <option value="AB+" class="seelct-box">AB+</option>
                <option value="AB-" class="seelct-box">AB-</option>
                <option value="O+" class="seelct-box">O+</option>
                <option value="O-" class="seelct-box">O-</option>
            </select><br>

    <input id="submit" type="submit" name="submit" onclick="active()" value="Submit to get details">

    </form></center>
    <div class='availablebloodgrouppeople'>
        <center><table  cellspacing="0" cellpadding="20">
            <?php
                if(isset($_POST['submit'])){
                    $search = $_POST['blood'];

                    $query = "select * from `blood_donators` where blood_group='$search'";

                    $result= mysqli_query($conn,$query);

                    if($result){
                        if(mysqli_num_rows($result)>0){
                            echo '<thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Blood Group</th>
                            </tr>
                            </thead>';

                           while($row=mysqli_fetch_assoc($result)){

                            echo '<tbody>
                                <tr>
                                <td>'.$row['first_name'].'</td>
                                <td>'.$row['last_name'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>'.$row['phone_number'].'</td>
                                <td>'.$row['blood_group'].'</td>
                                </tr>
                            </tbody>';
                           }
                        }

                        else{
                            echo '<h2>Data Not Found</h2>';
                        }
                        // $num=mysqli_num_rows($result);
                        // echo $num;
                    }
                }
            ?>
        </table>
        </center>
    </div>

</div>

</body>

</html>

