<?php
     require("./connect.php");

     function getRoom(){
        global $conn;
        $sql = "SELECT * FROM `room_tbl` 
                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                ORDER BY RoomID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $RoomID= $rw['RoomID'];
            $RoomName= $rw['RoomName'];
            $CampusEN= $rw['CampusEN'];
            echo '
                    <option value='.$RoomID.'>
                               '.$RoomName.'/'.$CampusEN.'
                    </option>
                ';
        }
     }
     function getMajor(){
        global $conn;
        $sql = "SELECT * FROM `major_tbl` ORDER BY MajorID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $MajorID= $rw['MajorID'];
            $MajorEN= $rw['MajorEN'];
            echo '
                    <option value='.$MajorID.'>
                               '.$MajorEN.'
                    </option>
                ';
        }
     }

     function getShift(){
        global $conn;
        $sql = "SELECT * FROM `shift_tbl` ORDER BY ShiftID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $ShiftID= $rw['ShiftID'];
            $ShiftEN= $rw['ShiftEN'];
            echo '
                    <option value='.$ShiftID.'>
                               '.$ShiftEN.'
                    </option>
                ';
        }
     }

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

     function getCampus(){
        global $conn;
        $sql = "SELECT * FROM `campus_tbl` ORDER BY CampusID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $CampusID= $rw['CampusID'];
            $CampusEN= $rw['CampusEN'];
            echo '
                    <option value='.$CampusID.'>
                               '.$CampusEN.'
                    </option>
                ';
        }
     }
?>