<?php require('Function2.php'); ?>
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
    $del = "DELETE FROM educationalbackground_tbl WHERE EducationalBackgroundID=$id";
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
            }).then(function(){
                window.location.href = "?tag=educa";
            });
        });
        </script>
        ';
    } else
        $msg = "Delete Error: " . mysqli_error($conn);
}


if (isset($_POST['btn_save'])) {
    // Retrieve form data
    $batchkh = $_POST['ShiftKH'];
    $batchen = $_POST['ShiftEN'];
    // Prepare SQL update statement
    $sql_update = "UPDATE shift_tbl SET
                        ShiftKH='$batchkh',
                        ShiftEN='$batchen'
                        ";

    // Include image update in SQL statement if an image is uploaded

    $sql_update .= " WHERE ShiftID=$id";

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
            window.location.href = "?tag=list_shift";
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
        // $sql_edit = "SELECT * FROM shift_tbl WHERE ShiftID=$id ";
        // $exec = mysqli_query($conn, $sql_edit);
    ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Shift</h1>
            </div>

            <!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Shift Form Edit</h5>
                                <form class="row g-3" method="post" enctype="multipart/form-data">
                                <?php 
                    $sql="SELECT * FROM educationalbackground_tbl WHERE EducationalBackgroundID = $id";
                    $rs=$conn->query($sql);
                    while($row=mysqli_fetch_assoc($rs)){
                      
                  ?>

<div class="row mb-3">
                  <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Educational ID</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="educationalid" readonly type="text" class="form-control" id="Facebook" value="<?php echo $row['EducationalBackgroundID'] ?>">
                  </div>
      </div>
      <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">School Type</label>
                  <div class="col-md-8 col-lg-9">
                  <select name="schooltytxt" id="" class="form-select" >
                                   <?php
                                    $sql="SELECT * FROM schooltype_tbl ORDER BY SchoolTypeID";
                                    $exec=mysqli_query($conn,$sql);
                                    while($rw=mysqli_fetch_array($exec)){
                                    ?>
                                        <option value="<?php echo $rw['SchoolTypeID'];?>" 
                                            <?php if($rw['SchoolTypeID']==$row['SchoolTypeID']) echo "selected";?>>
                                            
                                            <?php echo $rw['SchoolTypeEN']?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                   </select>
                  </div>
      </div>
      <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">School Name</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="schoolnametxt"  type="text" class="form-control" id="Facebook" value="<?php echo $row['NameSchool'] ?>">
                  </div>
      </div>
      <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Academic Year</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="academictxt"  type="text" class="form-control" id="Facebook" value="<?php echo $row['AcademicYear'] ?>">
                  </div>
      </div>
      <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">City/Province</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="cityprovince"  type="text" class="form-control" id="Facebook" value="<?php echo $row['Province'] ?>">
                  </div>
      </div>
      <?php } ?>
      <div class="text-center">
                  <button type="submit" name="btn_up_pro" class="btn btn-primary">Save Changes</button>
                  <a href="?tag=educa" class="btn btn-primary" >Back</a>
                </div>
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
                $email = $_POST['ShiftKH'];
                $mobile = $_POST['ShiftEN'];
                $sqlCheck_dup = "SELECT * FROM shift_tbl WHERE ShiftKH = '$email' AND ShiftEN = '$mobile'";
                $rs = $conn->query($sqlCheck_dup);

                if ($rs->num_rows > 0) {
                    echo '
        <script>
        $(document).ready(function(){
            swal({
                title: "Error!",
                text: "Shift Already Exists",
                icon: "error",
                button: "Done",
            });
        });
        </script>
        ';
                } else {
                    if (!empty($email) && !empty($mobile)) {
                        $sql = "INSERT INTO shift_tbl (ShiftKH, ShiftEN) VALUES ('$email', '$mobile')";
                        if (mysqli_query($conn, $sql)) {
                            echo '
                <script>
                $(document).ready(function(){
                    swal({
                        title: "Success!",
                        text: "Shift Added Successfully",
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
                        text: "Failed to add Shift",
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Educational Info</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="card-title">Educational Background Form</h5>

                            <!-- Vertical Form -->
                            <form method="post" enctype="multipart/form-data" >

                                        <div class="row mb-3">
                                        <h6 style="text-align: center;" >Educational Background</h6>
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">School Type</label>
                                        
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" name="schooltype" id="">
                                            <option value="">
                                            Select One
                                            </option>
                                                <?php getSchoolType(); ?>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Student</label>
                                            <div class="col-md-8 col-lg-9">
                                            <select name="studenttxt" class="form-select" id="">
                                            <option value="">
                                                Select One
                                                </option>
                                                <?php getStudent();  ?>
                                                </select>
                                            </div>
                                            </div>

                                        <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">School Name</label>
                                        <div class="col-md-8 col-lg-9">
                                        <input type="text" name="schoolnametxt" class="form-control" >
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Academic Year</label>
                                        <div class="col-md-8 col-lg-9">
                                        <input type="text" name="academicyear" class="form-control" >
                                        </div>
                                        </div>
                                        <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Province</label>
                                        <div class="col-md-8 col-lg-9">
                                        <input type="text" name="province" class="form-control" >
                                        </div>
                                        </div>
                                        
                                        <div class="text-center">
                                        <button type="submit" class="btn btn-primary" name="btn_add_status" >Add</button>
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
                                <h5 class="card-title">Shift Table</h5>

                                <!-- Vertical Form -->
                                <form class="row g-3" method="post" enctype="multipart/form-data">
                                    <table class="table table-striped" cellpadding="2">
                                        <thead>
                                            <th scope="col-2">ID</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">SchoolType</th>
                                            <th scope="col">School Name</th>
                                            <th scope="col">AcademicYear</th>
                                            <th scope="col">City/Province</th>
                                            <th scope="col" colspan="3">Action</th>
                                        </thead>
                                        <?php
                                        include_once 'connect.php';
                                        $query = "SELECT * FROM educationalbackground_tbl
                                        INNER JOIN schooltype_tbl on educationalbackground_tbl.SchoolTypeID = schooltype_tbl.SchoolTypeID
                                        INNER JOIN studentinfo_tbl ON educationalbackground_tbl.StudentID = studentinfo_tbl.StudentID
                                        ";
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
                                                <td>' . $row["EducationalBackgroundID"] . '</td>
                                                <td>' . $row["NameInLatin"] . '</td>
                                                <td>' . $row["SchoolTypeEN"] . '</td>
                                                <td>' . $row["NameSchool"] . '</td>
                                                <td>' . $row["AcademicYear"] . '</td>
                                                <td>' . $row["Province"] . '</td>
                                                <td>
                                                <button class="btn btn-secondary">
                                                    <a class="text-light text-decoration-none" href="?tag=educa&op=edit&id=' . $row['EducationalBackgroundID'] . '">Edit</a>
                                                </button>                                            
                                            </td>

                                            <td>
                                                <button class="btn btn-danger">
                                                <a onclick="return confirm(\'Are you sure you want to delete this item?\');" href="?tag=educa&op=del&id=' . $row['EducationalBackgroundID'] . '" class="text-light text-decoration-none">Delete</a>                                                </button>
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