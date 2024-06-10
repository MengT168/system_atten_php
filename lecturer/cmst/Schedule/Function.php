<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    
    
    function getProgram(){
        global $conn;
        $id = $_SESSION['idL'];
        
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
        INNER JOIN schedule_tbl ON program_tbl.ProgramID = schedule_tbl.ProgramID
        INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID
        WHERE lecturer_tbl.LecturerID=$id
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