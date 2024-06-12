<?php 

    require("./connect.php"); 
    $op="";
    $id="";
    $id1="";
    global $conn;
    if(isset($_GET[ 'op']))
    $op=$_GET['op'];

    if(isset($_GET[ 'id']))
    $id=$_GET['id'];

    if(isset($_GET[ 'id1']))
    $id1=$_GET['id1'];

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
function updateTime(daytxt) {
    $.ajax({
        url: 'FetchUpdate.php',
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
<script>
function updateProgram(subjecttxt) {
    $.ajax({
        url: 'fetch_programs.php',
        type: 'POST',
        data: { subjectID: subjecttxt },
        success: function(response) {
            $('select[name="programtxt"]').html(response);
        },
        error: function() {
            alert('Error fetching programs');
        }
    });
}
</script>

</head>
<body>
    <?php require('Function.php'); ?>
<?php
if ($op == 'view') {
    $sql_view = "SELECT * FROM schedule_tbl WHERE LecturerID=$id ";
    $exec = mysqli_query($conn, $sql_view);
?>

<main id="main" class="main" >
    <div class="pagetitle">
    
        <h1>Schedule</h1>
        <div class="row" >
        <div class="col-3">
            <label class="form-label">Select Program</label>
                <select id="program" name="academicpro" class="form-select">
                    <option value="">Select One</option>
                    <?php getProgram(); ?>
                </select>
        </div>
        <div class="col-3" >
        <a id="searchBtn" style="margin-top: 30px;" href="#" class="btn btn-primary">Search</a>
        <a href="?tag=view_schedule" class="btn btn-primary" style=" margin-top: 30px; " >Back</a>
        </div>
        </div>
        
        <script>
    document.getElementById('searchBtn').addEventListener('click', function(event) {
        event.preventDefault(); 

        // Get the selected values
        var program = document.getElementById('program').value;

// Get the current ID from the URL
            var urlParams = new URLSearchParams(window.location.search);
            var id = urlParams.get('id');

            // Construct the URL with the selected values and the id
            var url = '?tag=view_schedule&op=search';
            url += '&program=' + encodeURIComponent(program);
            if (id) {
                url += '&id=' + encodeURIComponent(id);
            }

            window.location.href = url;
    });
</script>
    </div>
</main>
    <?php } 
        elseif(isset($_GET['op']) && $_GET['op'] == 'search' && isset($_GET['tag']) && $_GET['tag'] == 'view_schedule'){
            $program="";
            $id="";
        
            if (isset($_GET['program']))
                $program = $_GET['program'];
        
            if (isset($_GET['id']))
                $id = $_GET['id'];
    ?>

    <!-- End Page Title -->
    <main id="main" class="main" >
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card"  >
                    <div class="card-body"  >
                    <!-- <h5 class="card-title">Schedule</h5> -->
                    <div>
                        <?php
                            $sql="SELECT * FROM `schedule_tbl` 
                            INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                            INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                            INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                            INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID
                            INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                            INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                            INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                            INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                            INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                            WHERE lecturer_tbl.LecturerID=$id" ;
                              $rs=$conn->query($sql);
                              while($rw = mysqli_fetch_assoc($rs)){
                                $FacultyEN = $rw['FacultyEN'];
                                $YearEn = $rw['YearEN'];
                                $Semester = $rw['SemesterEN'];
                              }
                        ?>
                        <!-- <h5>Faculty Of : <?php echo $FacultyEN ?></h5> -->
                       
                       <!-- <h5><?php echo $YearEn ?></h5> -->
                        <!-- <h5><?php echo $Semester ?></h5> -->
                       
                              </div>
                    <div class="container">
                <div class="timetable-img text-center">
                    <img src="img/content/timetable.png" alt="">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr class="bg-light-gray">
                                <th class="text-uppercase">Time
                                </th>
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
                                <div>
                               
                                <td class="align-middle">08:00->11:15(AM)</td>
                                <td>
                                <?php
                                $sql = "SELECT * FROM `schedule_tbl` 
                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID
                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID WHERE lecturer_tbl.LecturerID=$id AND TimeName = '8:00->11:15(AM)' AND DayWeekName ='Monday' AND ProgramID =$program ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
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
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '8:00->11:15(AM)' AND DayWeekName ='Tuesday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                     <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
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
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '8:00->11:15(AM)' AND DayWeekName ='Wednesday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
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
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '8:00->11:15(AM)' AND DayWeekName ='Thursday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
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
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '8:00->11:15(AM)' AND DayWeekName ='Friday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                    <?php } ?>
                                </td>
                                <td>
                                   
                                </td>
                            </tr>

                            <tr>
                                <td class="align-middle">02:00->5:15(PM)</td>
                                <td>
                                <?php
                                $sql = "SELECT * FROM `schedule_tbl` 
                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '2:00->5:15(PM)' AND DayWeekName ='Monday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
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
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '2:00->5:15(PM)' AND DayWeekName ='Tuesday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
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
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '2:00->5:15(PM)' AND DayWeekName ='Wednesday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
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
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '2:00->5:15(PM)' AND DayWeekName ='Thursday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
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
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '2:00->5:15(PM)' AND DayWeekName ='Friday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                    <?php } ?>
                                </td>
                                <td class="bg-light-gray">

                                </td>
                            </tr>

                            <tr>
                                <td class="align-middle">05:30->08:30(PM)</td>
                                <td>
                                <?php
                                $sql = "SELECT * FROM `schedule_tbl` 
                                INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                                INNER JOIN time_tbl ON schedule_tbl.TimeID = time_tbl.TimeID
                                INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID 
                                INNER JOIN dayweek_tbl ON schedule_tbl.DayWeekID = dayweek_tbl.DayWeekID 
                                INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                INNER JOIN campus_tbl ON room_tbl.CampusID = campus_tbl.CampusID
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '5:30->8:30(PM)' AND DayWeekName ='Monday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
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
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '5:30->8:30(PM)' AND DayWeekName ='Tuesday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
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
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '5:30->8:30(PM)' AND DayWeekName ='Wednesday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
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
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '5:30->8:30(PM)' AND DayWeekName ='Thursday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
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
                                INNER JOIN faculty_tbl ON subject_tbl.FacultyID = faculty_tbl.FacultyID
                                INNER JOIN year_tbl ON subject_tbl.YearID = year_tbl.YearID 
                                INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                WHERE lecturer_tbl.LecturerID=$id AND TimeName = '5:30->8:30(PM)' AND DayWeekName ='Friday' AND ProgramID =$program  ";
                                $rs=$conn->query($sql);
                                while($rw = mysqli_fetch_assoc($rs)){
                            ?>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom text-white font-size16 xs-font-size13">
                                        <?php echo $rw['SubjectEN'] ?>
                                    </span>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['TimeName'] ?></div>
                                    <div class="margin-10px-top font-size14"><?php echo $rw['FacultyEN'] ?>/<?php echo $rw['YearEN'] ?>/<?php echo $rw['SemesterEN'] ?></div>
                                    <div class="font-size13 text-light-gray"><?php echo $rw['LecturerName'] ?></div>
                                    <div class="font-size13 text-light-dark">Room: <?php echo $rw['RoomName']?>/<?php echo $rw['CampusEN'] ?></div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <a href="?tag=view_schedule&op=edit&id=<?php echo $rw['ScheduleID'] ?>" class="btn btn-primary" >Edit</a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="?tag=view_schedule&op=del&id1=<?php echo $rw['ScheduleID'] ?>" class="btn btn-danger" >Delete</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                    <?php } ?>
                                </td>
                                <td>
                                   
                                </td>
                            </tr>
                                </div>
                           
                           
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



elseif($op == 'edit'){


    
   

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
                   
                    <a  class="btn btn-primary" >Back</a>
                    
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
else {
    
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
                            <h5 class="card-title">Lecturer Table</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <table class="table table-striped" cellpadding="2">
                                    <thead>
                                        <th scope="col-2">Lecturer ID</th>
                                        <th scope="col">Lecturer Name</th>
                                        <th scope="col" colspan="3">Action</th>
                                    </thead>
                                    <?php
                                   
                                    $query = "Select * From lecturer_tbl";
                                    $result = mysqli_query($conn, $query);
                                    if (!$result) {
                                        die("Invalid query" . mysqli_error($conn));
                                    }
                                    ?>

                                    <tr>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '
                                                <tr>
                                                <td>' . $row["LecturerID"] . '</td>
                                                <td>' . $row["LecturerName"] . '</td>
                                                <td>
                                                <button class="btn btn-secondary">
                                                    <a class="text-light text-decoration-none" href="?tag=view_schedule&op=view&id=' . $row['LecturerID'] . '">View Schedule</a>
                                                </button>                                            
                                            </td>

                                            
                                            ';
                                        }

                                        ?>
                                </table>
                                <?php
                    }
                        ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                                    $insert_query = "UPDATE `schedule_tbl` SET `SubjectID`='$subjecttxt',`LecturerID`='$lecturetxt',`DayWeekID`='$daytxt',`TimeID`='$timetxt',`RoomID`='$roomtxt',`ProgramID`='$programtxt',`DateStart`='$startDate',`DateEnd`='$endDate',`ScheduleDate`='$scheduleDate' WHERE ScheduleID = $id";
                                    if ($conn->query($insert_query) === TRUE) {
                                        echo '
                                        <script>
                                        $(document).ready(function(){
                                            swal({
                                                title: "Success!",
                                                text: "Record Update successfully",
                                                icon: "success",
                                                button: "Done",
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

