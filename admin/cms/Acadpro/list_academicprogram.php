<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    $del = "DELETE FROM academicprogram_tbl WHERE AcademicProgramID=$id";
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
    $campuskh = $_POST['AcademicYearID'];
    $campusen = $_POST['AcademicProgramEn'];
    $sql_update = "UPDATE academicprogram_tbl SET
                       AcademicYearID='$campuskh',
                        AcademicProgramEn='$campusen'
                        ";
    $sql_update .= " WHERE AcademicProgramID=$id";
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
            window.location.href = "?tag=list_academicprogram";
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

if ($op == 'edit') {
    $sql_edit = "SELECT * FROM academicprogram_tbl WHERE AcademicProgramID=$id ";
    $exec = mysqli_query($conn, $sql_edit);
}
?>

<body>
    <?php
    if ($op == 'edit') {
    ?>
        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Academic Program</h1>
            </div>
            <section class="section">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Academic Program Form Edit</h5>
                                <form class="row g-3" method="post" enctype="multipart/form-data">
                                    <?php
                                    $i = 0;
                                    while ($rw_edit = mysqli_fetch_array($exec)) {
                                    ?>
                                        <div>
                                            <label class="form-label ms-3 my-3"> Select Academic Year to Edit </label>
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
                                        <div class="col-12">
                                            <label class="form-label">Academic Program (EN)</label>
                                            <input type="text" class="form-control" name="AcademicProgramEn" value="<?php echo $rw_edit['AcademicProgramEn'] ?>" />
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

            if (isset($_POST['btn_sub'])) {
                $email = $_POST['AcademicYearID'];
                $mobile = $_POST['AcademicProgramEn'];
                $sqlCheck_dup = "SELECT * FROM academicprogram_tbl WHERE AcademicYearID = '$email' AND AcademicProgramEn = '$mobile'";
                $rs = $conn->query($sqlCheck_dup);

                if ($rs->num_rows > 0) {
                    echo '
            <script>
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Academic Program Already Exists",
                    icon: "error",
                    button: "Done",
                });
            });
            </script>
            ';
                } else {
                    if (!empty($email) && !empty($mobile)) {
                        $sql = "INSERT INTO academicprogram_tbl (AcademicYearID, AcademicProgramEn) VALUES ('$email', '$mobile')";
                        if (mysqli_query($conn, $sql)) {
                            echo '
                    <script>
                    $(document).ready(function(){
                        swal({
                            title: "Success!",
                            text: "Academic Program Added Successfully",
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
                            text: "Failed to add Academic Year",
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
                        text: "Please fill in all fields",
                        icon: "error",
                        button: "Done",
                    });
                });
                </script>
                ';
                    }
                }
            }
            ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Year Info</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="card-title">Academic Program Form</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div>
                                    <label class="form-label my-3">Please Select Academic Year</label>
                                    <select name="AcademicYearID" class="form-select" id="">
                                        <option value="">Select Academic Year</option>
                                        <?php
                                        $acad = mysqli_query($conn, "SELECT * FROM academicyear_tbl");
                                        while ($row = mysqli_fetch_array($acad)) {
                                        ?>
                                            <option value="<?php echo $row['AcademicYearID'] ?>"><?php echo $row['AcademicYear'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Academic Program (En)</label>
                                    <input type="text" class="form-control" name="AcademicProgramEn" required />
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
                                <h5 class="card-title">Academic Year Table</h5>
                                <form class="row g-3" method="post" enctype="multipart/form-data">
                                    <table class="table table-striped" cellpadding="2">
                                        <thead>
                                            <th scope="col-2">Academic Program ID</th>
                                            <th scope="col">Academic Year</th>
                                            <th scope="col">Academic Program (EN)</th>
                                            <th scope="col" colspan="3">Action</th>
                                        </thead>
                                        <?php
                                        include_once 'connect.php';
                                        $query = "SELECT ap.AcademicProgramID, ay.AcademicYear, ap.AcademicProgramEn 
                                                  FROM academicprogram_tbl ap
                                                  INNER JOIN academicyear_tbl ay ON ap.AcademicYearID = ay.AcademicYearID";
                                        $result = mysqli_query($conn, $query);
                                        if (!$result) {
                                            die("Invalid query" . mysqli_error($conn));
                                        }
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '
                                            <tr>
                                            <td>' . $row["AcademicProgramID"] . '</td>
                                            <td>' . $row["AcademicYear"] . '</td>
                                            <td>' . $row["AcademicProgramEn"] . '</td>
                                            <td>
                                            <button class="btn btn-secondary">
                                                <a class="text-light text-decoration-none" href="?tag=list_academicprogram&op=edit&id=' . $row['AcademicProgramID'] . '">Edit</a>
                                            </button>                                            
                                        </td>
                                        <td>
                                            <button class="btn btn-danger">
                                            <a href="?tag=list_academicprogram&op=del&id=' . $row['AcademicProgramID'] . '" class="text-light text-decoration-none">Delete</a>                                                </button>
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