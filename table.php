<?php

require_once("database1.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" a href="CSS/bootstrap.css"/>
    <title>Fetch Available Blood Details</title>
    <style>
       
        table{
            border:2px solid black;
            margin:50px;
        }
        tr{
            border:2px solid black;
            
        }
        td{
            border:2px solid black;
            padding:10px;
        }
    </style>
</head>
<body class="bg-dark">

        <div class="container">
            <div class="row">
                <div class="col m-auto">
                    <div class="card mt-5">
                        <center><table class="table table-bordered">
                            <tr>
                                <td> First Name </td>
                                <td> Last Name </td>
                                <td> Email </td>
                                <td> Phone Number </td>
                                <td> Blood Group  </td>
                            </tr>                                                                     
                        </table></center>
                    </div>
                </div>
            </div>
        </div>
    
</body>
</html>