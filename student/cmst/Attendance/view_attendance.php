<?php require('Function.php'); 
$conn = mysqli_connect("localhost","root","","demo_db");
$op = "";
$id = "";
global $conn;
if (isset($_GET['op']))
    $op = $_GET['op'];

// if (isset($_GET['id']))
    $id = $_SESSION['id'];
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
                                <label class="form-label">Subject</label>
                                <select id="lectid" name="academicpro" class="form-select">
                                    <option value="">Select One</option>
                                    <?php getProgram(); ?>
                                </select>
                            </div>
                            
                            <div class="col-2">
                                <a id="searchBtn" style="margin-top: 30px;" href="#" class="btn btn-primary">Search</a>
                            </div>
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
        var lectid = document.getElementById('lectid').value;
        
        // Construct the URL with the selected values
        var url = '?tag=stu_atten&op=search';
        url += '&lectid=' + encodeURIComponent(lectid);
        
        window.location.href = url;
    });
</script>
</html>

<?php
if (isset($_GET['op']) && $_GET['op'] == 'search' && isset($_GET['tag']) && $_GET['tag'] == 'stu_atten') {
    $lectid = "";
    if (isset($_SESSION['id']))
    $stuId = $_SESSION['id'];

    $sql_status = "SELECT * FROM `studentstatus_tbl` WHERE StudentID=$stuId";
    $rss = $conn->query($sql_status);
    $rows = mysqli_fetch_assoc($rss);
    $statusId = $rows['StudentStatusID'];

    if (isset($_GET['lectid']))
        $lectid = $_GET['lectid'];
    
       
?>
    <main id="main" class="main" style="margin-top: -30px;" >
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                         
                            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container"  >
<div class="row">
	<div class="col-lg-12">
		<div class="main-box clearfix">
        <div class="table-responsive">
        <table class="table user-list">
            <thead>
                <tr>
                    <!-- <th><span>AttendanceID</span></th>
                    <th><span>StudentStatusID</span></th> -->
                    <th class="text-center"><span>Subject</span></th>
                    <th><span>Attended</span></th>
                    <th><span>AttendNote</span></th>
                    <th><span>Section</span></th>
                    <th><span>LecturerID</span></th>
                    <th><span>AttendanceDateIssue</span></th>
                    <th><span>DateIssue</span></th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_att = "SELECT * FROM `attendance_tbl` 
                    INNER JOIN lecturer_tbl ON attendance_tbl.LecturerID = lecturer_tbl.LecturerID
                    INNER JOIN subject_tbl ON attendance_tbl.SubjectID = subject_tbl.SubjectID
                    INNER JOIN studentstatus_tbl ON attendance_tbl.StudentStatusID = studentstatus_tbl.StudentStatusID
                    INNER JOIN program_tbl ON studentstatus_tbl.ProgramID = program_tbl.ProgramID
                    WHERE attendance_tbl.LecturerID=$lectid AND attendance_tbl.StudentStatusID=$statusId ";

                $rs_list = $conn->query($sql_att);
                while ($rows = mysqli_fetch_assoc($rs_list)) {
                   
                ?>
                    <tr>
                        <td>
                        <span class="label label-default"><?php echo $rows['SubjectEN']; ?></span>
                        </td>
                        <td>
                        <span class="label label-default"><?php echo $rows['Attended']; ?></span>
                        </td>
                        <td>
                        <span class="label label-default"><?php echo $rows['AttendNote']; ?></span>
                        </td>
                        <td>
                        <span class="label label-default"><?php echo $rows['Section']; ?></span>
                        </td>
                        <td>
                        <span class="label label-default"><?php echo $rows['LecturerID']; ?></span>
                        </td>
                        <td>
                        <span class="label label-default"><?php echo $rows['AttendanceDateIssue']; ?></span>
                        </td>
                        <td>
                        <span class="label label-default"><?php echo $rows['DateIssue']; ?></span>
                        </td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
</div>

			
		</div>
	</div>
</div>
</div>
                           <!-- End Of Templete -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
    
    
}
?>

