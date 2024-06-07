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
        $email = $_POST['ShiftID'];
        $mobile = $_POST['DayWeekName'];
        $sqlCheck_dup = "SELECT * FROM dayweek_tbl WHERE ShiftID = '$email' AND DayWeekName = '$mobile'";
        $rs = $conn->query($sqlCheck_dup);

        if ($rs->num_rows > 0) {
            echo '
        <script>
        $(document).ready(function(){
            swal({
                title: "Error!",
                text: "Day Week Already Exists",
                icon: "error",
                button: "Done",
            });
        });
        </script>
        ';
        } else {
            if (!empty($email) && !empty($mobile)) {
                $sql = "INSERT INTO dayweek_tbl (ShiftID, DayWeekName) VALUES ('$email', '$mobile')";
                if (mysqli_query($conn, $sql)) {
                    echo '
                <script>
                $(document).ready(function(){
                    swal({
                        title: "Success!",
                        text: "Day Week Added Successfully",
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
                        text: "Failed to add Day Week",
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
                            <h5 class="card-title">Day Week Form</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div>
                                    <label class="form-label my-3">Please Select Shift</label>
                                    <select name="ShiftID" class="form-select" id="">
                                        <option value="">Select Shift</option>
                                        <?php
                                        $acad = mysqli_query($conn, "SELECT * FROM shift_tbl");
                                        while ($row = mysqli_fetch_array($acad)) {
                                        ?>
                                            <option value="<?php echo $row['ShiftID'] ?>"><?php echo $row['ShiftEN'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Day Week </label>
                                    <input type="text" class="form-control" name="DayWeekName" required />
                                </div>
                                <div class="text-center">
                                    <input type="submit" name="btn_sub" class="btn btn-primary">
                                    </input>

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