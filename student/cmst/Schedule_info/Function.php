<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    
    require("../../././admin/cms/connect.php");
    function Insert()
{
    global $conn;

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST["btn_sub"])) {
        $subjecttxt = $_POST['subjecttxt'];
        $lecturetxt = $_POST['lecturetxt'];
        $daytxt = $_POST['daytxt'];
        $timetxt = $_POST['timetxt'];
        $roomtxt = $_POST['roomtxt'];
        $programtxt = $_POST['programtxt'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $scheduleDate = $_POST['scheduleDate'];
    
        if (!empty($subjecttxt) && !empty($lecturetxt) && !empty($daytxt) && !empty($timetxt) && !empty($roomtxt) && !empty($programtxt) && !empty($startDate) && !empty($endDate) && !empty($scheduleDate)) {
            
            // Fetch shiftID for the selected day
            $queryDay = "SELECT ShiftID FROM dayweek_tbl WHERE DayWeekID = '$daytxt'";
            $resultDay = $conn->query($queryDay);
            $dayShiftID = ($resultDay->num_rows > 0) ? $resultDay->fetch_assoc()['ShiftID'] : null;

            // Fetch shiftID for the selected program
            $queryProgram = "SELECT ShiftID FROM program_tbl WHERE ProgramID = '$programtxt'";
            $resultProgram = $conn->query($queryProgram);
            $programShiftID = ($resultProgram->num_rows > 0) ? $resultProgram->fetch_assoc()['ShiftID'] : null;

            if ($dayShiftID === $programShiftID) {
                $query = "SELECT * FROM `schedule_tbl` WHERE `SubjectID`='$subjecttxt' AND `LecturerID`='$lecturetxt' AND `DayWeekID`='$daytxt' AND `RoomID`='$roomtxt'";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    echo '
                    <script>
                    $(document).ready(function(){
                        swal({
                            title: "Error!",
                            text: "Combination already exists",
                            icon: "error",
                            button: "Done",
                        });
                    });
                    </script>
                    ';
                } else {
                    $query = "SELECT * FROM `schedule_tbl` WHERE `SubjectID`='$subjecttxt' AND `LecturerID`='$lecturetxt' AND `DayWeekID`='$daytxt' AND `RoomID`<>'$roomtxt'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        echo '
                        <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error!",
                                text: "Combination exists with a different Room",
                                icon: "error",
                                button: "Done",
                            });
                        });
                        </script>
                        ';
                    } else {
                        $query = "SELECT * FROM `schedule_tbl` WHERE `SubjectID`<>'$subjecttxt' AND `LecturerID`='$lecturetxt' AND `DayWeekID`='$daytxt' AND `RoomID`='$roomtxt'";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            echo '
                            <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Error!",
                                    text: "Combination exists with a different Subject",
                                    icon: "error",
                                    button: "Done",
                                });
                            });
                            </script>
                            ';
                        } else {
                            $query = "SELECT * FROM `schedule_tbl` WHERE `SubjectID`<>'$subjecttxt' AND `LecturerID`='$lecturetxt' AND `DayWeekID`='$daytxt' AND `RoomID`<>'$roomtxt'";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                echo '
                                <script>
                                $(document).ready(function(){
                                    swal({
                                        title: "Error!",
                                        text: "Combination exists with a different Subject and different Room",
                                        icon: "error",
                                        button: "Done",
                                    });
                                });
                                </script>
                                ';
                            } else {
                                $query = "SELECT * FROM `schedule_tbl` WHERE `SubjectID`='$subjecttxt' AND `LecturerID`<>'$lecturetxt' AND `DayWeekID`='$daytxt' AND `TimeID`='$timetxt' AND `RoomID`='$roomtxt'";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    echo '
                                    <script>
                                    $(document).ready(function(){
                                        swal({
                                            title: "Error!",
                                            text: "Combination exists with a different Lecture",
                                            icon: "error",
                                            button: "Done",
                                        });
                                    });
                                    </script>
                                    ';
                                } else{
                                    $query = "SELECT * FROM `schedule_tbl` WHERE `SubjectID`<>'$subjecttxt' AND `LecturerID`<>'$lecturetxt' AND `DayWeekID`='$daytxt' AND `TimeID`='$timetxt' AND `RoomID`='$roomtxt'";
                                    $result = $conn->query($query);
                                    if ($result->num_rows > 0) {
                                        echo '
                                        <script>
                                        $(document).ready(function(){
                                            swal({
                                                title: "Error!",
                                                text: "Combination exists with a different Subject, different Lecturer, same Day, same Time, and same Room",
                                                icon: "error",
                                                button: "Done",
                                            });
                                        });
                                        </script>
                                        ';
                                    } else {
                                        $insert_query = "INSERT INTO `schedule_tbl` (`SubjectID`, `LecturerID`, `DayWeekID`, `TimeID`, `RoomID`, `ProgramID`, `DateStart`, `DateEnd`, `ScheduleDate`) VALUES ('$subjecttxt','$lecturetxt','$daytxt','$timetxt','$roomtxt','$programtxt','$startDate','$endDate','$scheduleDate')";
                                        if ($conn->query($insert_query) === TRUE) {
                                            echo '
                                            <script>
                                            $(document).ready(function(){
                                                swal({
                                                    title: "Success!",
                                                    text: "Record inserted successfully",
                                                    icon: "success",
                                                    button: "Done",
                                                });
                                            });
                                            </script>
                                            ';
                                        } else {
                                            echo '
                                            <script>
                                            $(document).ready(function(){
                                                swal({
                                                    title: "Error!",
                                                    text: "Failed to insert record",
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
                    }
                }
            } else {
                echo '
                <script>
                $(document).ready(function(){
                    swal({
                        title: "Error!",
                        text: "Shift mismatch between selected day and program",
                        icon: "error",
                        button: "Done",
                    });
                });
                </script>
                ';
            }
        } else {
            echo '
            <script>
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Please fill in all required fields",
                    icon: "error",
                    button: "Done",
                });
            });
            </script>
            ';
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
                               '.$AcademicYear.'
                    </option>
                ';
        }
    }

    function Faculty(){
        global $conn;
        $sql = "SELECT * FROM `faculty_tbl`";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $FacultyEN= $rw['FacultyEN'];
            $FacultyID = $rw['FacultyID '];
            echo '
                    <option value='.$FacultyID.'>
                               '.$FacultyEN.'
                    </option>
                ';
        }
    }
    function Year(){
        global $conn;
        $sql = "SELECT * FROM `year_tbl`";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $YearEN= $rw['YearEN'];
            $YearID  = $rw['YearID'];
            echo '
                    <option value='.$YearID .'>
                               '.$YearEN.'
                    </option>
                ';
        }
    }
    function Semester(){
        global $conn;
        $sql = "SELECT * FROM `semester_tbl`";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $SemesterEN= $rw['SemesterEN'];
            $SemesterID  = $rw['SemesterID'];
            echo '
                    <option value='.$SemesterID .'>
                               '.$SemesterEN.'
                    </option>
                ';
        }
    }
    function Shift(){
        global $conn;
        $sql = "SELECT * FROM `shift_tbl`";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $ShiftEN= $rw['ShiftEN'];
            $ShiftID  = $rw['ShiftID'];
            echo '
                    <option value='.$ShiftID .'>
                               '.$ShiftEN.'
                    </option>
                ';
        }
    }
    function getProgram(){
        global $conn;
        $id = $_SESSION['idS'];
        
        $sql = "SELECT * FROM `studentstatus_tbl` 
INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID
INNER JOIN program_tbl ON studentstatus_tbl.ProgramID = program_tbl.ProgramID
 INNER JOIN faculty_tbl ON program_tbl.FacultyID = faculty_tbl.FacultyID
        INNER JOIN major_tbl ON program_tbl.MajorID = major_tbl.MajorID
        INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
        INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
        INNER JOIN academicyear_tbl ON program_tbl.AcademicYearID = academicyear_tbl.AcademicYearID
        INNER JOIN batch_tbl ON program_tbl.BatchID = batch_tbl.BatchID
        INNER JOIN campus_tbl ON program_tbl.CampusID = campus_tbl.CampusID
        INNER JOIN degree_tbl ON program_tbl.DegreeID = degree_tbl.DegreeID
        INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID
        WHERE studentinfo_tbl.StudentID =$id
        ";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $ProgramID= $rw['ProgramID'];
            $yearId = $rw['YearEN'];
            $semesterId = $rw['SemesterEN'];
            $majorId = $rw['MajorEN'];
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