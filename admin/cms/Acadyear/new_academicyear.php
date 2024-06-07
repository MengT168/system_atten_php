<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
</head>

<body>
    <?php
    include_once 'connect.php';
    if (isset($_POST['btn_sub'])) {
        $AcademicYear = $_POST['AcademicYear'];
        $sqlCheck_dup = "SELECT * FROM academicyear_tbl WHERE AcademicYear = '$AcademicYear'";
        $rs = $conn->query($sqlCheck_dup);

        if ($rs->num_rows > 0) {
            echo '
        <script>
        $(document).ready(function(){
            swal({
                title: "Error!",
                text: "Academic Year Already Exists",
                icon: "error",
                button: "Done",
            });
        });
        </script>
        ';
        } else {
            if (!empty($AcademicYear)) {
                $sql = "INSERT INTO academicyear_tbl (AcademicYear) VALUES ('$AcademicYear')";
                if (mysqli_query($conn, $sql)) {
                    echo '
                <script>
                $(document).ready(function(){
                    swal({
                        title: "Success!",
                        text: "Academic Year Added Successfully",
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
                    text: "Please enter the Academic Year",
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


    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Academic Year Form</h5>

                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div class="col-12">
                                    <label class="form-label">Enter Academic Year</label>
                                    <input type="text" class="form-control" name="AcademicYear" required />
                                </div>
                                <div class="text-center">
                                    <input type="submit" name="btn_sub" class="btn btn-primary" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>