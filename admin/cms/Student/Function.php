<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    
    require("./connect.php");
    function Insert()
{
    global $conn;

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST["btn_sub"])) {
       

        $namekhmer = $_POST['namekhmer_txt'];
        $namelatin = $_POST['namelatin_txt'];
        $familyname = $_POST['familyname_txt'];
        $givenname = $_POST['givenname_txt'];
        $gender = $_POST['gender_txt'];
        $idpassport = $_POST['idpassport_txt'];
        $nationality = $_POST['nationality_txt'];
        $country = $_POST['country_txt'];
        $dob = $_POST['dob_txt'];
        $pob = $_POST['pob_txt'];
        $phonenumber = $_POST['phonenumber_txt'];
        $email = $_POST['email_txt'];
        $currentadrr = $_POST['currentadrr_txt'];
        $currentadrrPP = $_POST['currentadrrPP_txt'];
        $image = ""; // Initialize $image variable

        if ($_FILES['photo_txt']['size'] > 0) {
            $image = $_FILES['photo_txt']['name'];
            move_uploaded_file(
                $_FILES['photo_txt']['tmp_name'],
                "../../image/$image"
            );
        }

        if (!empty($namekhmer) && !empty($namelatin) && !empty($familyname) && !empty($givenname) && !empty($idpassport) && !empty($dob) && !empty($pob) && !empty($phonenumber) && !empty($email) && !empty($currentadrr) && !empty($currentadrrPP) ) {
            $sql_ins = "INSERT INTO studentinfo_tbl( `NameInKhmer`, `NameInLatin`, `FamilyName`, `GivenName`, `SexID`, `IDPassportNo`, `NationalityID`, `CountryID`, `DOB`, `POB`, `PhoneNumber`, `Email`, `CurrentAddress`, `CurrentAddressPP`, `Photo`)
      VALUES ('$namekhmer','$namelatin','$familyname','$givenname','$gender','$idpassport','$nationality', '$country' ,'$dob','$pob','$phonenumber','$email','$currentadrr' ,'$currentadrrPP' ,'$image')";
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
    function getSex(){
        global $conn;
        $sql = "SELECT * FROM sex_tbl ORDER BY SexID";
        $exec = mysqli_query($conn, $sql);
        while ($rw = mysqli_fetch_array($exec)) {
            $SexId= $rw['SexID'];
            $SexKh= $rw['SexKH'];
            echo '
                    <option value='.$SexId.'>
                               '.$SexKh.'
                    </option>
                ';
        }
    }
    

    
    
?>