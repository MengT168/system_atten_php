<?php
    require("./connect.php");
    $op = "";
    $id="";
    $id1="";
    if(isset($_GET[ 'id']))
    $id=$_GET['id'];
  
    global $conn;
    if (isset($_GET['op']))
        $op = $_GET['op'];
    
  

        if ($op == 'del') {
            $del = "DELETE FROM schedule_tbl WHERE ScheduleID=$id1";
            $exec = mysqli_query($conn, $del);
            if ($exec)
               {
                echo '
                <script>
                $(document).ready(function(){
                    swal({
                        title: "Success!",
                        text: "Detete Success",
                        icon: "success",
                        button: "Done",
                    });
                });
                </script>
                ';
               }
            else
            echo '
            <script>
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Detete Success",
                    icon: "error",
                    button: "Done",
                });
            });
            </script>
            ';
        }
?>

<!DOCTYPE html>
<?php require('Function.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<script>
function updateTime(daytxt) {
    $.ajax({
        url: 'Fetch.php',
        type: 'POST',
        data: { daytxt: daytxt },
        success: function(response) {
            $('select[name="timetxt"]').html(response);
        },
        error: function() {
            alert('Error fetching majors');
        }
    });
}
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function updateProgram(programtxt) {
    $.ajax({
        url: 'fetch_programs.php',
        type: 'POST',
        data: { programID: programtxt },
        success: function(response) {
            $('select[name="subjecttxt"]').html(response);
        },
        error: function() {
            alert('Error fetching programs');
        }
    });
}
function updateRoom(campusID) {
    $.ajax({
        url: 'fetch_rooms.php',
        type: 'POST',
        data: { campusID: campusID },
        success: function(response) {
            $('select[name="roomtxt"]').html(response);
        },
        error: function() {
            alert('Error fetching rooms');
        }
    });
}
</script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
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
<body>
<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Schedule</h5>
                        <div class="row g-2">
                            <div class="col-3">
                                <label class="form-label">Program</label>
                                <select id="program" name="academicpro" class="form-select">
                                    <option value="">Select One</option>
                                    <?php getProgram(); ?>
                                </select>
                            </div>
                            <div class="col-2">
                                <a id="searchBtn" style="margin-top: 20px;" href="#" class="btn btn-primary">Search</a>
                                <button type="button" style="margin-top: 27px;" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Create
                                </button>
                            </div>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Program</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="card-title">Program Form</h5>

                            <!-- Vertical Form -->
                            <form method="post" enctype="multipart/form-data">

                            <div class="row mb-3">
                    <label for="inputPassword4" class="form-label"
                      >Program</label
                    >
                    <select name="programtxt" id="programSelect" class="form-select" onchange="updateProgram(this.value)" >
                        <option value="">Select One</option>
                    <?php getProgram(); ?>
                </select>
                  </div>

                  <div class="row mb-3">
                  
                    <label  class="form-label"
                      >Subject</label
                    >
                    <select name="subjecttxt" class="form-select" ">
                  <option value="">Select One</option>
                  <!-- <?php getSubject(); ?> -->
                </select>
                  
                  </div>
                 
                  <div class="row mb-3">
                  <div class="col-md-4 col-lg-3">
                    <label for="inputPassword4" class="form-label"
                      >Lecturer</label
                    >
                  </div>
                    <select name="lecturetxt"  class="form-select" >
                    <option value="">Select One</option>
                    <?php getLecture(); ?>
                    </select>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword4" class="form-label"
                      >Day</label
                    >
                    <select name="daytxt"  class="form-select" onchange="updateTime(this.value)" >
                    <option value="">Select One</option>
                    <?php getDay(); ?>
                    </select>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword4" class="form-label"
                      >Time</label
                    >
                    <select name="timetxt"  class="form-select" >
                   
                    </select>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword4" class="form-label"
                      >Room</label
                    >
                    <select name="roomtxt"  class="form-select" >
                    <option value="">Select One</option>
                    <?php getRoom(); ?>
                    </select>
                  </div>
                  
                  <div class="row mb-3">
                    <label for="inputPassword4" class="form-label"
                      >Schedule Date</label
                    >
                    <input
                      type="date"
                      class="form-control"
                      name="scheduleDate"
                      id="dateInput"
                    />
                  </div>
                  
                  
                  <div class="text-center">
                    <input type="submit" name="btn_sub" class="btn btn-primary">
                      
                    </input>
                    <input type="reset" class="btn btn-secondary">
                     
                    </input>
                  </div>
                            </form>
                        </div>


                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
                           
                        </div>
                        <!-- Schedule -->
                        
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
        var url = '?tag=view_schedule2&op=search';
        url += '&program=' + encodeURIComponent(program);
        
        window.location.href = url;
    });
</script>

</html>

<?php
if (isset($_GET['op']) && $_GET['op'] == 'search' && isset($_GET['tag']) && $_GET['tag'] == 'view_schedule2') {
    $program = "";

    if (isset($_GET['program']))
        $program = $_GET['program'];
    
        $shiftCheckSql = "SELECT shift_tbl.shiftEN FROM program_tbl
        INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID
        WHERE program_tbl.ProgramID = $program AND shift_tbl.shiftEN = 'Morning'";
$shiftCheckResult = $conn->query($shiftCheckSql);

if ($shiftCheckResult->num_rows > 0) {
?>
    <main id="main" class="main">
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
WHERE ProgramID = $program AND DayWeekName ='Monday'";
$rs1 = $conn->query($sql);

// Check if there are any results for the schedule query
if ($rs1 && $rs1->num_rows > 0) {
    $rows = mysqli_fetch_assoc($rs1);
    $room = $rows['RoomName'];
} else {
    $room = null; // Set room to null if no results
}

// Query to get the program details
$sql_Pro = "SELECT * FROM program_tbl 
INNER JOIN faculty_tbl ON program_tbl.FacultyID = faculty_tbl.FacultyID
INNER JOIN major_tbl ON program_tbl.MajorID = major_tbl.MajorID
INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
INNER JOIN academicyear_tbl ON program_tbl.AcademicYearID = academicyear_tbl.AcademicYearID
INNER JOIN batch_tbl ON program_tbl.BatchID = batch_tbl.BatchID
INNER JOIN campus_tbl ON program_tbl.CampusID = campus_tbl.CampusID
INNER JOIN degree_tbl ON program_tbl.DegreeID = degree_tbl.DegreeID
INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID 
WHERE ProgramID='$program'";
$rs = $conn->query($sql_Pro);

// Check if there are any results for the program query
if ($rs && $rs->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($rs)) {
        ?>
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <h6>Faculty: <?php echo $row['FacultyEN'] ?></h6>
                <h6>Major: <?php echo $row['MajorEN'] ?></h6>
                <h6>Batch: <?php echo $row['BatchEN'] ?></h6>
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

                            <!-- Schedule -->
                            <div class="container">
                                <div class="timetable-img text-center">
                                    <img src="img/content/timetable.png" alt="">
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr class="bg-light-gray">
                                                <th class="text-uppercase">Time</th>
                                                <th class="text-uppercase">Monday</th>
                                                <th class="text-uppercase">Tuesday</th>
                                                <th class="text-uppercase">Wednesday</th>
                                                <th class="text-uppercase">Thursday</th>
                                                <th class="text-uppercase">Friday</th>
                                                <th class="text-uppercase">Saturday</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="align-middle">8:00->9:30(AM)</td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Monday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>

                                                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Tuesday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal12">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal12" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Wednesday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal123">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal123" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Thursday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1234">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal1234" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Friday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal13">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal13" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-pink padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">English</span>
                                                    <div class="margin-10px-top font-size14">9:00-10:00</div>
                                                    <div class="font-size13 text-light-gray">James Smith</div> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle">9:30->9:45(AM)</td>
                                                <td>
                                                    <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td class="bg-light-gray">
                                                <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td class="bg-light-gray">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle">9:45->11:15(AM)</td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Monday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Tuesday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Wednesday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Thursday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Friday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-lightred padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Break</span>
                                                    <div class="margin-10px-top font-size14">11:00-12:00</div> -->
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
    $shiftCheckSql = "SELECT shift_tbl.shiftEN FROM program_tbl
    INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID
    WHERE program_tbl.ProgramID = $program AND shift_tbl.shiftEN = 'Afternoon'";
$shiftCheckResult = $conn->query($shiftCheckSql);
    if($shiftCheckResult->num_rows > 0) {
?>
    <main id="main" class="main">
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
WHERE ProgramID = $program AND DayWeekName ='Monday'";
$rs1 = $conn->query($sql);

// Check if there are any results for the schedule query
if ($rs1 && $rs1->num_rows > 0) {
    $rows = mysqli_fetch_assoc($rs1);
    $room = $rows['RoomName'];
} else {
    $room = null; // Set room to null if no results
}

// Query to get the program details
$sql_Pro = "SELECT * FROM program_tbl 
INNER JOIN faculty_tbl ON program_tbl.FacultyID = faculty_tbl.FacultyID
INNER JOIN major_tbl ON program_tbl.MajorID = major_tbl.MajorID
INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
INNER JOIN academicyear_tbl ON program_tbl.AcademicYearID = academicyear_tbl.AcademicYearID
INNER JOIN batch_tbl ON program_tbl.BatchID = batch_tbl.BatchID
INNER JOIN campus_tbl ON program_tbl.CampusID = campus_tbl.CampusID
INNER JOIN degree_tbl ON program_tbl.DegreeID = degree_tbl.DegreeID
INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID 
WHERE ProgramID='$program'";
$rs = $conn->query($sql_Pro);

// Check if there are any results for the program query
if ($rs && $rs->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($rs)) {
        ?>
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <h6>Faculty: <?php echo $row['FacultyEN'] ?></h6>
                <h6>Major: <?php echo $row['MajorEN'] ?></h6>
                <h6>Batch: <?php echo $row['BatchEN'] ?></h6>
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

                            <!-- Schedule -->
                            <div class="container">
                                <div class="timetable-img text-center">
                                    <img src="img/content/timetable.png" alt="">
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr class="bg-light-gray">
                                                <th class="text-uppercase">Time</th>
                                                <th class="text-uppercase">Monday</th>
                                                <th class="text-uppercase">Tuesday</th>
                                                <th class="text-uppercase">Wednesday</th>
                                                <th class="text-uppercase">Thursday</th>
                                                <th class="text-uppercase">Friday</th>
                                                <th class="text-uppercase">Saturday</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="align-middle">2:00->3:30(PM)</td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Monday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal13">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal13" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Tuesday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal14">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal14" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Wednesday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal16">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal16" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Thursday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal17">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal17" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Friday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal18">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal18" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-pink padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">English</span>
                                                    <div class="margin-10px-top font-size14">9:00-10:00</div>
                                                    <div class="font-size13 text-light-gray">James Smith</div> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle">3:30->3:45(PM)</td>
                                                <td>
                                                    <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td class="bg-light-gray">
                                                <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td class="bg-light-gray">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle">3:45->5:15(PM)</td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Monday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Tuesday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Wednesday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Thursday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Friday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-lightred padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Break</span>
                                                    <div class="margin-10px-top font-size14">11:00-12:00</div> -->
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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

$shiftCheckSql = "SELECT shift_tbl.shiftEN FROM program_tbl
INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID
WHERE program_tbl.ProgramID = $program AND shift_tbl.shiftEN = 'Evening'";
$shiftCheckResult = $conn->query($shiftCheckSql);
if($shiftCheckResult->num_rows > 0)
{
?>
<main id="main" class="main">
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
WHERE ProgramID = $program AND DayWeekName ='Monday'";
$rs1 = $conn->query($sql);

// Check if there are any results for the schedule query
if ($rs1 && $rs1->num_rows > 0) {
    $rows = mysqli_fetch_assoc($rs1);
    $room = $rows['RoomName'];
} else {
    $room = null; // Set room to null if no results
}

// Query to get the program details
$sql_Pro = "SELECT * FROM program_tbl 
INNER JOIN faculty_tbl ON program_tbl.FacultyID = faculty_tbl.FacultyID
INNER JOIN major_tbl ON program_tbl.MajorID = major_tbl.MajorID
INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
INNER JOIN academicyear_tbl ON program_tbl.AcademicYearID = academicyear_tbl.AcademicYearID
INNER JOIN batch_tbl ON program_tbl.BatchID = batch_tbl.BatchID
INNER JOIN campus_tbl ON program_tbl.CampusID = campus_tbl.CampusID
INNER JOIN degree_tbl ON program_tbl.DegreeID = degree_tbl.DegreeID
INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID 
WHERE ProgramID='$program'";
$rs = $conn->query($sql_Pro);

// Check if there are any results for the program query
if ($rs && $rs->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($rs)) {
        ?>
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <h6>Faculty: <?php echo $row['FacultyEN'] ?></h6>
                <h6>Major: <?php echo $row['MajorEN'] ?></h6>
                <h6>Batch: <?php echo $row['BatchEN'] ?></h6>
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

                            <!-- Schedule -->
                            <div class="container">
                                <div class="timetable-img text-center">
                                    <img src="img/content/timetable.png" alt="">
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr class="bg-light-gray">
                                                <th class="text-uppercase">Time</th>
                                                <th class="text-uppercase">Monday</th>
                                                <th class="text-uppercase">Tuesday</th>
                                                <th class="text-uppercase">Wednesday</th>
                                                <th class="text-uppercase">Thursday</th>
                                                <th class="text-uppercase">Friday</th>
                                                <th class="text-uppercase">Saturday</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="align-middle">05:30->6:40(PM)</td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Monday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal11">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal11" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Tuesday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal111">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal111" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Wednesday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal122">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal122" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Thursday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal144">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal144" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Friday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal133">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal133" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule2&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule22&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-pink padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">English</span>
                                                    <div class="margin-10px-top font-size14">9:00-10:00</div>
                                                    <div class="font-size13 text-light-gray">James Smith</div> -->
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle">6:40->6:55(PM)</td>
                                                <td>
                                                    <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td class="bg-light-gray">
                                                <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-yellow padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Music</span> -->
                                                    <div class="margin-10px-top font-size14">BREAK</div>
                                                </td>
                                                <td class="bg-light-gray">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="align-middle">6:55->08:30(PM)</td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Monday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Tuesday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Wednesday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Thursday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                <?php
                                                $sql = "SELECT * FROM `schedule_tbl` 
                                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                                WHERE ProgramID = $program AND DayWeekName ='Friday' ";
                                                $rs=$conn->query($sql);
                                                while($rw = mysqli_fetch_assoc($rs)){
                                            ?>
                                                     <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13"><?php echo $rw['SubjectEN'] ?></span>
                                                    <div class="margin-10px-top font-size14"><?php echo $rw['RoomName'] ?>/<?php echo $rw['CampusEN'] ?></div>
                                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                                <?php } ?>
                                                </td>
                                                <td>
                                                    <!-- <span class="bg-lightred padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16  xs-font-size13">Break</span>
                                                    <div class="margin-10px-top font-size14">11:00-12:00</div> -->
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
}
if($op == 'edit'){


   

    $sql = "SELECT * FROM schedule_tbl WHERE ScheduleID = $id";
    $rs = $conn->query($sql);
    while($row=mysqli_fetch_assoc($rs)){
?>



<main id="main" class="main">
      <!-- <div class="pagetitle">
        <h1>STUDENT</h1>
        
      </div> -->
      <!-- End Page Title -->
      <section class="section">
        <div class="row">
          <div class="col-lg-10">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Schedule</h5>

                <!-- Vertical Form -->
                <form class="row g-3" method="post" enctype="multipart/form-data" >
                  <div class="col-12">
                    <label  class="form-label"
                      >Subject</label
                    >
                    <select name="subjecttxt" onchange="updateProgram(this.value)"  class="form-select" >
                       <?php 
                            $sql = "SELECT * FROM subject_tbl ORDER BY SubjectID ";
                            $rs=$conn->query($sql);
                            while($rw = mysqli_fetch_assoc($rs)){
                        ?>
                        <option value="<?php echo $rw['SubjectID'] ?>" <?php if($rw['SubjectID']== $row['SubjectID']) echo 'selected' ?> >
                           <?php echo $rw['SubjectEN'] ?>     
                        </option>

                    <?php } ?>
                    </select>
                  </div>
                 
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Lecturer</label
                    >
                    <select name="lecturetxt"  class="form-select" >
                       <?php 
                            $sql = "SELECT * FROM lecturer_tbl ORDER BY LecturerID ";
                            $rs=$conn->query($sql);
                            while($rw = mysqli_fetch_assoc($rs)){
                        ?>
                        <option value="<?php echo $rw['LecturerID'] ?>" <?php if($rw['LecturerID']== $row['LecturerID']) echo 'selected' ?> >
                           <?php echo $rw['LecturerName'] ?>     
                        </option>

                    <?php } ?>
                    </select>
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Day</label
                    >
                    <select name="daytxt"  class="form-select" onchange="updateTime(this.value)" >
                    <?php 
                            $sql = "SELECT * FROM `dayweek_tbl` 
                            INNER JOIN shift_tbl ON dayweek_tbl.ShiftID = shift_tbl.ShiftID ORDER BY DayWeekID ";
                            $rs=$conn->query($sql);
                            while($rw = mysqli_fetch_assoc($rs)){
                        ?>
                        <option value="<?php echo $rw['DayWeekID'] ?>" <?php if($rw['DayWeekID']== $row['DayWeekID']) echo 'selected' ?> >
                           <?php echo $rw['DayWeekName'] ?>--<?php echo $rw['ShiftEN'] ?>    
                        </option>

                    <?php } ?>
                    </select>
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Time</label
                    >
                    <select name="timetxt"  class="form-select" >
                    <?php 
                            $sql = "SELECT * FROM `time_tbl` ORDER BY TimeID";
                            $rs=$conn->query($sql);
                            while($rw = mysqli_fetch_assoc($rs)){
                        ?>
                        <option value="<?php echo $rw['TimeID'] ?>" <?php if($rw['TimeID']== $row['TimeID']) echo 'selected' ?> >
                           <?php echo $rw['TimeName'] ?>
                        </option>

                    <?php } ?>
                    </select>
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Room</label
                    >
                    <select name="roomtxt"  class="form-select" >
                    <?php 
                            $sql = "SELECT * FROM `room_tbl` 
                            INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID ORDER BY RoomID";
                            $rs=$conn->query($sql);
                            while($rw = mysqli_fetch_assoc($rs)){
                        ?>
                        <option value="<?php echo $rw['RoomID'] ?>" <?php if($rw['RoomID']== $row['RoomID']) echo 'selected' ?> >
                           <?php echo $rw['RoomName'] ?>--<?php echo $rw['CampusKH'] ?>
                        </option>

                    <?php } ?>
                    
                    </select>
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Program</label
                    >
                    <select name="programtxt"  class="form-select" >
                    <?php 
                            $sql = "SELECT * FROM program_tbl 
                            INNER JOIN faculty_tbl ON program_tbl.FacultyID = faculty_tbl.FacultyID
                            INNER JOIN major_tbl ON program_tbl.MajorID = major_tbl.MajorID
                            INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
                            INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
                            INNER JOIN academicyear_tbl ON program_tbl.AcademicYearID = academicyear_tbl.AcademicYearID
                            INNER JOIN batch_tbl ON program_tbl.BatchID = batch_tbl.BatchID
                            INNER JOIN campus_tbl ON program_tbl.CampusID = campus_tbl.CampusID
                            INNER JOIN degree_tbl ON program_tbl.DegreeID = degree_tbl.DegreeID
                            INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID";
                            $rs=$conn->query($sql);
                            while($rw = mysqli_fetch_assoc($rs)){
                                $ProgramID= $rw['ProgramID'];
                                $yearId = $rw['YearEN'];
                                $semesterId = $rw['SemesterEN'];
                                $majorId = $rw['MajorId'];
                                $batchId = $rw['BatchEN'];
                                $campusId = $rw['CampusEN'];
                                $degreeId = $rw['DegreeNameEN'];
                                $shiftId = $rw['ShiftEN'];
                                $acadId = $rw['AcademicYear'];
                        ?>
                        <option value="<?php echo $rw['ProgramID'] ?>" <?php if($rw['ProgramID']== $row['ProgramID']) echo 'selected' ?> >
                           <?php echo $yearId ?>--<?php echo $semesterId ?>--<?php echo $majorId ?>--<?php echo $batchId ?>
                           --<?php echo $campusId ?>--<?php echo $degreeId ?>--<?php echo $shiftId ?>--<?php echo $acadId ?>
                        </option>

                    <?php } ?>
                    </select>
                  </div>
                  
                  
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Start Date</label
                    >
                    <input
                      type="date"
                      class="form-control"
                      name="startDate"
                      id="dateInput"
                      value="<?php echo $row['DateStart'] ?>"
                    />
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >End Date</label
                    >
                    <input
                      type="date"
                      class="form-control"
                      name="endDate"
                      id="dateInput"
                      value="<?php echo $row['DateEnd'] ?>"
                    />
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Schedule Date</label
                    >
                    <input
                      type="date"
                      class="form-control"
                      name="scheduleDate"
                      id="dateInput"
                      value="<?php echo $row['ScheduleDate'] ?>"
                    />
                  </div>
                  
                  
                  <div class="text-center">
                    <!-- <input type="submit" name="btn_Up" value="Update" class="btn btn-success"> -->
                    <button name="btn_Up" class="btn btn-success" >Update</button>
                   
                    <a  class="btn btn-primary" href="javascript:history.go(-1)" >Back</a>
                    
                  </div>
                </form>
                <!-- Vertical Form -->
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

<?php

    }
}

    
?>
<?php
     if(isset($_POST['btn_Up'])){
      $subjecttxt=$_POST['subjecttxt'];
      $lecturetxt=$_POST['lecturetxt'];
      $daytxt = $_POST['daytxt'];
      $timetxt=$_POST['timetxt'];
      $roomtxt = $_POST['roomtxt'];
      $programtxt =  $_POST['programtxt'];
      $startDate=$_POST['startDate'];
      $endDate = $_POST['endDate'];
      $scheduleDate =  $_POST['scheduleDate'];

      $query = "SELECT * FROM `schedule_tbl` WHERE `SubjectID`='$subjecttxt' AND `LecturerID`='$lecturetxt' AND `DayWeekID`='$daytxt' AND `RoomID`='$roomtxt' AND 'ProgramID' = '$programtxt'";
      $result = $conn->query($query);
      
      if (!empty($subjecttxt) && !empty($lecturetxt) && !empty($daytxt) && !empty($timetxt) && !empty($roomtxt) && !empty($programtxt) && !empty($startDate) && !empty($endDate) && !empty($scheduleDate)) {
            
        $queryProgramCheck = "SELECT * FROM studentstatus_tbl WHERE ProgramID = '$programtxt'";
            $resultProgramCheck = $conn->query($queryProgramCheck);
            if ($resultProgramCheck->num_rows == 0) {
                echo '
                <script>
                $(document).ready(function(){
                    swal({
                        title: "Error!",
                        text: "Program dont`t have student assign",
                        icon: "error",
                        button: "Done",
                    });
                });
                </script>
                ';
                return;
                    }

        // Fetch shiftID for the selected day
        $queryDay = "SELECT ShiftID FROM dayweek_tbl WHERE DayWeekID = '$daytxt'";
        $resultDay = $conn->query($queryDay);
        $dayShiftID = ($resultDay->num_rows > 0) ? $resultDay->fetch_assoc()['ShiftID'] : null;

        // Fetch shiftID for the selected program
        $queryProgram = "SELECT ShiftID FROM program_tbl WHERE ProgramID = '$programtxt'";
        $resultProgram = $conn->query($queryProgram);
        $programShiftID = ($resultProgram->num_rows > 0) ? $resultProgram->fetch_assoc()['ShiftID'] : null;

        if ($dayShiftID === $programShiftID) {
            $query = "SELECT * FROM `schedule_tbl` WHERE `SubjectID`='$subjecttxt' AND `LecturerID`='$lecturetxt' AND `DayWeekID`='$daytxt' AND `RoomID`='$roomtxt'";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                echo '
                <script>
                $(document).ready(function(){
                    swal({
                        title: "Error!",
                        text: "Combination already exists",
                        icon: "error",
                        button: "Done",
                    });
                });
                </script>
                ';
            } else {
                $query = "SELECT * FROM `schedule_tbl` WHERE `SubjectID`='$subjecttxt' AND `LecturerID`='$lecturetxt' AND `DayWeekID`='$daytxt' AND `RoomID`='$roomtxt'";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    echo '
                    <script>
                    $(document).ready(function(){
                        swal({
                            title: "Error!",
                            text: "Combination exists with a different Room",
                            icon: "error",
                            button: "Done",
                        });
                    });
                    </script>
                    ';
                } else {
                    $query = "SELECT * FROM `schedule_tbl` WHERE `SubjectID`='$subjecttxt' AND `LecturerID`='$lecturetxt' AND `DayWeekID`='$daytxt' AND `RoomID`='$roomtxt'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        echo '
                        <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error!",
                                text: "Combination exists with a different Subject",
                                icon: "error",
                                button: "Done",
                            });
                        });
                        </script>
                        ';
                    } else {
                        $query = "SELECT * FROM `schedule_tbl` WHERE `SubjectID`<>'$subjecttxt' AND `LecturerID`='$lecturetxt' AND `DayWeekID`='$daytxt' AND `RoomID`<>'$roomtxt'";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            echo '
                            <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Error!",
                                    text: "Combination exists with a different Subject and different Room",
                                    icon: "error",
                                    button: "Done",
                                });
                            });
                            </script>
                            ';
                        } else {
                            $query = "SELECT * FROM `schedule_tbl` WHERE `SubjectID`='$subjecttxt' AND `LecturerID`='$lecturetxt' AND `DayWeekID`='$daytxt' AND `TimeID`='$timetxt' AND `RoomID`='$roomtxt'";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                echo '
                                <script>
                                $(document).ready(function(){
                                    swal({
                                        title: "Error!",
                                        text: "Combination exists with a different Lecture",
                                        icon: "error",
                                        button: "Done",
                                    });
                                });
                                </script>
                                ';
                            } else{
                                $query = "SELECT * FROM `schedule_tbl` WHERE `SubjectID`<>'$subjecttxt' AND `LecturerID`<>'$lecturetxt' AND `DayWeekID`='$daytxt' AND `TimeID`='$timetxt' AND `RoomID`='$roomtxt'";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    echo '
                                    <script>
                                    $(document).ready(function(){
                                        swal({
                                            title: "Error!",
                                            text: "Combination exists with a different Subject, different Lecturer, same Day, same Time, and same Room",
                                            icon: "error",
                                            button: "Done",
                                        });
                                    });
                                    </script>
                                    ';
                                } else {
                                    $update = "UPDATE `schedule_tbl` SET `SubjectID`='$subjecttxt',`LecturerID`='$lecturetxt',`DayWeekID`='$daytxt',`TimeID`='$timetxt',`RoomID`='$roomtxt',`ProgramID`='$programtxt',`DateStart`='$startDate',`DateEnd`='$endDate',`ScheduleDate`='$scheduleDate' WHERE ScheduleID = $id";
                                    if ($conn->query($update) === TRUE) {
                                        echo '
                                        <script>
                                        $(document).ready(function(){
                                            swal({
                                                title: "Success!",
                                                text: "Record Updated successfully",
                                                icon: "success",
                                                button: "Done",
                                            }).then(function() {
                                                window.history.back();
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
                                                text: "Failed to Update record",
                                                icon: "error",
                                                button: "Done",
                                            });
                                        });
                                        </script>
                                        ';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            echo '
            <script>
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Shift mismatch between selected day and program",
                    icon: "error",
                    button: "Done",
                });
            });
            </script>
            ';
        }
    } else {
        echo '
        <script>
        $(document).ready(function(){
            swal({
                title: "Error!",
                text: "Please fill in all required fields",
                icon: "error",
                button: "Done",
            });
        });
        </script>
        ';
    }

}
?>
