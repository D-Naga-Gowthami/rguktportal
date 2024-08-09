<?php 
    require_once("config.php");
    $firstDayOfMonth = date('1-m-Y');
    $totalDaysInMonth = date('t',strtotime($firstDayOfMonth));
    // fetchingStudents
    $fetchingStudents=mysqli_query($conn,"SELECT * FROM added_students") OR die (mysqli_error($conn));
    $totalNoOfStudents = mysqli_num_rows($fetchingStudents);
    $studentNamesArray=array();
    $studentIDsArray=array();
    $counter=0;
    while($students=mysqli_fetch_assoc($fetchingStudents))
    {
        $studentNamesArray[]= $students["student_name"];
        $studentIDsArray[]= $students["ID"];
    }
    // print_r($studentIDsArray)

?>


<table border='1' cellspacing='0'>
    <?php 
        for($i = 1 ; $i <= $totalNoOfStudents+2; $i++){
            if($i==1){
                echo '<tr>';
                echo "<td rowspan='2'>Names</>";
                for($j=1; $j<=$totalDaysInMonth; $j++){
                    echo "<td>$j</td>";
                }
            }
            else if($i==2){
                echo '<tr>';
                for($j=1; $j<=$totalDaysInMonth; $j++){
                    echo "<td>" . date('D', strtotime("+$j days", strtotime($firstDayOfMonth))). "</td>";
                }
                echo "</tr>";
            }
            else{
                echo '<tr>';
                echo '<td> '.$studentNamesArray[$counter].'</td>';
                // echo "<td>". $studentNamesArray[$counter] ."</td>";
                for($j=1; $j<=$totalDaysInMonth; $j++){
                    $dateOfAttendance=date("Y-m-$j");
                    // echo $dateOfAttendance;
                    $fetchingStudentsAttendance=mysqli_query($conn,"SELECT  attendance FROM addattendance WHERE student_id='".$studentIDsArray[$counter]."' AND curr_date='".$dateOfAttendance."'") OR die(mysqli_error($conn));
                    $isAttendanceAdded = mysqli_num_rows($fetchingStudentsAttendance);
                    if($isAttendanceAdded>0){
                        $studentAttendance = mysqli_fetch_assoc($fetchingStudentsAttendance); 
                        if($studentAttendance['attendance']=='P'){
                            $color = 'lightgreen';
                        }
                        else if($studentAttendance['attendance']=='A'){
                            $color = '#ff3333';
                        }
                        else if($studentAttendance['attendance']=='H'){
                            $color = '#4d94ff';
                        }
                        else if($studentAttendance['attendance']=='L'){
                            $color = '#d279d2';
                        }

                        echo "<td style='background-color: $color ; color : black'>". $studentAttendance['attendance'] ."</td>";
                    }else{
                        echo "<td></td>";
                    }
            
                }
                echo "</tr>";
                $counter++;
            }
        }
        
    ?>
</table>
