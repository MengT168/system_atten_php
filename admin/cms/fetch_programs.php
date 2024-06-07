<?php
include("./connect.php");
global $conn;

if(isset($_POST['subjectID'])) {
    $subjectID = $_POST['subjectID'];

    // Fetch FacultyID, MajorID, YearID, and SemesterID based on the selected subject
    $subjectQuery = "SELECT FacultyID, MajorID, YearID, SemesterID FROM subject_tbl WHERE SubjectID = '$subjectID'";
    $subjectResult = mysqli_query($conn, $subjectQuery);
    $subjectData = mysqli_fetch_assoc($subjectResult);

    if ($subjectData) {
        $facultyID = $subjectData['FacultyID'];
        $majorID = $subjectData['MajorID'];
        $yearID = $subjectData['YearID'];
        $semesterID = $subjectData['SemesterID'];

        // Fetch programs based on the above IDs
        $programQuery = "SELECT program_tbl.ProgramID, faculty_tbl.FacultyEN, major_tbl.MajorEN, 
                         year_tbl.YearEN, semester_tbl.SemesterEN, shift_tbl.ShiftEN , campus_tbl.CampusEN
                         FROM program_tbl
                         INNER JOIN faculty_tbl ON program_tbl.FacultyID = faculty_tbl.FacultyID
                         INNER JOIN major_tbl ON program_tbl.MajorID = major_tbl.MajorID
                         INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
                         INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
                         INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID
                         INNER JOIN campus_tbl ON program_tbl.CampusID = campus_tbl.CampusID
                         WHERE program_tbl.FacultyID = '$facultyID' 
                         AND program_tbl.MajorID = '$majorID' 
                         AND program_tbl.YearID = '$yearID' 
                         AND program_tbl.SemesterID = '$semesterID'";
        $programResult = mysqli_query($conn, $programQuery);
        $options = '<option value="">Select One</option>';
        while ($row = mysqli_fetch_assoc($programResult)) {
            $options .= '<option value="' . $row['ProgramID'] . '">'
                        . $row['YearEN'] . ' - ' 
                        . $row['MajorEN'] . ' - ' 
                        . $row['ShiftEN'] . ' - ' 
                        . $row['SemesterEN'] . ' - ' 
                        . $row['CampusEN'] . ' - ' 
                        . $row['FacultyEN'] . '</option>';
        }
        echo $options;
    } else {
        echo '<option value="">No programs available</option>';
    }
}
?>
