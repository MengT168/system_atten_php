<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    var dateInput = document.getElementById('dateInput');

    dateInput.addEventListener('change', function() {
      var inputValue = this.value;

      // Split the input value into parts (year, month, day)
      var parts = inputValue.split('-');

      // Rearrange the parts into the desired format
      var formattedDate = parts[0] + '-' + parts[1] + '-' + parts[2];

      // Update the input value with the new format
      this.value = formattedDate;
    });
  </script>
    <title>Document</title>
</head>
<?php
require("./connect.php");
$op = "";
$id = "";
global $conn;
if (isset($_GET['op']))
    $op = $_GET['op'];

if (isset($_GET['id']))
    $id = $_GET['id'];



if ($op == 'del') {
    $del = "DELETE FROM attendance_tbl WHERE AttendanceID=$id";
    $exec = mysqli_query($conn, $del);
    if ($exec) {
        echo '
        <script>
        $(document).ready(function(){
            swal({
                title: "Success!",
                text: "Detete Success",
                icon: "success",
                button: "Done",
            }).then(function() {
                window.location.href = "?tag=attendance";
            });
        });
        </script>
        ';
    } else
        $msg = "Delete Error: " . mysqli_error($conn);
}


if (isset($_POST['btn_update'])) {
    $name = $_POST['name'];
    $attendanceDateIssue = $_POST['attendanceDateIssue'];
    $subject = $_POST['subject'];
    $attended = $_POST['attended'];
    $attendanceNote = $_POST['attendanceNote'];
    $section = $_POST['section'];
    $lecturer = $_POST['lecturer'];
    $dateIssue = $_POST['dateIssue'];


    $sql_update = "UPDATE attendance_tbl SET
        `StudentStatusID`='$name',
        `AttendanceDateIssue`='$attendanceDateIssue',
        `SubjectID`='$subject',
        `Attended`='$attended',
        `AttendNote`='$attendanceNote',
        `Section`='$section',
        `LecturerID`='$lecturer',
        `DateIssue`='$dateIssue' WHERE AttendanceID =$id ";
    
    $rs = $conn->query($sql_update);
    if ($rs) {
        echo '
    <script>
    $(document).ready(function(){
        swal({
            title: "Success!",
            text: "Update Success",
            icon: "success",
            button: "Done",
        }).then((value) => {
            window.location.href = "?tag=attendance";
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
                text: "Update Failed",
                icon: "error",
                button: "Done",
            });
        });
        </script>
        ';
    }
}
?>

<body>
    <?php
    if ($op == 'edit') {
        $sql_edit = "SELECT * FROM attendance_tbl WHERE AttendanceID=$id ";
        $exec = mysqli_query($conn, $sql_edit);
    ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Attendance</h1>
            </div>

            <!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Attendance</h5>
                                <form class="row g-3" method="post" enctype="multipart/form-data">
                                    <?php
                                    $i = 0;
                                    while ($rw_edit = mysqli_fetch_array($exec)) {
                                    ?>


                                        <div class="col-12">
                                            <label class="form-label">Student Name</label>
                                            <select name="name" class="form-select" id="">
                                                <?php
                                                $status = mysqli_query($conn, "SELECT * FROM studentstatus_tbl INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID");
                                                while ($row = mysqli_fetch_array($status)) {
                                                ?>
                                                    <option value="<?php echo $row['StudentStatusID'] ?>" <?php if ($row['StudentStatusID'] == $rw_edit['StudentStatusID']) echo 'selected' ?>><?php echo $row['NameInLatin'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Lecturer</label>
                                            <select name="lecturer" class="form-select" id="">
                                            <?php
                                                $status = mysqli_query($conn, "SELECT * FROM lecturer_tbl");
                                                while ($row = mysqli_fetch_array($status)) {
                                                ?>
                                                    <option value="<?php echo $row['LecturerID'] ?>" <?php if ($row['LecturerID'] == $rw_edit['LecturerID']) echo 'selected' ?>><?php echo $row['LecturerName'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Subject</label>
                                            <select name="subject" class="form-select" id="">
                                            <?php
                                                $status = mysqli_query($conn, "SELECT * FROM subject_tbl");
                                                while ($row = mysqli_fetch_array($status)) {
                                                ?>
                                                    <option value="<?php echo $row['SubjectID'] ?>" <?php if ($row['SubjectID'] == $rw_edit['SubjectID']) echo 'selected' ?>><?php echo $row['SubjectEN'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Attended</label>
                                            <select name="attended" class="form-select">
                                                
                                                <option value="">Select One</option>
                                                <option value="1" <?php if($rw_edit['Attended']==1) echo 'selected' ?> ><span>&#10003;</span></option>
                                                <option value="2" <?php if($rw_edit['Attended']==2) echo 'selected' ?> >P</option>
                                                <option value="3" <?php if($rw_edit['Attended']==3) echo 'selected' ?>>A</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Attendance Date Issue</label>
                                            <input type="date" name="attendanceDateIssue" id="dateInput" value="<?php echo $rw_edit['AttendanceDateIssue'] ?>" class="form-control" >
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Attendance Note</label>
                                           <input type="text" name="attendanceNote" value="<?php echo $rw_edit['AttendNote'] ?>"  class="form-control" >
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Section</label>
                                            <input type="text" name="section" value="<?php echo $rw_edit['Section'] ?>" class="form-control" >
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Date Issue</label>
                                            <input type="date" name="dateIssue" id="dateInput" value="<?php echo $rw_edit['DateIssue'] ?>" class="form-control" >
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" class="btn btn-primary" value="Save" name="btn_update">
                                            <a href="?tag=attendance" class="btn btn-primary" >Back</a>
                                        </div>
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

    <?php
    } else {

    ?>




        <main id="main" class="main">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create
            </button>
            
            <!-- Modal -->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Attendace</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php
                            require('Function.php');
                            ?>
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div class="col-6">
                                    <label class="form-label">Student Status Name</label>
                                    <select name="studentstatusname" class="form-select">
                                        <option value="">Select One</option>
                                        <?php getStudentStatus(); ?>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label for="inputPassword4" class="form-label">Attendance Date Issue </label>
                                    <input type="date" class="form-control" name="attendate" id="dateInput" />
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Subject</label>
                                    <select name="subjecttxt" class="form-select">
                                        <option value="">Select One</option>
                                        <?php getSubject(); ?>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label for="inputPassword4" class="form-label">Lecturer</label>
                                    <select name="lecturetxt" class="form-select">
                                        <option value="">Select One</option>
                                        <?php getLecture(); ?>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label for="inputPassword4" class="form-label">Attended</label>
                                    <select name="attended" class="form-select">
                                        <option value="">Select One</option>
                                        <option value="1"><span>&#10003;</span></option>
                                        <option value="P">P</option>
                                        <option value="A">A</option>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label for="inputPassword4" class="form-label">Attendance Note </label>
                                    <input type="text"  class="form-control" name="attennote" />
                                </div>

                                <div class="col-6">
                                    <label for="inputPassword4" class="form-label">Section</label>
                                    <input type="text" class="form-control" name="section" />
                                </div>

                                <div class="col-6">
                                    <label for="inputPassword4" class="form-label">Date Issue </label>
                                    <input type="date" class="form-control" name="Dateissue" id="dateInput" />
                                </div>
                                <div class="text-center">
                                    <input type="submit" value="Submit" name="btn_sub" class="btn btn-primary">
                                    </input>

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    <!-- <input type="reset" class="btn btn-secondary"> -->

                                    </input>
                                </div>
                            </form>
                        </div>

                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Attendance Table</h5>

                                <!-- Vertical Form -->
                                <form class="row g-3" method="post" enctype="multipart/form-data">
                                    <table class="table table-striped" cellpadding="2">
                                        <thead>
                                            <th scope="col-2">Attendance ID</th>
                                            <th scope="col-2">Student Status Name</th>
                                            <th scope="col">Attendance DateIssue</th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Attended</th>
                                            <th scope="col">AttendNote</th>
                                            <th scope="col">Section</th>
                                            <th scope="col">LecturerID</th>
                                            <th scope="col">DateIssue</th>
                                            <th scope="col" colspan="3">Action</th>
                                        </thead>
                                        <?php
                                        include_once 'connect.php';
                                        $query = "SELECT * FROM `attendance_tbl` 
                                        INNER JOIN studentstatus_tbl on attendance_tbl.StudentStatusID = studentstatus_tbl.StudentStatusID 
                                        INNER JOIN studentinfo_tbl on studentstatus_tbl.StudentID = studentinfo_tbl.StudentID 
                                        INNER JOIN subject_tbl on attendance_tbl.SubjectID = subject_tbl.SubjectID 
                                        INNER JOIN lecturer_tbl on attendance_tbl.LecturerID = lecturer_tbl.LecturerID";
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
                                                <td>' . $row["AttendanceID"] . '</td>
                                                <td>' . $row["NameInLatin"] . '</td>
                                                <td>' . $row["AttendanceDateIssue"] . '</td>
                                                <td>' . $row["SubjectEN"] . '</td>
                                                <td>' . $row["Attended"] . '</td>
                                                <td>' . $row["AttendNote"] . '</td>
                                                <td>' . $row["Section"] . '</td>
                                                <td>' . $row["LecturerName"] . '</td>
                                                <td>' . $row["DateIssue"] . '</td>
                                                <td>
                                                    <button class="btn btn-secondary">
                                                        <a class="text-light text-decoration-none" href="?tag=attendance&op=edit&id=' . $row['AttendanceID'] . '">Edit</a>
                                                    </button>                                            
                                                </td>
                                                <td>
                                                    <a id="delete"  href="?tag=attendance&op=del&id=' . $row['AttendanceID'] . '" 
                                                    class="btn btn-danger" 
                                                    onclick="return confirm(\'Are you sure you want to delete this item?\');">Delete</a>
                                                </td>
                                            </tr>';
                                        }
                                        ?>
                    </tr>

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
        <!-- <script>
    $(document).ready(function() {
        $('#delete').click(function(event) {
            event.preventDefault(); // Prevent the default action

            var attendanceID = $(this).data('id');
            var userConfirmed = confirm('Are you sure?');

            if (userConfirmed) {
                window.location.href = "?tag=attendance&op=del&id=" + attendanceID;
            }
            
        });
    });
</script> -->
</body>

</html>