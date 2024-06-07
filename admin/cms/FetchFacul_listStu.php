<?php
include("./connect.php");
global $conn;

if(isset($_POST['facultyID'])) {
    $facultyId = $_POST['facultyID'];
    $sql = "SELECT * FROM `major_tbl` WHERE FacultyID = '$facultyId'";
    $result = mysqli_query($conn, $sql);
    $options = '<option value="">Select Major</option>';
    
    while($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="'.$row['MajorID'].'">'.$row['MajorEN'].'</option>';
    }
    
    echo $options;
}
?>
