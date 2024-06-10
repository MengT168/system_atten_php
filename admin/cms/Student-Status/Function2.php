<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php

    function getYear(){
        global $conn;
        $sql = "SELECT * FROM year_tbl ORDER BY YearID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $YearID= $rw['YearID'];
            $YearKH= $rw['YearKH'];
            echo '
                    <option value='.$YearID.'>
                               '.$YearKH.'
                    </option>
                ';
        }
    }

    function getStudent(){
        global $conn;
        $sql = "SELECT * FROM studentinfo_tbl 
                WHERE StudentID NOT IN (SELECT StudentID FROM studentstatus_tbl)
                ORDER BY StudentID";
        $exec = mysqli_query($conn, $sql);
        if (!$exec) {
            echo "Error executing query: " . mysqli_error($conn);
            return;
        }
        while ($rw = mysqli_fetch_array($exec)) {
            $StudentID= $rw['StudentID'];
            $NameInLatin= $rw['NameInLatin'];
            echo '
                <option value="'.$StudentID.'">
                    '.$NameInLatin.'
                </option>
            ';
        }
    }
    
    function getSemester(){
        global $conn;
        $sql = "SELECT * FROM semester_tbl ORDER BY SemesterID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $SemesterID= $rw['SemesterID'];
            $SemesterKH= $rw['SemesterKH'];
            echo '
                    <option value='.$SemesterID.'>
                               '.$SemesterKH.'
                    </option>
                ';
        }
    }
    function getShift(){
        global $conn;
        $sql = "SELECT * FROM shift_tbl ORDER BY ShiftID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $ShiftID= $rw['ShiftID'];
            $ShiftKH= $rw['ShiftKH'];
            echo '
                    <option value='.$ShiftID.'>
                               '.$ShiftKH.'
                    </option>
                ';
        }
    }

    function getDegree(){
        global $conn;
        $sql = "SELECT * FROM degree_tbl ORDER BY DegreeID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $DegreeID= $rw['DegreeID'];
            $DegreeKH= $rw['DegreeNameKH'];
            echo '
                    <option value='.$DegreeID.'>
                               '.$DegreeKH.'
                    </option>
                ';
        }
    }

    function getAcad(){
        global $conn;
        $sql = "SELECT * FROM academicyear_tbl ORDER BY AcademicYearID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $AcademicYearID= $rw['AcademicYearID'];
            $AcademicYear= $rw['AcademicYear'];
            echo '
                    <option value='.$AcademicYearID.'>
                               '.$AcademicYear.'
                    </option>
                ';
        }
    }
    function getMajor(){
        global $conn;
        $sql = "SELECT * FROM major_tbl ORDER BY MajorID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $MajorID= $rw['MajorID'];
            $MajorKH= $rw['MajorKH'];
            echo '
                    <option value='.$MajorID.'>
                               '.$MajorKH.'
                    </option>
                ';
        }
    }

    function getFaculty(){
        global $conn;
        $sql = "SELECT * FROM faculty_tbl ORDER BY FacultyID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $FacultyID= $rw['FacultyID'];
            $FacultyEN= $rw['FacultyEN'];
            echo '
                    <option value='.$FacultyID.'>
                               '.$FacultyEN.'
                    </option>
                ';
        }
    }

    function getBatch(){
        global $conn;
        $sql = "SELECT * FROM batch_tbl ORDER BY BatchID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $BatchID= $rw['BatchID'];
            $BatchKH= $rw['BatchKH'];
            echo '
                    <option value='.$BatchID.'>
                               '.$BatchKH.'
                    </option>
                ';
        }
    }
    function getCampus(){
        global $conn;
        $sql = "SELECT * FROM campus_tbl ORDER BY CampusID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $CampusID= $rw['CampusID'];
            $CampusKH= $rw['CampusKH'];
            echo '
                    <option value='.$CampusID.'>
                               '.$CampusKH.'
                    </option>
                ';
        }
    }

    function getSchoolType(){
        global $conn;
        $sql = "SELECT * FROM schooltype_tbl ORDER BY SchoolTypeID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $SchoolTypeID= $rw['SchoolTypeID'];
            $SchoolTypeKH= $rw['SchoolTypeKH'];
            echo '
                    <option value='.$SchoolTypeID.'>
                               '.$SchoolTypeKH.'
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
        ORDER BY program_tbl.ProgramID ";
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
    
   
    function Insert_Status(){
        global $conn;
        if(isset($_POST['btn_add_status'])){
            $studenttxt = $_POST['studenttxt'];
            $assignetxt = $_POST['assignetxt'];
            $notetxt = $_POST['notetxt'];
            $programtxt = $_POST['programtxt'];
            $assigndate = $_POST['assigndate'];
           
            if ( !empty($assignetxt) && !empty($notetxt) && !empty($programtxt) && !empty($assigndate) && !empty($studenttxt)  ) {
                // Check if the student already exists with a different program
                $sql_check = "SELECT * FROM studentstatus_tbl WHERE StudentID = '$studenttxt' AND ProgramID = '$programtxt'";
                $result = $conn->query($sql_check);
                if ($result->num_rows > 0) {
                    echo '
                      <script>
                      $(document).ready(function(){
                          swal({
                              title: "Error!",
                              text: "The student already exists .",
                              icon: "error",
                              button: "Done",
                          });
                      });
                      </script>
                    ';
                } else {
                    // Insert the new record
                    $sql_insert = "INSERT INTO studentstatus_tbl (`StudentID`, `ProgramID`, `Assigned`, `Note`, `AssignDate`) VALUES ('$studenttxt', '$programtxt' , '$assignetxt', '$notetxt', '$assigndate')";
                    if ($conn->query($sql_insert) === TRUE) {
                        echo '
                          <script>
                          $(document).ready(function(){
                              swal({
                                  title: "Success!",
                                  text: "Status added successfully.",
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
                                  text: "Error adding status. Please try again.",
                                  icon: "error",
                                  button: "Done",
                              });
                          });
                          </script>
                        ';
                    }
                }
            } else {
                echo '
                  <script>
                  $(document).ready(function(){
                      swal({
                          title: "Error!",
                          text: "Please Fill All Input",
                          icon: "error",
                          button: "Done",
                      });
                  });
                  </script>
                ';
            }
        }
    }
    Insert_Status();

    function updatePro(){
        global $conn;
        $id="";
        if(isset($_GET[ 'id']))
        $id=$_GET['id'];
             
        if(isset($_POST['btn_up_pro'])){
            //status
           $program=$_POST['program'];
            $assign=$_POST['assign'];
            $note=$_POST['note'];
            $assignDate=$_POST['assignDate'];
            

            $sql_Up_status ="UPDATE `studentstatus_tbl` 
            SET `ProgramID`='$program',
                `Assigned`='$assign',
                `Note`='$note',
                `AssignDate`='$assignDate' WHERE StudentStatusID = $id";
               
                $rs = $conn->query($sql_Up_status);
                if ($rs) {
                  echo '
                  <script>
                  $(document).ready(function(){
                      swal({
                          title: "Success!",
                          text: "Update Success",
                          icon: "success",
                          button: "Done",
                      }).then((value) => {
                          window.location.href = window.location.href; // Refresh the current page.
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
                            text: "Update Failed",
                            icon: "error",
                            button: "Done",
                        });
                    });
                    </script>
                    ';
                }
        }
    }
    updatePro();
    function updateEdu(){
        global $conn;
        $id="";
        if(isset($_GET[ 'id']))
        $id=$_GET['id'];
             
        if(isset($_POST['btn_up_edu'])){
           $schooltytxt=$_POST['schooltytxt'];
            $schoolnametxt=$_POST['schoolnametxt'];
            $academictxt=$_POST['academictxt'];
            $cityprovince=$_POST['cityprovince'];
           

            $sql_Up_Edu ="UPDATE `educationalbackground_tbl` 
            SET `SchoolTypeID`='$schooltytxt',
                `NameSchool`='$schoolnametxt',`AcademicYear`='$academictxt',
                `Province`='$cityprovince' WHERE StudentID = $id";
                $rs = $conn->query($sql_Up_Edu);
                if ($rs) {
                  echo '
                  <script>
                  $(document).ready(function(){
                      swal({
                          title: "Success!",
                          text: "Update Success",
                          icon: "success",
                          button: "Done",
                      }).then((value) => {
                          window.location.href = window.location.href; // Refresh the current page.
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
                            text: "Update Failed",
                            icon: "error",
                            button: "Done",
                        });
                    });
                    </script>
                    ';
                }
        }
    }
    updateEdu();
?>