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
    $del = "DELETE FROM studentstatus_tbl WHERE StudentStatusID=$id";
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
                window.location.href = "?tag=status";
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
        // $sql_edit = "SELECT * FROM studentstatus_tbl WHERE StudentStatusID=$id ";
        // $exec = mysqli_query($conn, $sql_edit);
    ?>

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Student Status Update</h1>
            </div>

            <!-- End Page Title -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Status Form</h5>
                                <?php 
                    $sql="SELECT * FROM `studentstatus_tbl` 
                    WHERE StudentStatusID=$id";
                    $rs=$conn->query($sql);
                    while($row=mysqli_fetch_assoc($rs)){
                      
                  ?>
           <form method="post" enctype="multipart/form-data" >

      <div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Program</label>
  <div class="col-md-8 col-lg-9">
    <select name="program" id="" class="form-select">
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
      $exec = mysqli_query($conn, $sql);
      while ($rw = mysqli_fetch_array($exec)) {
        $selected = ($rw['ProgramID'] == $row['ProgramID']) ? "selected" : "";
        ?>
        <option value="<?php echo $rw['ProgramID']; ?>" <?php echo $selected; ?>>
          <?php echo $rw['YearEN'].'-'.$rw['SemesterEN'].'-'.$rw['MajorEN'].'-'.$rw['BatchEN'].'-'.$rw['CampusEN'].'-'.$rw['DegreeNameEN'].'-'.$rw['ShiftEN'].'-'.$rw['AcademicYear']; ?>
        </option>
      <?php
      }
      ?>
    </select>
  </div>
</div>

      <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Assign</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="assign"  type="text" class="form-control" id="Facebook" value="<?php echo $row['Assigned'] ?>">
                  </div>
      </div>

         <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Note</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="note"  type="text" class="form-control" id="Facebook" value="<?php echo $row['Note'] ?>">
      </div>
      </div>

         <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">AssignDate</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="assignDate"  type="date" class="form-control" id="dateInput" value="<?php echo $row['AssignDate'] ?>">
      </div>
      <?php } ?>
      <div class="text-center mt-2">
                  <button type="submit" name="btn_up_pro" class="btn btn-primary">Save Changes</button>
                  <a href="?tag=status" class="btn btn-primary" >Back</a>
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Status Info</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="card-title">Status Form</h5>

                            <!-- Vertical Form -->
                            <form method="post" enctype="multipart/form-data" >
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
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Program</label>
                    <div class="col-md-8 col-lg-9">
                    <select name="programtxt" class="form-select" id="">
                    <option value="">
                        Select One
                        </option>
                        <?php getProgram();  ?>
                        </select>
                    </div>
                    </div>
                    <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Assigne</label>
                    <div class="col-md-8 col-lg-9">
                    <input type="text" name="assignetxt" class="form-control" >
                    </div>
                    </div>
                    <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Note</label>
                    <div class="col-md-8 col-lg-9">
                    <input type="text" name="notetxt" class="form-control" >
                    </div>
                    </div>

                    <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Assign Date</label>
                    <div class="col-md-8 col-lg-9">
                    <input type="date" name="assigndate" id="dateInput" class="form-control" >
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Status Table</h5>

                                <!-- Vertical Form -->
                                <form class="row g-3" method="post" enctype="multipart/form-data">
                                    <table class="table table-striped" cellpadding="2">
                                        <thead>
                                            <th scope="col-2">StudentStatusID</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Program</th>
                                            <th scope="col">Assigned</th>
                                            <th scope="col">Note</th>
                                            <th scope="col">AssignDate</th>
                                            <th scope="col" colspan="3">Action</th>
                                        </thead>
                                        <?php
                                        include_once 'connect.php';
                                        $query = "SELECT * FROM `studentstatus_tbl`
                                        INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID";
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
                                                <td>' . $row["StudentStatusID"] . '</td>
                                                <td>' . $row["NameInLatin"] . '</td>
                                                <td>' . $row["ProgramID"] . '</td>
                                                <td>' . $row["Assigned"] . '</td>
                                                <td>' . $row["Note"] . '</td>
                                                <td>' . $row["AssignDate"] . '</td>
                                                <td>
                                                <button class="btn btn-secondary">
                                                    <a class="text-light text-decoration-none" href="?tag=status&op=edit&id=' . $row['StudentStatusID'] . '">Edit</a>
                                                </button>                                            
                                            </td>

                                            <td>
                                                <button class="btn btn-danger">
                                                <a  onclick="return confirm(\'Are you sure you want to delete this item?\');" href="?tag=status&op=del&id=' . $row['StudentStatusID'] . '" class="text-light text-decoration-none">Delete</a>                                                </button>
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