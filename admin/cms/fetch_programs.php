<?php
include("./connect.php");
global $conn;

if(isset($_POST['programID'])) {
    $programID = $_POST['programID'];

    $subjectQuery = "SELECT FacultyID, MajorID, YearID, SemesterID FROM program_tbl WHERE ProgramID = '$programID'";
    $subjectResult = mysqli_query($conn, $subjectQuery);
    $subjectData = mysqli_fetch_assoc($subjectResult);

    if ($subjectData) {
        $facultyID = $subjectData['FacultyID'];
        $majorID = $subjectData['MajorID'];
        $yearID = $subjectData['YearID'];
        $semesterID = $subjectData['SemesterID'];

        $programQuery = "SELECT subject_tbl.SubjectID, faculty_tbl.FacultyEN, major_tbl.MajorEN, 
                         year_tbl.YearEN, semester_tbl.SemesterEN , subject_tbl.SubjectEN
                         FROM subject_tbl
                         INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                         INNER JOIN major_tbl ON subject_tbl.MajorID = major_tbl.MajorID
                         INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID
                         INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                         WHERE subject_tbl.FacultyID = '$facultyID' 
                         AND subject_tbl.MajorID = '$majorID' 
                         AND subject_tbl.YearID = '$yearID' 
                         AND subject_tbl.SemesterID = '$semesterID'";
        $programResult = mysqli_query($conn, $programQuery);
        $options = '<option value="">Select One</option>';
        while ($row = mysqli_fetch_assoc($programResult)) {
            $options .= '<option value="' . $row['SubjectID'] . '">'
                        . $row['SubjectEN'].'</option>';
        }
        echo $options;
    } else {
        echo '<option value="">No programs available</option>';
    }
}
?>
