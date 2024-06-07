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
        $sql = "SELECT * FROM program_tbl WHERE StudentID = '$id'";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $ProgramID= $rw['ProgramID'];
            echo '
                    <option value='.$ProgramID.'>
                               '.$ProgramID.'
                    </option>
                ';
        }
    }

    function InsertProgram(){
       
        global $conn;
        if(isset($_POST['btn_sub'])){
            $yeartxt = $_POST['yeartxt'];
            $semestertxt = $_POST['semestertxt'];
            $shifttxt = $_POST['shifttxt'];
            $degreetxt = $_POST['degreetxt'];
            $academictxt = $_POST['academictxt'];
            $majortxt = $_POST['majortxt'];
            $facultytxt = $_POST['facultytxt'];
            $batchtxt = $_POST['batchtxt'];
            $campustxt = $_POST['campustxt'];
            $startdatetxt = $_POST['startdatetxt'];
            $enddatetxt = $_POST['enddatetxt'];
            $dateissuetxt = $_POST['dateissuetxt'];
                if (!empty($yeartxt) && !empty($semestertxt) && !empty($shifttxt) && !empty($degreetxt) && !empty($academictxt) && !empty($majortxt) && !empty($batchtxt) && !empty($campustxt) && !empty($startdatetxt) && !empty($enddatetxt) && !empty($dateissuetxt) ) {
                //     $sql_check = "SELECT * FROM program_tbl ";
                //     $rsCheck = $conn->query($sql_check);
                //     $count = mysqli_num_rows($rsCheck);
                //     if($count>0){
                //          echo '
                //   <script>
                //   $(document).ready(function(){
                //       swal({
                //           title: "Error!",
                //           text: "Program Already Exists",
                //           icon: "error",
                //           button: "Done",
                //       }).then((value) => {
                //         window.location.href = "?tag=list_program";
                //     });
                //   });
                //   </script>
                //   ';
                //     }else{
                        $sql_ins = "INSERT INTO `program_tbl`( `YearID`, `SemesterID`, `ShiftID`, `DegreeID`, `AcademicYearID`, `FacultyID` , `MajorID`, `BatchID`, `CampusID`, `StartDate`, `EndDate`, `DateIsue`) VALUES 
             ('$yeartxt','$semestertxt','$shifttxt','$degreetxt','$academictxt', '$facultytxt' ,'$majortxt','$batchtxt', '$campustxt' ,'$startdatetxt','$enddatetxt','$dateissuetxt')";
                    $rs = $conn->query($sql_ins);
                    if ($rs) {
                        echo '
                  <script>
                  $(document).ready(function(){
                      swal({
                          title: "Success!",
                          text: "Create Success",
                          icon: "success",
                          button: "Done",
                      }).then((value) => {
                        window.location.href = "?tag=list_program";
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
                          text: "Create Failed",
                          icon: "error",
                          button: "Done",
                      });
                  });
                  </script>
                  ';
                    }
                    // }
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
    InsertProgram();
?>