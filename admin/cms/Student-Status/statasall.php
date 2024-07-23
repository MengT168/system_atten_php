<?php require('Function2.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Attendance Table</h5>
                        <div class="row g-2">
                            <div class="col-3">
                                <label class="form-label">Program</label>
                                <select id="program" name="academicpro" class="form-select">
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

<script>
    document.getElementById('searchBtn').addEventListener('click', function(event) {
        event.preventDefault(); 

        // Get the selected values
        var program = document.getElementById('program').value;
        
        // Construct the URL with the selected values
        var url = '?tag=new1&op=search';
        url += '&program=' + encodeURIComponent(program);
        
        window.location.href = url;
    });
</script>

<?php
if (isset($_GET['op']) && $_GET['op'] == 'search' && isset($_GET['tag']) && $_GET['tag'] == 'new1') {
    $program = isset($_GET['program']) ? $_GET['program'] : '';
    include_once 'connect.php';

    if (isset($_POST['insert'])) {
        $sourceProgramID = $program;
        $targetProgramID = $_POST['target_program'];
        $assigned = $_POST['assign'];
        $note = $_POST['note'];
        $assignDate = date('Y-m-d H:i:s');

        $fetchQuery = "SELECT StudentID FROM studentstatus_tbl WHERE ProgramID = '$sourceProgramID'";
        $fetchResult = mysqli_query($conn, $fetchQuery);
        if (!$fetchResult) {
            die("Invalid query: " . mysqli_error($conn));
        }

        while ($row = mysqli_fetch_assoc($fetchResult)) {
            $studentID = $row['StudentID'];

            if (isset($_POST['check_' . $studentID])) {
                $checkQuery = "SELECT * FROM studentstatus_tbl WHERE StudentID = '$studentID' AND ProgramID = '$targetProgramID'";
                $checkResult = mysqli_query($conn, $checkQuery);
                if (mysqli_num_rows($checkResult) == 0) {
                    $insertQuery = "INSERT INTO studentstatus_tbl (StudentID, ProgramID, Assigned, Note, AssignDate) VALUES ('$studentID', '$targetProgramID', '$assigned', '$note', '$assignDate')";
                    if (!mysqli_query($conn, $insertQuery)) {
                        echo '
                        <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error!",
                                text: "Failed to insert records: ' . mysqli_error($conn) . '",
                                icon: "error",
                                button: "Ok",
                            });
                        });
                        </script>
                        ';
                    } else {
                        echo '
                        <script>
                        $(document).ready(function(){
                            swal({
                                title: "Success!",
                                text: "Records inserted successfully",
                                icon: "success",
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

    $query = "SELECT * FROM `studentstatus_tbl` 
        INNER JOIN program_tbl ON studentstatus_tbl.ProgramID = program_tbl.ProgramID
        INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID
        INNER JOIN major_tbl ON program_tbl.MajorID = major_tbl.MajorID
        INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
        INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID
        INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
    WHERE studentstatus_tbl.ProgramID = $program";

    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Invalid query: " . mysqli_error($conn));
    }
?>
<main id="main" class="main" style="margin-top: -30px;">
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="row g-3" method="post" enctype="multipart/form-data">
                            <table class="table table-striped" cellpadding="2">
                                <thead>
                                    <tr>
                                        <th scope="col">Student ID</th>
                                        <th scope="col">Program ID</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Major</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Shift</th>
                                        <th scope="col">Assigned</th>
                                        <th scope="col">Note</th>
                                        <th scope="col">AssignDate</th>
                                        <th scope="col">Check</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row["StudentID"]; ?></td>
                                        <td><?php echo $row["ProgramID"]; ?></td>
                                        <td><?php echo $row["NameInLatin"]; ?></td>
                                        <td><?php echo $row["MajorEN"]; ?></td>
                                        <td><?php echo $row["SemesterEN"]; ?></td>
                                        <td><?php echo $row["YearEN"]; ?></td>
                                        <td><?php echo $row["ShiftEN"]; ?></td>
                                        <td><input class="form-control" type="text" name="assign" value="<?php echo $row["Assigned"]; ?>"></td>
                                        <td><input class="form-control" type="text" name="note" value="<?php echo $row["Note"]; ?>"></td>
                                        <td><?php echo $row["AssignDate"]; ?></td>
                                        <td><input type="checkbox" class="form-check" name="check_<?php echo $row["StudentID"]; ?>" checked ></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            
                            <select id="program" name="target_program" class="form-select">
                                    <option value="">Select One</option>
                                    <?php getProgram(); ?>
                                </select>
                           
                            <button class="btn btn-primary" name="insert" type="submit">Insert</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
}
?>
</body>
</html>
