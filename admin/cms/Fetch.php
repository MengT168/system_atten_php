<?php
include("./connect.php");
global $conn;

if(isset($_POST['daytxt'])) {
    $daytxt = $_POST['daytxt'];
    $sql = "SELECT time_tbl.TimeID, time_tbl.TimeName FROM time_tbl
            INNER JOIN dayweek_tbl ON time_tbl.ShiftID = dayweek_tbl.ShiftID
            WHERE dayweek_tbl.DayWeekID = '$daytxt'";
    $result = mysqli_query($conn, $sql);
    $options = '<option value="">Select Time</option>';
    while($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="'.$row['TimeID'].'">'.$row['TimeName'].'</option>';
    }
    echo $options;
}
?>