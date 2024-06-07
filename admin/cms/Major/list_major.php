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
    $del = "DELETE FROM major_tbl WHERE MajorID=$id";
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
    $campuskh = $_POST['FacultyID'];
    $campu = $_POST['MajorKH'];
    $campusen = $_POST['MajorEN'];
    // Prepare SQL update statement
    $sql_update = "UPDATE major_tbl SET
                       FacultyID='$campuskh',
                        MajorEN='$campusen',
                        MajorKH = '$campu'
                        ";

    // Include image update in SQL statement if an image is uploaded

    $sql_update .= " WHERE MajorID=$id";

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
            window.location.href = "?tag=list_major";
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
        $sql_edit = "SELECT * FROM major_tbl WHERE MajorID=$id ";
        $exec = mysqli_query($conn, $sql_edit);
    ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Major</h1>
            </div>

            <!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Major Form Edit</h5>
                                <form class="row g-3" method="post" enctype="multipart/form-data">
                                    <?php
                                    $i = 0;
                                    while ($rw_edit = mysqli_fetch_array($exec)) {
                                    ?>
                                        <div>
                                            <label class="form-label ms-3 my-3"> Select Faculty to Edit </label>
                                            <select name="FacultyID" class="form-select" id="">

                                                <option value="">Select Faculty</option>
                                                <?php
                                                $faculty = mysqli_query($conn, "SELECT * FROM faculty_tbl");

                                                while ($row = mysqli_fetch_array($faculty)) {
                                                ?>
                                                    <option value="<?php echo $row['FacultyID'] ?>"><?php echo $row['FacultyEN'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Major (KH)</label>
                                            <input type="text" class="form-control" name="MajorKH" value="<?php echo $rw_edit['MajorKH'] ?>" />
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Major (EN)</label>
                                            <input type="text" class="form-control" name="MajorEN" value="<?php echo $rw_edit['MajorEN'] ?>" />
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
                $email = $_POST['FacultyID'];
                $hey = $_POST['MajorKH'];
                $mobile = $_POST['MajorEN'];
                $sqlCheck_dup = "SELECT * FROM major_tbl WHERE MajorKH = '$hey' AND MajorEN = '$mobile' AND FacultyID = '$email'";
                $rs = $conn->query($sqlCheck_dup);

                if ($rs->num_rows > 0) {
                    echo '
            <script>
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Major Already Exists",
                    icon: "error",
                    button: "Done",
                });
            });
            </script>
            ';
                } else {
                    if (!empty($email) && !empty($mobile) && !empty($hey)) {
                        $sql = "INSERT INTO major_tbl (FacultyID, MajorEN, MajorKH) VALUES ('$email', '$mobile', '$hey')";
                        if (mysqli_query($conn, $sql)) {
                            echo '
                    <script>
                    $(document).ready(function(){
                        swal({
                            title: "Success!",
                            text: "Major Added Successfully",
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
                            text: "Failed to add Major",
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Major Info</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="card-title">Major Form</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div>
                                    <label class="form-label my-3">Please Select Faculty</label>
                                    <select name="FacultyID" class="form-select" id="">
                                        <option value="">Select Faculty</option>
                                        <?php
                                        $acad = mysqli_query($conn, "SELECT * FROM faculty_tbl");
                                        while ($row = mysqli_fetch_array($acad)) {
                                        ?>
                                            <option value="<?php echo $row['FacultyID'] ?>"><?php echo $row['FacultyEN'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Major Name (Kh)</label>
                                    <input type="text" class="form-control" name="MajorKH" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Major Name (En)</label>
                                    <input type="text" class="form-control" name="MajorEN" required />
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
                                <h5 class="card-title">Major Table</h5>

                                <!-- Vertical Form -->
                                <form class="row g-3" method="post" enctype="multipart/form-data">
                                    <table class="table table-striped" cellpadding="2">
                                        <thead>
                                            <th scope="col-2">Major ID</th>
                                            <th scope="col">Major (KH)</th>
                                            <th scope="col">Major (EN)</th>
                                            <th scope="col">Faculty ID</th>
                                            <th scope="col" colspan="3">Action</th>
                                        </thead>
                                        <?php
                                        include_once 'connect.php';
                                        $query = "Select * From major_tbl";
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
                                                <td>' . $row["MajorID"] . '</td>
                                                
                                                <td>' . $row["MajorKH"] . '</td>
                                                <td>' . $row["MajorEN"] . '</td>
                                                <td>' . $row["FacultyID"] . '</td>
                                                <td>
                                                <button class="btn btn-secondary">
                                                    <a class="text-light text-decoration-none" href="?tag=list_major&op=edit&id=' . $row['MajorID'] . '">Edit</a>
                                                </button>                                            
                                            </td>

                                            <td>
                                                <button class="btn btn-danger">
                                                <a href="?tag=list_major&op=del&id=' . $row['MajorID'] . '" class="text-light text-decoration-none">Delete</a>                                                </button>
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