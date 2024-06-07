<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title> 
</head>
<script>
        function updateMajorList(FacultyID) {
            $.ajax({
                url: 'FetchFacul.php',
                type: 'POST',
                data: {
                    facultyID: FacultyID
                },
                success: function(response) {
                    $('select[name="majorId"]').html(response);
                },
                error: function() {
                    alert('Error fetching majors');
                }
            });
        }
    </script>
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
    $del = "DELETE FROM Sucject_tbl WHERE SubjectID=$id";
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

    $MajorID = $_POST['MajorID'];
    $Hour = $_POST['Hours'];
    $SubjectKH = $_POST['SubjectKH'];
    $SubjectEN = $_POST['SubjectEN'];
    $Number = $_POST['CreditNumber'];
    $Year = $_POST['YearID'];
    $Semester = $_POST['SemesterID'];

    $sql_update = "UPDATE subject_tbl SET
     
     MajorID = $MajorID,
     Hours = $Hour,
     SubjectKH = '$SubjectKH',
     SubjectEN= '$SubjectEN',
     CreditNumber = $Number,
     YearID = $Year,
     SemesterID = $Semester ";



    $sql_update .= " WHERE SubjectID=$id";


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
            window.location.href = "?tag=list_sub";
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
        $sql_edit = "SELECT * FROM subject_tbl WHERE SubjectID=$id ";
        $exec = mysqli_query($conn, $sql_edit);
    ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Subject</h1>
            </div>

            <!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Subject Form Edit</h5>
                                <form class="row g-3" method="post" enctype="multipart/form-data">
                                    <?php
                                    $i = 0;
                                    while ($rw_edit = mysqli_fetch_array($exec)) {
                                    ?>
                                        <div>
                                            <label class="form-label my-3">Please Select Year</label>
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
                                            <label class="form-label my-3">Please Select Faculty</label>
                                            <select name="MajorID" class="form-select" id="" onchange="updateMajorList(this.value)">
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
                                            <label class="form-label my-3">Please Select Major</label>
                                            <select name="majorId" class="form-select" id="">
                                            </select>
                                        </div>
                                        <div>
                                            <label class="form-label my-3">Please Select Semester</label>
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


                                        <div class="col-12">
                                            <label class="form-label">SubjectKH </label>
                                            <input type="text" class="form-control" name="SubjectKH" value="<?php echo $rw_edit['SubjectKH'] ?>" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">SubjectEN </label>
                                            <input type="text" class="form-control" name="SubjectEN" value="<?php echo $rw_edit['SubjectEN'] ?>" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Credit Number </label>
                                            <input type="text" class="form-control" name="CreditNumber" value="<?php echo $rw_edit['CreditNumber'] ?>" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Hours </label>
                                            <input type="text" class="form-control" name="Hours" value="<?php echo $rw_edit['Hours'] ?>" />
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
            <!-- <div class="pagetitle">
        <h1>STUDENT</h1>
        
      </div> -->
            <!-- End Page Title -->
            <!-- Button trigger modal -->
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Subject Info</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="card-title">Subject Form</h5>

                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div>
                                    <label class="form-label my-2">Please Select Year</label>
                                    <select name="YearID" class="form-select" id="">
                                        <option value="">Select Year</option>
                                        <?php getYear() ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label my-2">Please Select Faculty</label>
                                    <select name="FacultyID" class="form-select" onchange="updateMajorList(this.value)">
                                        <option value="">Select Faculty</option>
                                        <?php getFaculty() ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label my-2">Please Select Major</label>
                                    <select name="majorId" class="form-select" id="">
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label my-2">Please Select Semester</label>
                                    <select name="SemesterID" class="form-select" id="">
                                        <option value="">Select Semester</option>
                                        <?php getSemester() ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Subject (KH) </label>
                                    <input type="text" class="form-control" name="SubjectKH" required />
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Subject (EN) </label>
                                    <input type="text" class="form-control" name="SubjectEN" required />
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Credit Number </label>
                                    <input type="text" class="form-control" name="CreditNumber" required />
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Hour</label>
                                    <input type="text" class="form-control" name="Hours" required />
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
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"> Subject Table</h5>

                                <!-- Vertical Form -->
                                <form class="row g-3" method="post" enctype="multipart/form-data">
                                    <table class="table table-striped" cellpadding="2">
                                        <thead>
                                            <th scope="col-2">Subject ID</th>
                                            <th scope="col">Subject KH</th>
                                            <th scope="col">Subject EN</th>
                                            <th scope="col">Credit Number</th>
                                            <th scope="col">Hours</th>
                                            <th scope="col">Major</th>
                                            <th scope="col">Year</th>
                                            <th scope="col">Semester</th>
                                            <th scope="col" colspan="3">Action</th>
                                        </thead>
                                        <?php
                                        include_once 'connect.php';
                                        $query = "SELECT * FROM subject_tbl 
                                        INNER JOIN major_tbl ON subject_tbl.MajorID = major_tbl.MajorID
                                        INNER JOIN semester_tbl ON subject_tbl.SemesterID = semester_tbl.SemesterID
                                        INNER JOIN year_tbl on subject_tbl.YearID = year_tbl.YearID ORDER BY subject_tbl.SubjectID ";
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
                                                <td>' . $row["SubjectID"] . '</td>
                                                <td>' . $row["SubjectKH"] . '</td>
                                                <td>' . $row["SubjectEN"] . '</td>
                                                <td>' . $row["CreditNumber"] . '</td>
                                                <td>' . $row["Hours"] . '</td>
                                                <td>' . $row["MajorEN"] . '</td>
                                                
                                                <td>' . $row["YearEN"] . '</td>
                                                <td>' . $row["SemesterEN"] . '</td>


                                                <td>
                                                <button class="btn btn-secondary">
                                                    <a class="text-light text-decoration-none" href="?tag=list_sub&op=edit&id=' . $row['SubjectID'] . '">Edit</a>
                                                </button>                                            
                                            </td>

                                            <td>
                                                <button class="btn btn-danger">
                                                <a href="?tag=list_sub&op=del&id=' . $row['SubjectID'] . '" class="text-light text-decoration-none">Delete</a>                                                </button>
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