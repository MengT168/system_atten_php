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
        $email = $_POST['OccupationKH'];
        $mobile = $_POST['OccupationEN'];
        $sqlCheck_dup = "SELECT * FROM occupation_tbl WHERE OccupationKH = '$email' AND OccupationEN = '$mobile'";
        $rs = $conn->query($sqlCheck_dup);

        if ($rs->num_rows > 0) {
            echo '
        <script>
        $(document).ready(function(){
            swal({
                title: "Error!",
                text: "Occupation Already Exists",
                icon: "error",
                button: "Done",
            });
        });
        </script>
        ';
        } else {
            if (!empty($email) && !empty($mobile)) {
                $sql = "INSERT INTO occupation_tbl (OccupationKH, OccupationEN) VALUES ('$email', '$mobile')";
                if (mysqli_query($conn, $sql)) {
                    echo '
                <script>
                $(document).ready(function(){
                    swal({
                        title: "Success!",
                        text: "Occupation Added Successfully",
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
                        text: "Failed to add Occupation",
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
                            <h5 class="card-title">Occupation Form</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div class="col-12">
                                    <label class="form-label">Occupation Name(Kh)</label>
                                    <input type="text" class="form-control" name="OccupationKH" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Occupation Name(En)</label>
                                    <input type="text" class="form-control" name="OccupationEN" required />
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