<?php 
    $firstDayOfMonth = date('1-m-Y');
    $totalDaysInMonth = date('t',strtotime($firstDayOfMonth));
    //fectching students
    // $fetchingStudents = mysqli_query($db,"SELECT * FROM attendance_students") or die(mysqli_error($db)); 
    // $totalNoOfStudents = mysqli_num_rows($fetchingStudents);
    // $studentNamesArray = array();
    // $counter = 0;
    // while($students = mysqli_fetch_assoc($fetchingStudents))
    // {
    //     $studentNamesArraye[] = $students['student_name'];
    // }
    $totalNoOfStudents = 65;

?>
<h1>SMART ATTENDACE MANAGEMENT SYSTEM</h1>
<H3>STUDENT ATTENDANCE OF A MONTH : <u><font color='red'><?php echo strtoupper(date("F"));?></font></u></H3>

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
                for($j=0; $j<=$totalDaysInMonth; $j++){
                    echo "<td>" . date('D', strtotime("+$j days", strtotime($firstDayOfMonth))). "</td>";
                }
                echo "</tr>";
            }
            else{
                // echo '<tr>';
                echo '<td> abc </td>';
                // echo "<td>". $studentNamesArray[$counter] ."</td>";
                for($j=0; $j<=$totalDaysInMonth; $j++){
                    echo "<td></td>";
                }
                echo "</tr>";
                $counter++;
            }
        }
        
    ?>
</table>
