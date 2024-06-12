<?php require('Function.php'); 
$conn = mysqli_connect("localhost","root","","demo_db");
$op = "";
$id = "";
global $conn;
if (isset($_GET['op']))
    $op = $_GET['op'];

// if (isset($_GET['id']))
    $id = $_SESSION['idL'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .checkbox-list{
    color: #262525;
    /* background: linear-gradient(#3a7bd5, #3a6073); */
    padding: 25px;
    border-radius: 10px;
}
.checkbox{
    border-bottom: 1px dashed rgba(255,255,255,0.5);
    padding: 5px 5px 9px 5px;
    margin: 0 0 10px;
    display: block;
}
.checkbox input[type=checkbox]{
    margin: 0;
    visibility: hidden;
    left: 1px;
    top: 1px;
}
.checkbox label{
    font-size: 20px;
    line-height: 26px;
    padding-left: 35px;
    margin: 0;
    display: block;
    cursor: pointer;
    position: relative;
    transition: all 0.3s ease 0s;
}
.checkbox label:before,
.checkbox label:after{
    content: "";
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255,255,255,3);
    border-radius: 4px;
    position: absolute;
    top: 3px;
    left: 3px;
    transition: all 0.25s;
}
.checkbox label:after{
    height: 10px;
    width: 16px;
    border-radius: 0 0 0 4px;
    border: 5px solid #262525;
    border-top: none;
    border-right: none;
    opacity: 0;
    transform: rotate(-45deg);
    top: 15px;
    left: 6px;
}
.checkbox input[type=checkbox]:checked+label{ font-weight: 600; }
.checkbox input[type=checkbox]:checked+label:before{
    opacity: 0;
    top: -10px;
}
.checkbox input[type=checkbox]:checked+label:after{
    opacity: 1;
    top: 6px;
}
@media only screen and (max-width:767px){
    .checkbox{ margin: 0 0 20px; }
}
    </style>
    <style>
        body{margin-top:20px;}


/* USER LIST TABLE */
.user-list tbody td > img {
    position: relative;
	max-width: 50px;
	float: left;
	margin-right: 15px;
}
.user-list tbody td .user-link {
	display: block;
	font-size: 1.25em;
	padding-top: 3px;
	margin-left: 60px;
}
.user-list tbody td .user-subhead {
	font-size: 0.875em;
	font-style: italic;
}

/* TABLES */
.table {
    border-collapse: separate;
}
.table-hover > tbody > tr:hover > td,
.table-hover > tbody > tr:hover > th {
	background-color: #eee;
}
.table thead > tr > th {
	border-bottom: 1px solid #C2C2C2;
	padding-bottom: 0;
}
.table tbody > tr > td {
	font-size: 0.875em;
	background: #f5f5f5;
	border-top: 10px solid #fff;
	vertical-align: middle;
	padding: 12px 8px;
}
.table tbody > tr > td:first-child,
.table thead > tr > th:first-child {
	padding-left: 20px;
}
.table thead > tr > th span {
	border-bottom: 2px solid #C2C2C2;
	display: inline-block;
	padding: 0 5px;
	padding-bottom: 5px;
	font-weight: normal;
}
.table thead > tr > th > a span {
	color: #344644;
}
.table thead > tr > th > a span:after {
	content: "\f0dc";
	font-family: FontAwesome;
	font-style: normal;
	font-weight: normal;
	text-decoration: inherit;
	margin-left: 5px;
	font-size: 0.75em;
}
.table thead > tr > th > a.asc span:after {
	content: "\f0dd";
}
.table thead > tr > th > a.desc span:after {
	content: "\f0de";
}
.table thead > tr > th > a:hover span {
	text-decoration: none;
	color: #2bb6a3;
	border-color: #2bb6a3;
}
.table.table-hover tbody > tr > td {
	-webkit-transition: background-color 0.15s ease-in-out 0s;
	transition: background-color 0.15s ease-in-out 0s;
}
.table tbody tr td .call-type {
	display: block;
	font-size: 0.75em;
	text-align: center;
}
.table tbody tr td .first-line {
	line-height: 1.5;
	font-weight: 400;
	font-size: 1.125em;
}
.table tbody tr td .first-line span {
	font-size: 0.875em;
	color: #969696;
	font-weight: 300;
}
.table tbody tr td .second-line {
	font-size: 0.875em;
	line-height: 1.2;
}
.table a.table-link {
	margin: 0 5px;
	font-size: 1.125em;
}
.table a.table-link:hover {
	text-decoration: none;
	color: #2aa493;
}
.table a.table-link.danger {
	color: #fe635f;
}
.table a.table-link.danger:hover {
	color: #dd504c;
}

.table-products tbody > tr > td {
	background: none;
	border: none;
	border-bottom: 1px solid #ebebeb;
	-webkit-transition: background-color 0.15s ease-in-out 0s;
	transition: background-color 0.15s ease-in-out 0s;
	position: relative;
}
.table-products tbody > tr:hover > td {
	text-decoration: none;
	background-color: #f6f6f6;
}
.table-products .name {
	display: block;
	font-weight: 600;
	padding-bottom: 7px;
}
.table-products .price {
	display: block;
	text-decoration: none;
	width: 50%;
	float: left;
	font-size: 0.875em;
}
.table-products .price > i {
	color: #8dc859;
}
.table-products .warranty {
	display: block;
	text-decoration: none;
	width: 50%;
	float: left;
	font-size: 0.875em;
}
.table-products .warranty > i {
	color: #f1c40f;
}
.table tbody > tr.table-line-fb > td {
	background-color: #9daccb;
	color: #262525;
}
.table tbody > tr.table-line-twitter > td {
	background-color: #9fccff;
	color: #262525;
}
.table tbody > tr.table-line-plus > td {
	background-color: #eea59c;
	color: #262525;
}
.table-stats .status-social-icon {
	font-size: 1.9em;
	vertical-align: bottom;
}
.table-stats .table-line-fb .status-social-icon {
	color: #556484;
}
.table-stats .table-line-twitter .status-social-icon {
	color: #5885b8;
}
.table-stats .table-line-plus .status-social-icon {
	color: #a75d54;
}

    </style>
    <style>
        body{
    margin-top:20px;
}
.bg-light-gray {
    background-color: #f7f7f7;
}
.table-bordered thead td, .table-bordered thead th {
    border-bottom-width: 2px;
}
.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}
.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
}


.bg-sky.box-shadow {
    box-shadow: 0px 5px 0px 0px #00a2a7
}

.bg-orange.box-shadow {
    box-shadow: 0px 5px 0px 0px #af4305
}

.bg-green.box-shadow {
    box-shadow: 0px 5px 0px 0px #4ca520
}

.bg-yellow.box-shadow {
    box-shadow: 0px 5px 0px 0px #dcbf02
}

.bg-pink.box-shadow {
    box-shadow: 0px 5px 0px 0px #e82d8b
}

.bg-purple.box-shadow {
    box-shadow: 0px 5px 0px 0px #8343e8
}

.bg-lightred.box-shadow {
    box-shadow: 0px 5px 0px 0px #d84213
}


.bg-sky {
    background-color: #02c2c7
}

.bg-orange {
    background-color: #e95601
}

.bg-green {
    background-color: #5bbd2a
}

.bg-yellow {
    background-color: #f0d001
}

.bg-pink {
    background-color: #ff48a4
}

.bg-purple {
    background-color: #9d60ff
}

.bg-lightred {
    background-color: #ff5722
}

.padding-15px-lr {
    padding-left: 15px;
    padding-right: 15px;
}
.padding-5px-tb {
    padding-top: 5px;
    padding-bottom: 5px;
}
.margin-10px-bottom {
    margin-bottom: 10px;
}
.border-radius-5 {
    border-radius: 5px;
}

.margin-10px-top {
    margin-top: 10px;
}
.font-size14 {
    font-size: 14px;
}

.text-light-gray {
    color: #d6d5d5;
}
.font-size13 {
    font-size: 13px;
}

.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
    </style>

</head>
<body>
<main id="main" class="main">
       
        <section class="section">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Attendance</h5>

                            <div class="row g-2">
                            <div class="col-3">
                                <label class="form-label">Program</label>
                                <select id="program" name="academicpro" class="form-select">
                                    <option value="">Select One</option>
                                    <?php getProgram(); ?>
                                </select>
                            </div>
                            
                            <div class="col-2">
                                <a id="searchBtn" style="margin-top: 30px;" href="#" class="btn btn-primary">Search</a>
                            </div>
                            <!-- <div class="col-4"  >
                            <form method="post" style="display: flex; gap: 5px; justify-content: space-between; margin-top: 30px; "   >
                            <input type="date" class="form-control" >
                            <button class="btn btn-primary" >Search</button>
                            </form>
                            </div> -->
                        </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
<script>
    document.getElementById('searchBtn').addEventListener('click', function(event) {
        event.preventDefault(); 

        // Get the selected values
        var program = document.getElementById('program').value;
        
        // Construct the URL with the selected values
        var url = '?tag=attendance&op=search';
        url += '&program=' + encodeURIComponent(program);
        
        window.location.href = url;
    });
</script>
<script>
    // Get the input element
    var dateInput = document.getElementById('dateInput');

    // Add an event listener to listen for changes in the input value
    dateInput.addEventListener('change', function() {
      // Get the value of the input
      var inputValue = this.value;

      // Split the input value into parts (year, month, day)
      var parts = inputValue.split('-');

      // Rearrange the parts into the desired format
      var formattedDate = parts[0] + '-' + parts[1] + '-' + parts[2];

      // Update the input value with the new format
      this.value = formattedDate;
    });
  </script>
</html>

<?php
if (isset($_GET['op']) && $_GET['op'] == 'search' && isset($_GET['tag']) && $_GET['tag'] == 'attendance') {
    $program = "";
    if (isset($_SESSION['idL']))
    $id = $_SESSION['idL'];

    if (isset($_GET['program']))
        $program = $_GET['program'];
    
       
?>
    <main id="main" class="main" style="margin-top: -30px;" >
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h5 class="card-title">Schedule</h5> -->
                            <?php

                   

// Query to get the schedule
$sql = "SELECT * FROM `schedule_tbl` 
INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
WHERE ProgramID = $program AND DayWeekName ='Monday' AND schedule_tbl.LecturerID = $id ";
$rs1 = $conn->query($sql);

// Check if there are any results for the schedule query
if ($rs1 && $rs1->num_rows > 0) {
    $rows = mysqli_fetch_assoc($rs1);
    $room = $rows['RoomName'];
} else {
    $room = null; // Set room to null if no results
}

// Query to get the program details
$sql_Pro = "SELECT * FROM `schedule_tbl` 
INNER JOIN program_tbl ON schedule_tbl.ProgramID = program_tbl.ProgramID
INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID
INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID
INNER JOIN batch_tbl ON program_tbl.BatchID = batch_tbl.BatchID
INNER JOIN degree_tbl ON program_tbl.DegreeID = degree_tbl.DegreeID
INNER JOIN major_tbl ON program_tbl.MajorID = major_tbl.MajorID
INNER JOIN faculty_tbl ON program_tbl.FacultyID = faculty_tbl.FacultyID
INNER JOIN academicyear_tbl ON program_tbl.AcademicYearID = academicyear_tbl.AcademicYearID
WHERE schedule_tbl.ProgramID='$program' AND schedule_tbl.LecturerID = $id  ";
$rs = $conn->query($sql_Pro);

if ($rs && $rs->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($rs)) {
        ?>
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <h6>Faculty: <?php echo $row['FacultyEN'] ?></h6>
                <h6>Major: <?php echo $row['MajorEN'] ?></h6>
                <h6>Batch: <?php echo $row['BatchEN'] ?></h6>
                <h6>Day: <?php echo $row['DayWeekName'] ?></h6>
            </div>
            <div class="col-4 text-center">
                <h4>Academic Year: <?php echo $row['AcademicYear'] ?></h4>
            </div>
            <div class="col-4" style="text-align: end;">
                <h6>Year: <?php echo $row['YearEN'] ?></h6>
                <h6>Semester: <?php echo $row['SemesterEN'] ?></h6>
                <h6>Shift: <?php echo $row['ShiftEN'] ?></h6>
                <?php if ($room) { ?>
                    <h6>Room: <?php echo $room ?></h6>
                <?php } ?>
            </div>
        </div>
        <?php
    }
}
?>
                            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container"  >
<div class="row">
	<div class="col-lg-9">
		<div class="main-box clearfix">
        <div class="table-responsive">
    <form method="post" enctype="multipart/form-data">
        <table class="table user-list">
            <thead>
                <tr>
                    <th><span>Student</span></th>
                    <th><span>Gender</span></th>
                    <th><span>AttendNote</span></th>
                    <th><span>Section</span></th>
                    <th><span>Attended</span></th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php
if(isset($_POST['serach_atten'])) {
    $date = $_POST['search_date'];
    if($date != '') {
        // Assuming $program and $id are defined somewhere in your code
        $sqlSearch = "SELECT * FROM `schedule_tbl`
                      INNER JOIN `subject_tbl` ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                      INNER JOIN `time_tbl` ON schedule_tbl.TimeID = time_tbl.TimeID
                      INNER JOIN `lecturer_tbl` ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID
                      INNER JOIN `dayweek_tbl` ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID
                      INNER JOIN `room_tbl` ON schedule_tbl.RoomID = room_tbl.RoomID
                      INNER JOIN `campus_tbl` ON room_tbl.CampusID = campus_tbl.CampusID
                      INNER JOIN `studentstatus_tbl` ON schedule_tbl.ProgramID = studentstatus_tbl.ProgramID
                      INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID
                      INNER JOIN sex_tbl ON studentinfo_tbl.SexID = sex_tbl.SexID
                      INNER JOIN attendance_tbl ON schedule_tbl.LecturerID = attendance_tbl.LecturerID
                      WHERE schedule_tbl.ProgramID = ? AND schedule_tbl.LecturerID = ? AND attendance_tbl.DateIssue = ?
                      ORDER BY studentinfo_tbl.StudentID
                      ";
        
        // Assuming $conn is your database connection object
        $stmt = $conn->prepare($sqlSearch);
        $stmt->bind_param("iis", $program, $id, $date);
        $stmt->execute();
        $rs_list = $stmt->get_result();

        while ($rows = mysqli_fetch_assoc($rs_list)) {
            $studentStatusID = $rows['StudentStatusID'];
            $subjectID1 = $rows['SubjectID'];
?>


<tr>
    <td>
        <img src="../../image/<?php echo $rows['Photo']; ?>" alt="Profile" class="rounded-circle" />
        <a href="#" class="user-link"><?php echo $rows['NameInLatin']; ?></a>
        <span class="user-subhead">Student</span>
    </td>
    <td><?php echo $rows['SexEN']; ?></td>
    <td>
        <input type="text" name="note[<?php echo $studentStatusID; ?>]" value="<?php echo $rows['AttendNote'] ?>" class="form-control" placeholder="Attendance Note">
    </td>
    <td>
       
    <input type="checkbox" name="section[<?php echo $studentStatusID; ?>]" <?php if ($rows['Section'] == 1) echo "checked"; ?> value="1">
       
        <label for="">1</label>
        
        <input type="checkbox" name="section[<?php echo $studentStatusID; ?>]" <?php if ($rows['Section'] == 2) echo "checked"; ?> value="2">
        <label for="">2</label>
    </td>
    <td style="width: 20%;">
        <input type="checkbox" name="status[<?php echo $studentStatusID; ?>][S]" <?php if ($rows['Attended'] == 1) echo "checked"; ?> value="1">
        <label for="">S</label>
        <input type="checkbox" name="status[<?php echo $studentStatusID; ?>][P]" <?php if ($rows['Attended'] == 2) echo "checked"; ?> value="2">
        <label for="">P</label>
        <input type="checkbox" name="status[<?php echo $studentStatusID; ?>][A]" <?php if ($rows['Attended'] == 3) echo "checked"; ?> value="3">
        <label for="">A</label>
    </td>
    <td>
        <p><?php echo $rows['DateIssue'] ?></p>
    </td>
</tr>

                                






</tbody>
                            <?php
                                    }
                            }
                            
                        }
                        
                        else{
                            ?>
                                <tbody>
                <?php
                $sql_att = "SELECT *
                            FROM `schedule_tbl` 
                            INNER JOIN `subject_tbl` ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                            INNER JOIN `time_tbl` ON schedule_tbl.TimeID = time_tbl.TimeID
                            INNER JOIN `lecturer_tbl` ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                            INNER JOIN `dayweek_tbl` ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                            INNER JOIN `room_tbl` ON schedule_tbl.RoomID = room_tbl.RoomID
                            INNER JOIN `campus_tbl` ON room_tbl.CampusID = campus_tbl.CampusID
                            INNER JOIN `studentstatus_tbl` ON schedule_tbl.ProgramID = studentstatus_tbl.ProgramID
                            INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID
                            INNER JOIN sex_tbl ON studentinfo_tbl.SexID = sex_tbl.SexID
                            WHERE 
                            schedule_tbl.ProgramID = $program 
                            AND schedule_tbl.LecturerID = $id";

                $rs_list = $conn->query($sql_att);
                while ($rows = mysqli_fetch_assoc($rs_list)) {
                    $studentStatusID = $rows['StudentStatusID']; // Assuming StudentStatusID is a column in studentstatus_tbl
                    $subjectID1 = $rows['SubjectID']; // Assuming SubjectID is a column in schedule_tbl
                ?>
                    <tr>
                        <td>
                            <img src="../../image/<?php echo $rows['Photo']; ?>" alt="Profile" class="rounded-circle" />
                            <a href="#" class="user-link"><?php echo $rows['NameInLatin']; ?></a>
                            <span class="user-subhead">Student</span>
                        </td>
                        <td><?php echo $rows['SexEN']; ?></td>
                        <td>
                        <div style="display: flex; justify-content: space-between;" class="checkbox-list">
                                <div>
                                    <input type="text" name="note[<?php echo $studentStatusID; ?>]" class="form-control" placeholder="Attendance Note" >
                                    <!-- <label for="">1</label> -->
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; justify-content: space-between;" class="checkbox-list">
                                <div>
                                    <input type="checkbox" name="section[<?php echo $studentStatusID; ?>]" value="1">
                                    <label for="">1</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="section[<?php echo $studentStatusID; ?>]" value="2">
                                    <label for="">2</label>
                                </div>
                            </div>
                        </td>
                        <td style="width: 20%;">
                            <div style="display: flex; justify-content: space-between;" class="checkbox-list">
                                <div>
                                    <input type="checkbox" name="status[<?php echo $studentStatusID; ?>][S]" value="1">
                                    <label for="">S</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="status[<?php echo $studentStatusID; ?>][P]" value="2">
                                    <label for="">P</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="status[<?php echo $studentStatusID; ?>][A]" value="3">
                                    <label for="">A</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
                            <?php } ?>
           
        </table>
        <button class="btn btn-primary" style="float: right;" name="btn_sub">Submit</button>
    </form>
</div>
		</div>
	</div>
                    <div class="col-lg-3" >
                    <form method="post" style="display: flex; gap: 5px; justify-content: space-between; "   >
                            <input type="date" id="dateInput" class="form-control" name="search_date" >
                            <button class="btn btn-primary" name="serach_atten" >Search</button>
                            </form>

                            <div class="qrcode">
    <?php
        // Database connection and selection query
        $sqlQr = "SELECT * FROM `schedule_tbl` 
            INNER JOIN program_tbl ON schedule_tbl.ProgramID = program_tbl.ProgramID
            INNER JOIN studentstatus_tbl ON schedule_tbl.ProgramID = studentstatus_tbl.ProgramID
            INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID
            INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
            WHERE schedule_tbl.ProgramID = $program AND LecturerID = $id";

        $result = mysqli_query($conn, $sqlQr); // Assuming $conn is your connection object

        if ($row = mysqli_fetch_assoc($result)) {
            $LecturerID = $row['LecturerID'];
            $SubjectID = $row['SubjectID'];
            $ProgramID = $row['ProgramID'];

            // Concatenate the data to store in the QR code, ensuring it is URL-safe
            $qrData = "LecturerID=$LecturerID&SubjectID=$SubjectID&ProgramID=$ProgramID";

            // Encode the data to make it URL-safe
            $qrData = urlencode($qrData);

            // Generate the ZXing URL for the QR code
            $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=$qrData&size=300x300";

            // Display the QR code image with a margin-top style
            echo "<img src='$qrCodeUrl' style='margin-top: 10px;' alt='QR Code' />";
        } else {
            echo "No data found";
        }
    ?>
</div>

                    </div>
</div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
    
    
}
?>

<?php

    if (isset($_POST['btn_sub'])) {
        $attendanceDateIssue = date("Y-m-d"); // Current date or a specific date if needed
        $lecturerID = $id; // Assuming $id contains the lecturer's ID
        $subjectID = $subjectID1; // Set this value from your data context
        $success = true;
        foreach ($_POST['status'] as $studentStatusID => $statuses) {
            foreach ($statuses as $statusType => $attended) {
                $attendNote = isset($_POST['note'][$studentStatusID]) ? $_POST['note'][$studentStatusID] : '';
                $section = isset($_POST['section'][$studentStatusID]) ? $_POST['section'][$studentStatusID] : ''; // Retrieve section if checkbox is checked
                $dateIssue = date("Y-m-d"); // Current date and time
    
                // Insert attendance record into attendance_tbl
                $sql_insert = "INSERT INTO attendance_tbl (StudentStatusID, AttendanceDateIssue, SubjectID, Attended, AttendNote, Section, LecturerID, DateIssue)
                               VALUES ('$studentStatusID', '$attendanceDateIssue', '$subjectID', '$attended', '$attendNote', '$section', '$lecturerID', '$dateIssue')";
    
                if(!$conn->query($sql_insert)){
                    $success = false;
                }
            }
        }
    
    if ($success) {
        echo '
        <script>
        $(document).ready(function(){
            swal({
                title: "Success!",
                text: "Set Attendance Success .",
                icon: "success",
                button: "Done",
            }).then(function(){
                window.location.href = window.location.href;
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
                              text: "Set Attendance Success .",
                              icon: "error",
                              button: "Done",
                          });
                      });
                      </script>
                    ';
    }
    }
    
?>