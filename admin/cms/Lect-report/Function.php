<?php
     require("./connect.php");

     

     function getFaculty(){
        global $conn;
        $sql = "SELECT * FROM `faculty_tbl` ORDER BY FacultyID";
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
        $sql = "SELECT * FROM `batch_tbl` ORDER BY BatchID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $BatchID= $rw['BatchID'];
            $BatchEN= $rw['BatchEN'];
            echo '
                    <option value='.$BatchID.'>
                               '.$BatchEN.'
                    </option>
                ';
        }
     }

     
?>