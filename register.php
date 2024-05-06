<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    session_start();
    require("./admin/cms/connect.php");
  

    if(isset($_POST['btnsignUp'])){
        $uname = $_POST['userName'];
        $pass = md5($_POST['password']);
        $stuId = $_POST['stuId'];

        // Check if studentId exists in studentinfo_tbl
        $sql_check_id = "SELECT StudentID FROM studentinfo_tbl WHERE StudentID = '$stuId'";
        $result = $conn->query($sql_check_id);

        if($result && $result->num_rows > 0){
            // If studentId exists
            $sql_check= "SELECT * FROM student_login_tbl WHERE studentId='$stuId'";
            $exec=mysqli_query($conn, $sql_check);
            $count=mysqli_num_rows($exec);

            if($count > 0){
                // If studentId already exists in student_login_tbl
                echo '
                <script>
                $(document).ready(function(){
                    swal({
                        title: "Error!",
                        text: "Student ID Already Exists",
                        icon: "error",
                        button: "Done",
                    });
                });
                </script>
                ';
            }
            else{
                // If studentId doesn't exist, proceed with registration
                $sql_ins = "INSERT INTO `student_login_tbl`(`username`, `password`, `studentId`) VALUES ('$uname','$pass','$stuId')";
                $exec = mysqli_query($conn, $sql_ins);
                if ($exec) {
                    echo '
                    <script>
                    $(document).ready(function(){
                        swal({
                            title: "Success!",
                            text: "Registration Successful",
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
                            text: "Registration Failed",
                            icon: "error",
                            button: "Done",
                        });
                    });
                    </script>
                    ';
                }  
            }
        } else {
            // If studentId does not exist in studentinfo_tbl
            echo '
            <script>
            $(document).ready(function(){
                swal({
                    title: "Error!",
                    text: "Invalid Student ID",
                    icon: "error",
                    button: "Done",
                });
            });
            </script>
            ';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    /* Importing fonts from Google */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

/* Reseting */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: #ecf0f3;
}

.wrapper {
    max-width: 350px;
    min-height: 500px;
    margin: 80px auto;
    padding: 40px 30px 30px 30px;
    background-color: #ecf0f3;
    border-radius: 15px;
    box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
}

.logo {
    width: 80px;
    margin: auto;
}

.logo img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0px 0px 3px #5f5f5f,
        0px 0px 0px 5px #ecf0f3,
        8px 8px 15px #a7aaa7,
        -8px -8px 15px #fff;
}

.wrapper .name {
    font-weight: 600;
    font-size: 1.4rem;
    letter-spacing: 1.3px;
    padding-left: 10px;
    color: #555;
}

.wrapper .form-field input {
    width: 100%;
    display: block;
    border: none;
    outline: none;
    background: none;
    font-size: 1.2rem;
    color: #666;
    padding: 10px 15px 10px 10px;
    /* border: 1px solid red; */
}

.wrapper .form-field {
    padding-left: 10px;
    margin-bottom: 20px;
    border-radius: 20px;
    box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
}

.wrapper .form-field .fas {
    color: #555;
}

.wrapper .btn {
    box-shadow: none;
    width: 100%;
    height: 40px;
    background-color: #03A9F4;
    color: #fff;
    border-radius: 25px;
    box-shadow: 3px 3px 3px #b1b1b1,
        -3px -3px 3px #fff;
    letter-spacing: 1.3px;
}

.wrapper .btn:hover {
    background-color: #039BE5;
}

.wrapper a {
    text-decoration: none;
    font-size: 0.8rem;
    color: #03A9F4;
}

.wrapper a:hover {
    color: #039BE5;
}

@media(max-width: 380px) {
    .wrapper {
        margin: 30px 20px;
        padding: 40px 15px 15px 15px;
    }
}
</style>
<body>
<div class="wrapper">
        <div class="logo">
            <img src="https://www.adobe.com/content/dam/cc/us/en/creativecloud/design/discover/mascot-logo-design/mascot-logo-design_fb-img_1200x800.jpg" alt="">
        </div>
        <div class="text-center mt-4 name">
            Student SignUp
        </div>
        <form class="p-3 mt-3" method="post" >
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="userName" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="text" name="stuId" id="stuId" placeholder="Student ID">
            </div>
            <input type="submit" class="btn mt-3" name="btnsignUp" value="SIGN UP" >
        </form>
        <div style="display: flex; justify-content: center; " >
        <a href="./index.php" style="text-align: center;" >Login now</a>
        </div>
    </div>
</body>
</html>