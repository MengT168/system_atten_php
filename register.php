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
</head>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

:root{
   --blue:#3498db;
   --red:#e74c3c;
   --orange:#f39c12;
   --black:#333;
   --white:#fff;
   --light-bg:#eee;
   --box-shadow:0 5px 10px rgba(0,0,0,.1);
   --border:2px solid var(--black);
}

*{
   font-family: 'Poppins', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border: none;
   text-decoration: none;
}

*::-webkit-scrollbar{
   width: 10px;
   height: 5px;
}

*::-webkit-scrollbar-track{
   background-color: transparent;
}

*::-webkit-scrollbar-thumb{
   background-color: var(--blue);
}

body{
   background-color: var(--light-bg);
}

.btn,
.delete-btn,
.option-btn{
   display: inline-block;
   padding:10px 30px;
   cursor: pointer;
   font-size: 18px;
   color:var(--white);
   border-radius: 5px;
   text-transform: capitalize;
}

.btn:hover,
.delete-btn:hover,
.option-btn:hover{
   background-color: var(--black);
}

.btn{
   background-color: var(--blue);
   margin-top: 10px;
}

.option-btn{
   background-color: var(--orange);
}

.form-container{
   min-height: 100vh;
   display: flex;
   align-items: center;
   justify-content: center;
   padding:20px;
   padding-bottom: 70px;
}

.form-container form{
   width: 500px;
   border-radius: 5px;
   border:var(--border);
   padding:20px;
   text-align: center;
   background-color: var(--white);
}

.form-container form h3{
   font-size: 30px;
   margin-bottom: 10px;
   text-transform: uppercase;
   color:var(--black);
}

.form-container form .box{
   width: 100%;
   border-radius: 5px;
   border:var(--border);
   padding:12px 14px;
   font-size: 18px;
   margin:10px 0;
}

.form-container form p{
   margin-top: 20px;
   font-size: 20px;
   color:var(--black);
}

.form-container form p a{
   color:var(--red);
}

.form-container form p a:hover{
   text-decoration: underline;
}
.logo{
   width: 30%;
}
</style>
<body>
<div class="form-container">  
   <form action="" method="post">
   <img src="./image/School.png" alt="Logo" class="logo">
      <h1>Student SignUp</h1>
      <input type="text" name="userName" id="userName" required placeholder="enter username" class="box">
      <input type="password" name="password" id="pwd" required placeholder="enter password" class="box">
      <input type="text" name="stuId" id="stuId" required placeholder="enter Student ID" class="box">
     
      <input type="submit" name="btnsignUp" class="btn" value="SIGN UP">
      <p>already have an account? <a href="./index.php">login now</a></p>
   </form>

</div>
</body>
</html>