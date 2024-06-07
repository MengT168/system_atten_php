<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function updateMajorList(FacultyID) {
            $.ajax({
                url: 'FetchFacul_listStu.php',
                type: 'POST',
                data: {
                    facultyID: FacultyID
                },
                success: function(response) {
                    $('select[name="MajorID"]').html(response);
                },
                error: function() {
                    alert('Error fetching majors');
                }
            });
        }
    </script>
    <script>
        function Upmajor(facultytxt) {
            $.ajax({
                url: 'FetchFacul_listStu.php',
                type: 'POST',
                data: {
                    facultyID: facultytxt
                },
                success: function(response) {
                    $('select[name="majortxt"]').html(response);
                },
                error: function() {
                    alert('Error fetching majors');
                }
            });
        }
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
    $del = "DELETE FROM program_tbl WHERE ProgramID=$id";
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
            });
        });
        </script>
        ';
    } else
        $msg = "Delete Error: " . mysqli_error($conn);
}


if (isset($_POST['btn_save'])) {
    // Retrieve form data
    $YearID = $_POST['YearID'];
    $SemesterID = $_POST['SemesterID'];
    $ShiftID = $_POST['ShiftID'];
    $DegreeID = $_POST['DegreeID'];
    $AcademicYearID = $_POST['AcademicYearID'];
    $MajorID = $_POST['MajorID'];
    $BatchID = $_POST['BatchID'];
    $CampusID = $_POST['CampusID'];
    $StartDate = $_POST['StartDate'];
    $EndDate = $_POST['EndDate'];
    $DateIsue = $_POST['DateIsue'];


    // Prepare SQL update statement
    $sql_update = "UPDATE program_tbl SET
                       YearID='$YearID',
                       SemesterID='$SemesterID',
                       ShiftID='$ShiftID',
                       DegreeID='$DegreeID',
                       AcademicYearID='$AcademicYearID',
                       MajorID='$MajorID',
                       BatchID='$BatchID',
                       CampusID='$CampusID',
                       StartDate='$StartDate',
                       EndDate='$EndDate',
                        DateIsue = '$DateIsue'
                        ";

    // Include image update in SQL statement if an image is uploaded

    $sql_update .= " WHERE ProgramID=$id";

    // Execute the update query
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
            window.location.href = "?tag=list_program";
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
        $sql_edit = "SELECT * FROM program_tbl WHERE ProgramID=$id ";
        $exec = mysqli_query($conn, $sql_edit);
    ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Program</h1>
            </div>

            <!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Program Form Edit</h5>
                                <form class="row g-3" method="post" enctype="multipart/form-data">
                                    <?php
                                    $i = 0;
                                    while ($rw_edit = mysqli_fetch_array($exec)) {
                                    ?>

                                        <div>
                                            <label class="form-label my-3">Select Year to Edit</label>
                                            <select name="YearID" class="form-select" id="">
                                                <option value="">Select Year</option>
                                                <?php
                                                $acad = mysqli_query($conn, "SELECT * FROM year_tbl");
                                                while ($row = mysqli_fetch_array($acad)) {
                                                ?>
                                                    <option value="<?php echo $row['YearID'] ?>" <?php if ($row['YearID'] == $rw_edit['YearID']) echo 'selected' ?>><?php echo $row['YearEN'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="form-label my-3">Select Semester to Edit</label>
                                            <select name="SemesterID" class="form-select" id="">
                                                <option value="">Select Semester</option>
                                                <?php
                                                $acad = mysqli_query($conn, "SELECT * FROM semester_tbl");
                                                while ($row = mysqli_fetch_array($acad)) {
                                                ?>
                                                    <option value="<?php echo $row['SemesterID'] ?>" <?php if ($row['SemesterID'] == $rw_edit['SemesterID']) echo 'selected' ?>><?php echo $row['SemesterEN'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="form-label ms-3 my-3">Select Shift to Edit </label>
                                            <select name="ShiftID" class="form-select" id="">

                                                <option value="">Select Shift</option>
                                                <?php
                                                $faculty = mysqli_query($conn, "SELECT * FROM shift_tbl");

                                                while ($row = mysqli_fetch_array($faculty)) {
                                                ?>
                                                    <option value="<?php echo $row['ShiftID'] ?>" <?php if ($row['ShiftID'] == $rw_edit['ShiftID']) echo 'selected' ?>><?php echo $row['ShiftEN'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="form-label my-3">Select Degree to Edit</label>
                                            <select name="DegreeID" class="form-select" id="">
                                                <option value="">Select Year</option>
                                                <?php
                                                $acad = mysqli_query($conn, "SELECT * FROM degree_tbl");
                                                while ($row = mysqli_fetch_array($acad)) {
                                                ?>
                                                    <option value="<?php echo $row['DegreeID'] ?>" <?php if ($row['DegreeID'] == $rw_edit['DegreeID']) echo 'selected' ?>><?php echo $row['DegreeNameEN'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="form-label ms-3 my-3">Select Academic Year to Edit </label>
                                            <select name="AcademicYearID" class="form-select" id="">

                                                <option value="">Select Academic Year</option>
                                                <?php
                                                $faculty = mysqli_query($conn, "SELECT * FROM academicyear_tbl");

                                                while ($row = mysqli_fetch_array($faculty)) {
                                                ?>
                                                    <option value="<?php echo $row['AcademicYearID'] ?>" <?php if ($row['AcademicYearID'] == $rw_edit['AcademicYearID']) echo 'selected' ?>><?php echo $row['AcademicYear'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="form-label my-3">Select Faculty to Edit</label>
                                            <select name="FacultyID" class="form-select" id="" onchange="updateMajorList(this.value)">
                                                <option value="">Select Faculty</option>
                                                <?php
                                                $acad = mysqli_query($conn, "SELECT * FROM faculty_tbl");
                                                while ($row = mysqli_fetch_array($acad)) {
                                                ?>
                                                    <option value="<?php echo $row['FacultyID'] ?>" <?php if ($row['FacultyID'] == $rw_edit['FacultyID']) echo 'selected' ?>><?php echo $row['FacultyEN'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>


                                        <div>
                                            <label class="form-label my-3">Select Major to Edit</label>
                                            <select name="MajorID" class="form-select" id="">
                                                <option value="">Select Major</option>
                                                <?php
                                                $acad = mysqli_query($conn, "SELECT * FROM major_tbl");
                                                while ($row = mysqli_fetch_array($acad)) {
                                                ?>
                                                    <option value="<?php echo $row['MajorID'] ?>" <?php if ($row['MajorID'] == $rw_edit['MajorID']) echo 'selected' ?>><?php echo $row['MajorEN'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="form-label ms-3 my-3">Select Batch to Edit </label>
                                            <select name="BatchID" class="form-select" id="">

                                                <option value="">Select Batch</option>
                                                <?php
                                                $faculty = mysqli_query($conn, "SELECT * FROM batch_tbl");

                                                while ($row = mysqli_fetch_array($faculty)) {
                                                ?>
                                                    <option value="<?php echo $row['BatchID'] ?>" <?php if ($row['BatchID'] == $rw_edit['BatchID']) echo 'selected' ?>><?php echo $row['BatchEN'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="form-label ms-3 my-3">Select Campus to Edit </label>
                                            <select name="CampusID" class="form-select" id="">

                                                <option value="">Select Campus</option>
                                                <?php
                                                $faculty = mysqli_query($conn, "SELECT * FROM campus_tbl");

                                                while ($row = mysqli_fetch_array($faculty)) {
                                                ?>
                                                    <option value="<?php echo $row['CampusID'] ?>" <?php if ($row['CampusID'] == $rw_edit['CampusID']) echo 'selected' ?>><?php echo $row['CampusEN'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Start Date </label>
                                            <input type="date" id="dateInput" class="form-control" name="StartDate" value="<?php echo $rw_edit['StartDate'] ?>" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">End Date </label>
                                            <input type="date" id="dateInput" class="form-control" name="EndDate" value="<?php echo $rw_edit['EndDate'] ?>" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Issue Date </label>
                                            <input type="date" id="dateInput" class="form-control" name="DateIsue" value="<?php echo $rw_edit['DateIsue'] ?>" />
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" class="btn btn-primary" value="Save" name="btn_save">
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
            <?php
            include("Function.php");
            ?>
            <!-- Modal -->
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
                                    <div class="col-md-4 col-lg-3">
                                        <label for="currentPassword" class="col-form-label">Faculty</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <select class="form-select" name="facultytxt" id="" onchange="Upmajor(this.value)">
                                            <option value="">Select One</option>
                                            <?php getFaculty(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="renewPassword" class="col-form-label">Major</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <select name="majortxt" class="form-select" id="">
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="currentPassword" class="col-form-label">Year</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <select class="form-select" name="yeartxt" id="">
                                            <option value="">Select One</option>
                                            <?php getYear(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="newPassword" class="col-form-label">Semester</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <select class="form-select" name="semestertxt" id="">
                                            <option value="">Select One</option>
                                            <?php getSemester(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="renewPassword" class="col-form-label">Shift</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <select name="shifttxt" class="form-select" id="">
                                            <option value="">Select One</option>
                                            <?php getShift(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="renewPassword" class="col-form-label">Degree</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <select name="degreetxt" class="form-select" id="">
                                            <option value="">Select One</option>
                                            <?php getDegree(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="renewPassword" class="col-form-label">AcademicYear</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <select name="academictxt" class="form-select" id="">
                                            <option value="">Select One</option>
                                            <?php getAcad(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="renewPassword" class="col-form-label">Batch</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <select name="batchtxt" class="form-select" id="">
                                            <option value="">Select One</option>
                                            <?php getBatch(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="renewPassword" class="col-form-label">Campus</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <select name="campustxt" class="form-select" id="">
                                            <option value="">Select One</option>
                                            <?php getCampus(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="renewPassword" class="col-form-label">Start Date</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="date" class="form-control" name="startdatetxt" id="dateInput" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="renewPassword" class="col-form-label">End Date</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="date" class="form-control" name="enddatetxt" id="dateInput" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4 col-lg-3">
                                        <label for="renewPassword" class="col-form-label">Date Issue</label>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="date" class="form-control" name="dateissuetxt" id="dateInput" />
                                    </div>
                                </div>
                                <div class="text-center">
                                    <input type="submit" name="btn_sub" class="btn btn-primary">

                                    </input>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

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

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Program Table</h5>

                                <!-- Vertical Form -->
                                <form class="row g-3" method="post" enctype="multipart/form-data">
                                    <table class="table table-striped" cellpadding="2">
                                        <thead>
                                            <th scope="col-2">Program ID</th>
                                            <th scope="col">Year</th>
                                            <th scope="col">Semester</th>
                                            <th scope="col">Shift</th>
                                            <th scope="col">Degree</th>
                                            <th scope="col">Academic Year</th>
                                            <th scope="col">Faculty</th>
                                            <th scope="col">Major</th>
                                            <th scope="col">Batch</th>
                                            <th scope="col">Campus</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Issue Date</th>
                                            <th scope="col" colspan="3">Action</th>
                                        </thead>
                                        <?php
                                        include_once 'connect.php';
                                        $query = "SELECT * FROM program_tbl
                                        INNER JOIN year_tbl on program_tbl.YearID = year_tbl.YearID
                                        INNER JOIN semester_tbl on program_tbl.SemesterID = semester_tbl.SemesterID
                                        INNER JOIN shift_tbl on program_tbl.ShiftID = shift_tbl.ShiftID
                                        INNER JOIN degree_tbl on program_tbl.DegreeID = degree_tbl.DegreeID
                                        INNER JOIN academicyear_tbl on program_tbl.AcademicYearID = academicyear_tbl.AcademicYearID
                                        INNER JOIN major_tbl on program_tbl.MajorID = major_tbl.MajorID
                                        INNER JOIN faculty_tbl on program_tbl.FacultyID = faculty_tbl.FacultyID
                                        INNER JOIN batch_tbl on program_tbl.BatchID = batch_tbl.BatchID
                                        INNER JOIN campus_tbl on program_tbl.CampusID = campus_tbl.CampusID ORDER BY program_tbl.ProgramID ";
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
                                                <td>' . $row["ProgramID"] . '</td>
                                                <td>' . $row["YearEN"] . '</td>
                                                <td>' . $row["SemesterEN"] . '</td>
                                                <td>' . $row["ShiftEN"] . '</td>
                                                <td>' . $row["DegreeNameEN"] . '</td>
                                                <td>' . $row["AcademicYear"] . '</td>
                                                <td>' . $row["FacultyEN"] . '</td>
                                                <td>' . $row["MajorEN"] . '</td>
                                                <td>' . $row["BatchEN"] . '</td>
                                                <td>' . $row["CampusEN"] . '</td>
                                                <td>' . $row["StartDate"] . '</td>
                                                <td>' . $row["EndDate"] . '</td>
                                                <td>' . $row["DateIsue"] . '</td>

                                                <td>
                                                <button class="btn btn-secondary">
                                                    <a class="text-light text-decoration-none" href="?tag=list_program&op=edit&id=' . $row['ProgramID'] . '">Edit</a>
                                                </button>                                            
                                            </td>

                                            <td>
                                                <button class="btn btn-danger">
                                                <a href="?tag=list_program&op=del&id=' . $row['ProgramID'] . '" class="text-light text-decoration-none">Delete</a>                                                </button>
                                            </td>
                                                </tr>
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