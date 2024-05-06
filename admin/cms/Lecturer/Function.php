<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php

function Insert()
{
    require("./connect.php");
    global $conn;

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST["btn_sub"])) {
       

        $lecturer_name = $_POST['lecturer_name'];
        $image = ""; // Initialize $image variable

        if ($_FILES['photo_txt']['size'] > 0) {
            $image = $_FILES['photo_txt']['name'];
            move_uploaded_file(
                $_FILES['photo_txt']['tmp_name'],
                "../../lect_image/$image"
            );
        }
        
        if (!empty($lecturer_name) ) {
            $sql_ins = "INSERT INTO `lecturer_tbl`(`LecturerName`, `photo`) 
      VALUES ('$lecturer_name','$image')";
            $rs = $conn->query($sql_ins);
            if ($rs) {
                echo '
          <script>
          $(document).ready(function(){
              swal({
                  title: "Success!",
                  text: "Create Success",
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
                  text: "Create Failed",
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
              text: "Please Fill All Input",
              icon: "error",
              button: "Done",
          });
      });
      </script>
      ';
        }
    }
}
Insert();
?>