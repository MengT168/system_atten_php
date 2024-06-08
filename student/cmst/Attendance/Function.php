<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    
    
    function getProgram(){
        global $conn;
        $id = $_SESSION['id'];

       
        
        $sql = "SELECT * FROM `studentstatus_tbl`
INNER JOIN program_tbl ON studentstatus_tbl.ProgramID = program_tbl.ProgramID
INNER JOIN schedule_tbl ON program_tbl.ProgramID = schedule_tbl.ProgramID
INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID
INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID
        WHERE studentinfo_tbl.StudentID =$id
        ";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $LecturerID = $rw['LecturerID'];
            $SubjectEN= $rw['SubjectEN'];
            $LecturerName = $rw['LecturerName'];
            
            echo '
                    <option value='.$LecturerID.'>
                               '.$SubjectEN.'/'.$LecturerName.'
                    </option>
                ';
        }
    }
?>