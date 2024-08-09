<table  cellspacing="0" border="1">
    <form method="POST">
        <tr>
            <th>SName</th>
            <th>P</th>
            <th>A</th>
            <th>L</th>
            <th>H</th>
        </tr>  
        <?php
        require_once('config.php');
        $fetchingStudents=mysqli_query($conn,"SELECT * FROM added_students") OR die(mysqli_error($conn));
        while($data=mysqli_fetch_assoc($fetchingStudents))
        {
            $student_name=$data["student_name"];
            $student_id=$data["ID"];
            ?>
               <tr>
                    <td><?php echo $student_name ;?></td>
                    <td><input type="checkbox" name="StudentPresent[]" value="<?php echo $student_id ;?>"></td>
                    <td><input type="checkbox" name="StudentAbsent[]" value="<?php echo $student_id ;?>"></td>
                    <td><input type="checkbox" name="StudentLeave[]" value="<?php echo $student_id ;?>"></td>
                    <td><input type="checkbox" name="StudentHoliday[]" value="<?php echo $student_id ;?>"></td>
               </tr>
            <?php
        }
        ?>

   
    <tr>
        <td>select date</td>
        <td colspan="4"><input type="date" name="selected_date"/></td>
    </tr>
    <tr>
        <th colspan="5"><center><input type="submit" name="addAttendanceBTN"/></center></th>
    </tr>
    </form>
</table>


<?php
     if(isset($_POST["addAttendanceBTN"]))
     {
        date_default_timezone_set("Asia/Karachi");
        if($_POST["selected_date"] == NULL)
        {
            $selected_date=date("Y-m-d");
        }
        else
        {
             $selected_date=$_POST["selected_date"];
        }
        // date logic ends
        $attendance_month=date("M",strtotime($selected_date));
        // echo $attendance_month;
        $attendance_year=date("Y",strtotime($selected_date));
        // echo $attendance_year;
        
        if(isset($_POST["StudentPresent"]))
        {
            $studentPresent=$_POST["StudentPresent"];
            $attendance="P" ; 
            
            
            foreach($studentPresent as  $atd)
            {
                mysqli_query($conn,"INSERT INTO addattendance(student_id,curr_date,attendance_month,attendance_year,attendance) VALUES('" . $atd."','" .$selected_date."','" . $attendance_month."','" . $attendance_year."','" . $attendance."')") OR die(mysqli_error($conn));
            }
        }

        if(isset($_POST["StudentAbsent"]))
        {
            $studentAbsent=$_POST["StudentAbsent"];
            $attendance="A" ; 
            
            
            foreach($studentAbsent as  $atd)
            {
                mysqli_query($conn,"INSERT INTO addattendance(student_id,curr_date,attendance_month,attendance_year,attendance) VALUES('" . $atd."','" .$selected_date."','" . $attendance_month."','" . $attendance_year."','" . $attendance."')") OR die(mysqli_error($conn));
            }
        }
        if(isset($_POST["StudentLeave"]))
        {
            $studentLeave=$_POST["StudentLeave"];
            $attendance="L" ; 
            
            
            foreach($studentLeave as  $atd)
            {
                mysqli_query($conn,"INSERT INTO addattendance(student_id,curr_date,attendance_month,attendance_year,attendance) VALUES('" . $atd."','" .$selected_date."','" . $attendance_month."','" . $attendance_year."','" . $attendance."')") OR die(mysqli_error($conn));
            }
        }
        if(isset($_POST["StudentHoliday"]))
        {
            $studentHoliday=$_POST["StudentHoliday"];
            $attendance="H" ; 
            
            
            foreach($studentHoliday as  $atd)
            {
                mysqli_query($conn,"INSERT INTO addattendance(student_id,curr_date,attendance_month,attendance_year,attendance) VALUES('" . $atd."','" .$selected_date."','" . $attendance_month."','" . $attendance_year."','" . $attendance."')") OR die(mysqli_error($conn));
            }
        }

        
        
        echo "Attendance added succesfully";
        // print_r($studentPresent);
     }
?>