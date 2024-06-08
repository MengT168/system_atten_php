<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    
    $conn = mysqli_connect("localhost","root","","demo_db");
    function Insert()
{
    global $conn;

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST["btn_add"])) {
       

        $fathername = $_POST['fathername'];
        $fatherage = $_POST['fatherage'];
        $fathernationality = $_POST['fathernationality'];
        $fathercountry = $_POST['fathercountry'];
        $fatheroccupation = $_POST['fatheroccupation'];
        $mothername = $_POST['mothername'];
        $motherage = $_POST['motherage'];
        $mothernationality = $_POST['mothernationality'];
        $mothercountry = $_POST['mothercountry'];
        $motheroccupation = $_POST['motheroccupation'];
        $familycurrenaddress = $_POST['familycurrenaddress'];
        $spousename = $_POST['spousename'];
        $spouseage = $_POST['spouseage'];
        $guardianphonenumber = $_POST['guardianphonenumber'];
        $stuId = $_SESSION['id'];
        
        $sql_check= "SELECT * FROM familybackground_tbl WHERE studentId='$stuId'";
            $exec=mysqli_query($conn, $sql_check);
            $count=mysqli_num_rows($exec);

            if($count>0){
                echo '
                <script>
                $(document).ready(function(){
                    swal({
                        title: "Error!",
                        text: "Data already created",
                        icon: "error",
                        button: "Done",
                    });
                });
                </script>
                ';
            }
            else{
                if (!empty($fathername) && !empty($fatherage) && !empty($mothername) && !empty($motherage) && !empty($spousename) && !empty($spouseage) && !empty($guardianphonenumber) && !empty($familycurrenaddress)) {
                    $sql_ins = "INSERT INTO `familybackground_tbl`
                    (`FatherName`, `FatherAge`, `FatherNationalityID`, `FatherCountryID`, `FatherOccupationID`, `MotherName`, `MotherAge`, `MotherNationalityID`, `MotherCountryID`, `MotherOccupationID`, `FamilyCurrentAddress`, `SpouseName`, `SpouseAge`, `GuardianPhoneNumber`, `StudentID`) 
              VALUES ('$fathername','$fatherage','$fathernationality','$fathercountry','$fatheroccupation','$mothername','$motherage', '$mothernationality' ,'$mothercountry','$motheroccupation','$familycurrenaddress','$spousename','$spouseage' ,'$guardianphonenumber' ,'$stuId')";
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
}

Insert();

    function getCountry(){
        global $conn;
        $sql = "SELECT * FROM country_tbl ORDER BY CountryID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $CountryID= $rw['CountryID'];
            $CountryKH= $rw['CountryKH'];
            echo '
                    <option value='.$CountryID.'>
                               '.$CountryKH.'
                    </option>
                ';
        }
    }
    function getNationality(){
        global $conn;
        $sql = "SELECT * FROM nationality_tbl ORDER BY NationalityID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $NationalityId= $rw['NationalityID'];
            $NationalityKh= $rw['NationalityKH'];
            echo '
                    <option value='.$NationalityId.'>
                               '.$NationalityKh.'
                    </option>
                ';
        }
    }

    function getOccupation(){
        global $conn;
        $sql = "SELECT * FROM occupation_tbl ORDER BY OccupationID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $OccupationID= $rw['OccupationID'];
            $OccupationKH= $rw['OccupationKH'];
            echo '
                    <option value='.$OccupationID.'>
                               '.$OccupationKH.'
                    </option>
                ';
        }
    }
    
    
?>