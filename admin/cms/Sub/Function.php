<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php
     require("./connect.php");

     function getFaculty(){
        global $conn;
        $sql = "SELECT * FROM faculty_tbl ORDER BY FacultyID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $facultyId= $rw['FacultyID'];
            $facultyEn= $rw['FacultyEN'];
            echo '
                    <option value='.$facultyId.'>
                               '.$facultyEn.'
                    </option>
                ';
        }
    }

    function getYear(){
        global $conn;
        $sql = "SELECT * FROM year_tbl ORDER BY YearID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $YearID= $rw['YearID'];
            $YearEN= $rw['YearEN'];
            echo '
                    <option value='.$YearID.'>
                               '.$YearEN.'
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
            $SemesterEN= $rw['SemesterEN'];
            echo '
                    <option value='.$SemesterID.'>
                               '.$SemesterEN.'
                    </option>
                ';
        }
    }

    function Insert(){
        global $conn;
        if (isset($_POST['btn_sub'])) {
        
            $MajorID = $_POST['majorId'];
            $FacultyId = $_POST['FacultyID'];
            $Hour = $_POST['Hours'];
            $SubjectKH = $_POST['SubjectKH'];
            $SubjectEN = $_POST['SubjectEN'];
            $Number = $_POST['CreditNumber'];
            $Year = $_POST['YearID'];
            $Semester = $_POST['SemesterID'];
            $sql = "INSERT INTO subject_tbl ( SubjectKH, SubjectEN, CreditNumber,Hours,MajorID,YearID,SemesterID,FacultyID)
           VALUES ( '$SubjectKH', '$SubjectEN', '$Number', '$Hour', '$MajorID', '$Year', '$Semester','$FacultyId')";;
            if (mysqli_query($conn, $sql)) {
                echo '
            <script>
            $(document).ready(function(){
                swal({
                    title: "Success!",
                    text: "Add Success",
                    icon: "success",
                    button: "Done",
                });
            });
            </script>
            ';
            } else {
                echo "Error: " . $sql . ":-" . mysqli_error($conn);
            }
        }
    }
    Insert();
?>
