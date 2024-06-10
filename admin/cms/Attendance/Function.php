<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    
    require("./connect.php");
    function Insert()
{
    global $conn;

  

    if (isset($_POST["btn_sub"])) {
        $studentstatusname = $_POST['studentstatusname'];
        $attendate = $_POST['attendate'];
        $subjecttxt = $_POST['subjecttxt'];
        $lecturetxt = $_POST['lecturetxt'];
        $attended = $_POST['attended'];
        $attennote = $_POST['attennote'];
        $section = $_POST['section'];
        $Dateissue = $_POST['Dateissue'];
    
        if (!empty($studentstatusname) && !empty($attendate) && !empty($subjecttxt) && !empty($lecturetxt) && !empty($attended) && !empty($attennote) && !empty($section) && !empty($Dateissue)) {
    
            $sql_check = "SELECT Section FROM attendance_tbl";
            $rsCheck = $conn->query($sql_check);
            $count = mysqli_fetch_assoc($rsCheck);
            if($count>0){
                echo '
            <script>
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Attendance Already Exists",
                    icon: "error",
                    button: "Done",
                });
            });
            </script>
            ';
            }else{
                $sql = "INSERT INTO `attendance_tbl`(`StudentStatusID`, `AttendanceDateIssue`, `SubjectID`, `Attended`, `AttendNote`, `Section`, `LecturerID`, `DateIssue`) 
           VALUES ('$studentstatusname','$attendate','$subjecttxt','$attended','$attennote','$section','$lecturetxt','$Dateissue') ";
           $rs= $conn->query($sql);
           if($rs){
            echo '
            <script>
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Attendance Added Successfully",
                    icon: "success",
                    button: "Done",
                });
            });
            </script>
            ';
           }else{
            echo '
            <script>
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Attendance Added Fail",
                    icon: "error",
                    button: "Done",
                });
            });
            </script>
            ';
           }
            }
        } 
    }
    
    
}

Insert();

    function getSubject(){
        global $conn;
        $sql = "SELECT * FROM `subject_tbl` ORDER BY SubjectID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $SubjectID= $rw['SubjectID'];
            $SubjectKH= $rw['SubjectKH'];
            echo '
                    <option value='.$SubjectID.'>
                               '.$SubjectKH.'
                    </option>
                ';
        }
    }
    function getLecture(){
        global $conn;
        $sql = "SELECT * FROM `lecturer_tbl` ORDER BY LecturerID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $LecturerID= $rw['LecturerID'];
            $LecturerKH= $rw['LecturerName'];
            echo '
                    <option value='.$LecturerID.'>
                               '.$LecturerKH.'
                    </option>
                ';
        }
    }
   
    function getDay(){
        global $conn;
        $sql = "SELECT * FROM `dayweek_tbl` 
        INNER JOIN shift_tbl ON dayweek_tbl.ShiftID = shift_tbl.ShiftID ORDER BY DayWeekID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $DayWeekID= $rw['DayWeekID'];
            $DayWeekName= $rw['DayWeekName'];
            $Shift = $rw['ShiftEN'];
            echo '
                    <option value='.$DayWeekID.'>
                               '.$DayWeekName.'--'.$Shift.'
                    </option>
                ';
        }
    }
    function getTime(){
        global $conn;
        $sql = "SELECT * FROM `time_tbl` ORDER BY TimeID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $TimeID= $rw['TimeID'];
            $TimeName= $rw['TimeName'];
            echo '
                    <option value='.$TimeID.'>
                               '.$TimeName.'
                    </option>
                ';
        }
    }

    function getRoom(){
        global $conn;
        $sql = "SELECT * FROM `room_tbl` 
        INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID ORDER BY RoomID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $RoomID= $rw['RoomID'];
            $RoomName= $rw['RoomName'];
            $Campus =$rw['CampusKH'];
            echo '
                    <option value='.$RoomID.'>
                               '.$RoomName.'-'.$Campus.'
                    </option>
                ';
        }
    }

    function getAcademicPro(){
        global $conn;
        $sql = "SELECT * FROM `academicprogram_tbl` 
        INNER JOIN academicyear_tbl ON academicprogram_tbl.AcademicYearID = academicyear_tbl.AcademicYearID ORDER BY AcademicProgramID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $AcademicProgramID= $rw['AcademicProgramID'];
            $AcademicProgramEn= $rw['AcademicProgramEn'];
            $AcademicYear =$rw['AcademicYear'];
            echo '
                    <option value='.$AcademicProgramID.'>
                               '.$AcademicProgramEn.'-'.$AcademicYear.';
                    </option>
                ';
        }
    }

    function getStudentStatus(){
        global $conn;
        $sql = "SELECT * FROM `studentstatus_tbl`
        INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID ";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $StudentStatusID= $rw['StudentStatusID'];
            $NameInLatin= $rw['NameInLatin'];
            echo '
                    <option value='.$StudentStatusID.'>
                               '.$NameInLatin.'
                    </option>
                ';
        }
    }
    function getProgram(){
        global $conn;
        $id="";
        if(isset($_GET[ 'id']))
        $id=$_GET['id'];
        $sql = "SELECT * FROM program_tbl 
        INNER JOIN faculty_tbl ON program_tbl.FacultyID = faculty_tbl.FacultyID
        INNER JOIN major_tbl ON program_tbl.MajorID = major_tbl.MajorID
        INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
        INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
        INNER JOIN academicyear_tbl ON program_tbl.AcademicYearID = academicyear_tbl.AcademicYearID
        INNER JOIN batch_tbl ON program_tbl.BatchID = batch_tbl.BatchID
        INNER JOIN campus_tbl ON program_tbl.CampusID = campus_tbl.CampusID
        INNER JOIN degree_tbl ON program_tbl.DegreeID = degree_tbl.DegreeID
        INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID 
        ORDER BY program_tbl.ProgramID ASC ";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $ProgramID= $rw['ProgramID'];
            $yearId = $rw['YearEN'];
            $semesterId = $rw['SemesterEN'];
            $majorId = $rw['MajorId'];
            $batchId = $rw['BatchEN'];
            $campusId = $rw['CampusEN'];
            $degreeId = $rw['DegreeNameEN'];
            $shiftId = $rw['ShiftEN'];
            $acadId = $rw['AcademicYear'];
            echo '
                    <option value='.$ProgramID.'>
                               '.$yearId.'/'.$semesterId.''.$majorId.'/'.$batchId.'/'.$campusId.'/'.$degreeId.'/'.$shiftId.'/'.$acadId.'
                    </option>
                ';
        }
    }

    
    
?>