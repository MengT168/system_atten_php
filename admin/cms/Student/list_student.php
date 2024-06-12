<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
require("./connect.php");

$op="";
$id="";
global $conn;
if(isset($_GET[ 'op']))
$op=$_GET['op'];

if(isset($_GET[ 'id']))
$id=$_GET['id'];



if ($op == 'del') {
    $del = "DELETE FROM studentinfo_tbl WHERE StudentID=$id";
    
    $exec = mysqli_query($conn, $del);
    if ($exec)
       {
        echo '
        <script>
        $(document).ready(function(){
            swal({
                title: "Success!",
                text: "Detete Success",
                icon: "success",
                button: "Done",
            });
        });
        </script>
        ';
       }
    else
        $msg = "Delete Error: " . mysqli_error($conn);
}

if ($op == 'del1') {
  $del = "DELETE FROM program_tbl WHERE StudentID=$id";
  
  $exec = mysqli_query($conn, $del);
  if ($exec)
     {
      echo '
      <script>
      $(document).ready(function(){
          swal({
              title: "Success!",
              text: "Detete Success",
              icon: "success",
              button: "Done",
          });
      });
      </script>
      ';
     }
  else
      $msg = "Delete Error: " . mysqli_error($conn);
}


if (isset($_POST['btn_save'])) {
    // Retrieve form data
    $firstName = $_POST['txt_first'];
    $lastName = $_POST['txt_last'];
    $username = $_POST['txt_username'];
    $password = md5($_POST['txt_pass']);
    $gender = $_POST['txt_gender'];
    $address = $_POST['txt_address'];
    $year = $_POST['txt_year'];
    $semester = $_POST['txt_semester'];
    $major = $_POST['txt_major'];
    $shift = $_POST['txt_shift'];
    $faculty = $_POST['txt_faculty'];
    $image = isset($_FILES['src_txt']) ? $_FILES['src_txt']['name'] : "";

    // Check if image is uploaded
    if ($image) {
        $image = $_FILES['src_txt']['name'];
        move_uploaded_file($_FILES['src_txt']['tmp_name'], "../../images/$image");
    }

    // Prepare SQL update statement
    $sql_update = "UPDATE student_tbl SET
                        firstName='$firstName',
                        lastName='$lastName',
                        userName='$username',
                        password='$password',
                        gender='$gender',
                        yearId='$year',
                        semesterId='$semester',
                        facultyId='$faculty',
                        majorId='$major',
                        shiftId='$shift',
                        address='$address'";
    
    // Include image update in SQL statement if an image is uploaded
    if ($image) {
        $sql_update .= ", src='$image'";
    }

    $sql_update .= " WHERE id=$id";

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

<?php
 if($op == 'view'){
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php require('Function_Fetch.php'); ?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Serif+Khmer:wght@100..900&display=swap');
.A{
    font-family: "Noto Serif Khmer", serif;
}
</style>
<script>
    // Get the input element
    var dateInput = document.getElementById('dateInput');

    // Add an event listener to listen for changes in the input value
    dateInput.addEventListener('change', function() {
        // Get the value of the input
        var inputValue = this.value;
        
        // Split the input value into parts (year, month, day)
        var parts = inputValue.split('-');
        
        // Rearrange the parts into the desired format
        var formattedDate = parts[0] + '-' + parts[1] + '-' + parts[2];

        // Update the input value with the new format
        this.value = formattedDate;
    });
</script>
<script>
        function updateMajorList(facultytxt) {
            $.ajax({
                url: 'FetchFacul_listStu.php',
                type: 'POST',
                data: { facultyID: facultytxt },
                success: function(response) {
                    $('select[name="majortxt"]').html(response);
                },
                error: function() {
                    alert('Error fetching majors');
                }
            });
        }
    </script>

<main id="main" class="main">

<div class="pagetitle">
  <h1>Student Information</h1>
  <!-- <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Profile</li>
    </ol>
  </nav> -->
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-xl-3">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        <?php
        
        $conn = mysqli_connect("localhost","root","","demo_db");
    $sql="SELECT * FROM studentinfo_tbl WHERE StudentId = '$id' ";
    $rs=$conn->query($sql);
    while($row = mysqli_fetch_assoc($rs)){
?>
            
          <img src="../../image/<?php echo $row['Photo'] ?>" alt="Profile" class="rounded-circle">
          <h2><?php echo $row['NameInLatin'] ?></h2>
          <h3>Student</h3>
         <?php
    }
         ?>
        </div>
      </div>

    </div>

    <div class="col-xl-9">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
            </li>
            <?php
                          $conn = mysqli_connect("localhost","root","","demo_db");
                          
                            $sql = "SELECT StudentID FROM familybackground_tbl WHERE StudentID = '$id'";
                            $exec=mysqli_query($conn, $sql);
                          $count=mysqli_num_rows($exec);

                          if($count>0){
                echo '';
                          }else{
                            ?>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Family Background</button>
            </li>
            <?php } ?>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Family Background</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-passwor">Edit Family Background</button>
            </li>
            <!-- <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-setting">Program</button>
            </li> -->
            <!-- <?php
                    $conn = mysqli_connect("localhost", "root", "", "demo_db");

                    // Assuming $id is the student ID you want to check
                    $id = mysqli_real_escape_string($conn, $id); // Sanitize the input to prevent SQL injection

                    $sql = "SELECT StudentID FROM educationalbackground_tbl WHERE StudentID = '$id' UNION SELECT StudentID FROM studentstatus_tbl WHERE StudentID = '$id'";
                    $exec = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($exec);

                    if ($count > 0) {
                        // Student with the given ID exists
                        echo '';
                    } else {
                        // Student with the given ID does not exist
                        ?>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settin">Student Status</button>
                        </li>
                <?php } ?> -->
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-set">Status View</button>
            </li>
            <!-- <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile">Manage Status</button>
            </li> -->
            <!-- <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pr">Manage Educational Background</button>
            </li> -->

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              <!-- <h5 class="card-title">About</h5>
              <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

              <h5 class="card-title">Profile Details</h5>
                <?php
               
                
             $sql="SELECT StudentID , NameInKhmer , NameInLatin , FamilyName , GivenName , SexKH , SexEN , IDPassportNo , NationalityKH , NationalityEN , CountryKH , CountryEN , DOB , POB , PhoneNumber , Email , CurrentAddress , CurrentAddressPP , RegisterDate  FROM `studentinfo_tbl` 
             INNER JOIN sex_tbl on studentinfo_tbl.SexID = sex_tbl.SexID
             INNER JOIN country_tbl ON studentinfo_tbl.CountryID = country_tbl.CountryID
             INNER JOIN nationality_tbl ON studentinfo_tbl.NationalityID = nationality_tbl.NationalityID WHERE StudentId = '$id' ";
             $rs=$conn->query($sql);
                    while($rw = mysqli_fetch_assoc($rs)){
                ?>
              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Name In Khmer</div>
                <div class="col-lg-9 col-md-8 A" ><h4><?php echo $rw['NameInKhmer'] ?></h4></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Name In Latin</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['NameInLatin'] ?></h6></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Family Name</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['FamilyName'] ?></h6></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Given Name</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['GivenName'] ?></h6></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Gender</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['SexKH'] ?>/<?php echo $rw['SexEN'] ?></h6></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">ID Passport</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['IDPassportNo'] ?></h6></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Nationality</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['NationalityKH'] ?>/<?php echo $rw['NationalityEN'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Country</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['CountryKH'] ?>/<?php echo $rw['CountryEN'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Date Of Birth</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['DOB'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Place Of Birth</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['POB'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Phone Number</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['PhoneNumber'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['Email'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Current Address</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['CurrentAddress'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Current Address PP</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['CurrentAddressPP'] ?></h6></div>
              </div>
               
            </div>
            <?php } ?>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                      <?php
                        $sql="SELECT StudentID , NameInKhmer , NameInLatin , FamilyName , GivenName , sex_tbl.SexID , SexKH , SexEN , IDPassportNo , nationality_tbl.NationalityID , NationalityKH , NationalityEN , country_tbl.CountryID , CountryKH , CountryEN , DOB , POB , PhoneNumber , Email , CurrentAddress , CurrentAddressPP , RegisterDate , Photo  FROM `studentinfo_tbl` 
                        INNER JOIN sex_tbl on studentinfo_tbl.SexID = sex_tbl.SexID
                        INNER JOIN country_tbl ON studentinfo_tbl.CountryID = country_tbl.CountryID
                        INNER JOIN nationality_tbl ON studentinfo_tbl.NationalityID = nationality_tbl.NationalityID WHERE StudentId = '$id' ";
                        $rs=$conn->query($sql);
                               while($row = mysqli_fetch_assoc($rs)){
                      ?>
              <!-- Profile Edit Form -->
              <form method="post" enctype="multipart/form-data" >
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
        <img id="profileImage" src="../../image/<?php echo $row['Photo'] ?>" alt="Profile" class="rounded-circle">
        <div class="pt-2">
          <!-- <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"  onclick="uploadProfileImage()"><i class="bi bi-upload"></i></a>
          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image" onclick="removeProfileImage()"><i class="bi bi-trash"></i></a> -->
          <input type="file" class="form-control" name="photo" />
        </div>
      </div>
      
                </div>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Name In Khmer</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="namekhmer_txt" type="text" class="form-control" id="fullName" value="<?php echo $row['NameInKhmer'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label">Name In Latin</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="namelatin_txt" type="text" class="form-control" id="company" value="<?php echo $row['NameInLatin'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="company" class="col-md-4 col-lg-3 col-form-label">Faminy Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="familyname_txt" type="text" class="form-control" id="company" value="<?php echo $row['FamilyName'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Job" class="col-md-4 col-lg-3 col-form-label">Given Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="givenname_txt" type="text" class="form-control" id="Job" value="<?php echo $row['GivenName'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                      <div class="col-md-8 col-lg-9">
                      <select name="gender_txt" id="" class="form-select" >
                                   <?php
                                    $sql="SELECT * FROM sex_tbl ORDER BY SexID";
                                    $exec=mysqli_query($conn,$sql);
                                    while($rw=mysqli_fetch_array($exec)){
                                    ?>
                                        <option value="<?php echo $rw['SexID'];?>" 
                                            <?php if($rw['SexID']==$row['SexID']) echo "selected";?>>
                                            
                                            <?php echo $rw['SexKH']?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                   </select>
                      </div>
                  </div>

                <div class="row mb-3">
                  <label for="Address" class="col-md-4 col-lg-3 col-form-label">Id Passport</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="idpassport_txt" type="text" class="form-control" id="Address" value="<?php echo $row['IDPassportNo'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Nationality</label>
                  <div class="col-md-8 col-lg-9">
                  <select name="nationality_txt" id="gender" class="form-select">
                          <?php
                          $sql = "SELECT * FROM nationality_tbl ORDER BY NationalityId";
                          $exec = mysqli_query($conn, $sql);
                          while ($rw = mysqli_fetch_array($exec)) {
                            $selected = ($rw['NationalityID'] == $row['NationalityID']) ? 'selected' : "";
                            ?>
                            <option value="<?php echo $rw['NationalityID']; ?>" <?php echo $selected; ?>>
                              <?php echo $rw['NationalityKH']; ?>
                            </option>
                          <?php
                          }
                          ?>
                        </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Email" class="col-md-4 col-lg-3 col-form-label">Country</label>
                  <div class="col-md-8 col-lg-9">
                  <select name="country_txt" id="gender" class="form-select">
                          <?php
                          $sql = "SELECT * FROM country_tbl ORDER BY CountryID";
                          $exec = mysqli_query($conn, $sql);
                          while ($rw = mysqli_fetch_array($exec)) {
                            $selected = ($rw['CountryID'] == $row['CountryID']) ? "selected" : "";
                            ?>
                            <option value="<?php echo $rw['CountryID']; ?>" <?php echo $selected; ?>>
                              <?php echo $rw['CountryKH']; ?>
                            </option>
                          <?php
                          }
                          ?>
                        </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Date Of Birth</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="dob_txt" type="date" class="form-control" id="dateInput" value="<?php echo $row['DOB'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Place Of Birth</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="pob_txt" type="text" class="form-control" id="Facebook" value="<?php echo $row['POB'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="phone_txt" type="text" class="form-control" id="Instagram" value="<?php echo $row['PhoneNumber'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Email</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="email_txt" type="text" class="form-control" id="Linkedin" value="<?php echo $row['Email'] ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Current Address</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="currentaddr_txt" type="text" class="form-control" id="Linkedin" value="<?php echo $row['CurrentAddress'] ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Current Address PP</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="currentaddrPP_txt" type="text" class="form-control" id="Linkedin" value="<?php echo $row['CurrentAddressPP'] ?>">
                  </div>
                </div>
                      <?php } ?>
                <div class="text-center">
                  <!-- <button type="submit" class="btn btn-primary" name="btn_up" >Save Changes</button> -->
                  <input type="submit" class="btn btn-primary" value="Save Changes" name="btn_up">
                </div>
              </form><!-- End Profile Edit Form -->

            </div>
                          <!-- Check -->
                          <?php
                          $conn = mysqli_connect("localhost","root","","demo_db");
                          
                            $sql = "SELECT StudentID FROM familybackground_tbl  WHERE StudentID = '$id'";
                            $exec=mysqli_query($conn, $sql);
                          $count=mysqli_num_rows($exec);

                          if($count>0){
                echo '<div class="tab-pane fade pt-3"  id="profile-settings">Data already created</div>';
                          }else{
                          ?>
                          
            <div class="tab-pane fade pt-3" id="profile-settings">

            <form method="post" enctype="multipart/form-data" >

<div class="row mb-3">
  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Father Name</label>
  <div class="col-md-8 col-lg-9">
    <input name="fathername" type="text" class="form-control" id="currentPassword">
  </div>
</div>

<div class="row mb-3">
  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Father Age</label>
  <div class="col-md-8 col-lg-9">
    <input name="fatherage" type="text" class="form-control" id="newPassword">
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Father Nationality</label>
  <div class="col-md-8 col-lg-9">
    <select name="fathernationality" class="form-select" id="">
    <?php getNationality();  ?>
    </select>
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Father Country</label>
  <div class="col-md-8 col-lg-9">
    <select name="fathercountry" class="form-select" id="">
    <?php getCountry();  ?>
    </select>
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Father Occupation</label>
  <div class="col-md-8 col-lg-9">
    <select name="fatheroccupation" class="form-select" id="">
    <?php getOccupation();  ?>
    </select>
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Mother Name</label>
  <div class="col-md-8 col-lg-9">
    <input name="mothername" type="text" class="form-control" id="renewPassword">
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Mother Age</label>
  <div class="col-md-8 col-lg-9">
    <input name="motherage" type="text" class="form-control" id="renewPassword">
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Mother Nationality</label>
  <div class="col-md-8 col-lg-9">
    <select name="mothernationality" class="form-select" id="">
    <?php getNationality();  ?>
    </select>
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Mother Country</label>
  <div class="col-md-8 col-lg-9">
    <select name="mothercountry" class="form-select" id="">
    <?php getCountry();  ?>
    </select>
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Mother Occupation</label>
  <div class="col-md-8 col-lg-9">
    <select name="motheroccupation" class="form-select" id="">
    <?php getOccupation();  ?>
    </select>
</div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Family Currentaddress</label>
  <div class="col-md-8 col-lg-9">
  <input name="familycurrenaddress" type="text" class="form-control" id="renewPassword">
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Spouse Name</label>
  <div class="col-md-8 col-lg-9">
    <input name="spousename" type="text" class="form-control" id="renewPassword">
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Spouse Age</label>
  <div class="col-md-8 col-lg-9">
    <input name="spouseage" type="text" class="form-control" id="renewPassword">
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Guardian Phonenumber</label>
  <div class="col-md-8 col-lg-9">
    <input name="guardianphonenumber" type="text" class="form-control" id="renewPassword">
  </div>
</div>


<div class="text-center">
  <button type="submit" class="btn btn-primary" name="btn_add" >Add</button>
</div>
</form>

            </div>
            <?php } ?>
            <!-- Family Background View -->
            <div class="tab-pane fade show  profile-overview"id="profile-change-password">
            <h5 class="card-title">Family Background Details</h5>
                <?php
                
             $sql="SELECT * FROM familybackground_tbl
             INNER JOIN country_tbl on familybackground_tbl.FatherCountryID = country_tbl.CountryID
             INNER JOIN nationality_tbl ON familybackground_tbl.FatherNationalityID = nationality_tbl.NationalityID
             INNER JOIN occupation_tbl ON familybackground_tbl.FatherOccupationID = occupation_tbl.OccupationID WHERE StudentId = '$id' ";
             $rs=$conn->query($sql);
                    while($rw = mysqli_fetch_assoc($rs)){
                ?>
              <div class="row ">
                <div class="col-lg-4 col-md-4 label ">Father Name</div>
                <div class="col-lg-8 col-md-8 A" ><h6><?php echo $rw['FatherName'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-4 label">Father Age</div>
                <div class="col-lg-8 col-md-8"><h6><?php echo $rw['FatherAge'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-4 label">Father Nationality</div>
                <?php
                   $sql="SELECT * FROM nationality_tbl";
                   $rs=$conn->query($sql);
                    while($rw1 = mysqli_fetch_assoc($rs)){
                ?>
                <div class="col-lg-8 col-md-8"><h6><?php if($rw1['NationalityID'] == $rw['FatherNationalityID']) echo $rw1['NationalityEN'] ?></h6></div>
                <?php } ?>
              </div>
              

              <div class="row">
                <div class="col-lg-4 col-md-4 label">Father Country</div>
                <?php
                   $sql="SELECT * FROM country_tbl";
                   $rs=$conn->query($sql);
                    while($rw1 = mysqli_fetch_assoc($rs)){
                ?>
                <div class="col-lg-8 col-md-8"><h6><?php if($rw1['CountryID'] == $rw['FatherCountryID']) echo $rw1['CountryEN'] ?></h6></div>
                <?php } ?>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label">Father Occupation</div>
                <?php
                   $sql="SELECT * FROM occupation_tbl";
                   $rs=$conn->query($sql);
                    while($rw1 = mysqli_fetch_assoc($rs)){
                ?>
                <div class="col-lg-8 col-md-8"><h6><?php if($rw1['OccupationID'] == $rw['FatherOccupationID']) echo $rw1['OccupationEN'] ?></h6></div>
                <?php } ?>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label">Mother Name</div>
                <div class="col-lg-8 col-md-8"><h6><?php echo $rw['MotherName'] ?></h6></div>
              </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 label">Mother Age</div>
                <div class="col-lg-8 col-md-8"><h6><?php echo $rw['MotherAge'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-4 label">Mother Nationality</div>
                <?php
                   $sql="SELECT * FROM nationality_tbl";
                   $rs=$conn->query($sql);
                    while($rw1 = mysqli_fetch_assoc($rs)){
                ?>
                <div class="col-lg-8 col-md-8"><h6><?php if($rw1['NationalityID'] == $rw['MotherNationalityID']) echo $rw1['NationalityEN'] ?></h6></div>
                <?php } ?>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-4 label">Mother Country</div>
                <?php
                   $sql="SELECT * FROM country_tbl";
                   $rs=$conn->query($sql);
                    while($rw1 = mysqli_fetch_assoc($rs)){
                ?>
                <div class="col-lg-8 col-md-8"><h6><?php if($rw1['CountryID'] == $rw['MotherCountryID']) echo $rw1['CountryEN'] ?></h6></div>
                <?php } ?>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-4 label">Mother Occupation</div>
                <?php
                   $sql="SELECT * FROM occupation_tbl";
                   $rs=$conn->query($sql);
                    while($rw1 = mysqli_fetch_assoc($rs)){
                ?>
                <div class="col-lg-8 col-md-8"><h6><?php if($rw1['OccupationID'] == $rw['MotherOccupationID']) echo $rw1['OccupationEN'] ?></h6></div>
                <?php } ?>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-4 label">Familty Current Address</div>
                <div class="col-lg-8 col-md-8"><h6><?php echo $rw['FamilyCurrentAddress'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-4 label">Spouse Name</div>
                <div class="col-lg-8 col-md-8"><h6><?php echo $rw['SpouseName'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-4 label">Spouse Age</div>
                <div class="col-lg-8 col-md-8"><h6><?php echo $rw['SpouseAge'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-md-4 label">Phone Number</div>
                <div class="col-lg-8 col-md-8"><h6><?php echo $rw['GuardianPhoneNumber'] ?></h6></div>
              </div>
              <?php } ?>       
            </div>
            <!-- Update Family Background -->
            <div class="tab-pane fade pt-3" id="profile-change-passwor">
              <!-- Update Family Background -->
              <?php
                        $sql="SELECT * FROM familybackground_tbl
                        INNER JOIN country_tbl on familybackground_tbl.FatherCountryID = country_tbl.CountryID
                        INNER JOIN nationality_tbl ON familybackground_tbl.FatherNationalityID = nationality_tbl.NationalityID
                        INNER JOIN occupation_tbl ON familybackground_tbl.FatherOccupationID = occupation_tbl.OccupationID WHERE StudentId = '$id'  ";
                        $rs=$conn->query($sql);
                               while($row = mysqli_fetch_assoc($rs)){
                      ?>
              <form method="post" enctype="multipart/form-data" >

                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Father Name </label>
                  <div class="col-md-8 col-lg-9">
                    <input name="fathername" type="text" class="form-control" value="<?php echo $row['FatherName'] ?>" >
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Father Age</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="fatherage" type="text" class="form-control" value="<?php echo $row['FatherAge'] ?>">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Father Nationality</label>
                  <div class="col-md-8 col-lg-9">
                  <select name="fathernationaity" id="" class="form-select" >
                                   <?php
                                    $sql="SELECT * FROM nationality_tbl ORDER BY NationalityID";
                                    $exec=mysqli_query($conn,$sql);
                                    while($rw=mysqli_fetch_array($exec)){
                                    ?>
                                        <option value="<?php echo $rw['NationalityID'];?>" 
                                            <?php if($rw['NationalityID']==$row['FatherNationalityID']) echo "selected";?>>
                                            
                                            <?php echo $rw['NationalityKH']?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                   </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Father Country</label>
                  <div class="col-md-8 col-lg-9">
                  <select name="fathercounty" id="" class="form-select" >
                                   <?php
                                    $sql="SELECT * FROM country_tbl ORDER BY CountryID";
                                    $exec=mysqli_query($conn,$sql);
                                    while($rw=mysqli_fetch_array($exec)){
                                    ?>
                                        <option value="<?php echo $rw['CountryID'];?>" 
                                            <?php if($rw['CountryID']==$row['FatherCountryID']) echo "selected";?>>
                                            
                                            <?php echo $rw['CountryKH']?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                   </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Father Occupation</label>
                  <div class="col-md-8 col-lg-9">
                  <select name="fatheroccupation" id="" class="form-select" >
                                   <?php
                                    $sql="SELECT * FROM occupation_tbl ORDER BY OccupationID";
                                    $exec=mysqli_query($conn,$sql);
                                    while($rw=mysqli_fetch_array($exec)){
                                    ?>
                                        <option value="<?php echo $rw['OccupationID'];?>" 
                                            <?php if($rw['OccupationID']==$row['FatherOccupationID']) echo "selected";?>>
                                            
                                            <?php echo $rw['OccupationKH']?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                   </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Mother Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="mothername" type="text" value="<?php echo $row['MotherName'] ?>" class="form-control" id="renewPassword">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Mother Age</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="motherage" type="text" value="<?php echo $row['MotherAge'] ?>"   class="form-control" id="renewPassword">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Mother Nationality</label>
                  <div class="col-md-8 col-lg-9">
                  <select name="mothernationality" id="" class="form-select" >
                                   <?php
                                    $sql="SELECT * FROM nationality_tbl ORDER BY NationalityID";
                                    $exec=mysqli_query($conn,$sql);
                                    while($rw=mysqli_fetch_array($exec)){
                                    ?>
                                        <option value="<?php echo $rw['NationalityID'];?>" 
                                            <?php if($rw['NationalityID']==$row['MotherNationalityID']) echo "selected";?>>
                                            
                                            <?php echo $rw['NationalityKH']?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                   </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Mother Country</label>
                  <div class="col-md-8 col-lg-9">
                  <select name="mothercountry" id="" class="form-select" >
                                   <?php
                                    $sql="SELECT * FROM country_tbl ORDER BY CountryID";
                                    $exec=mysqli_query($conn,$sql);
                                    while($rw=mysqli_fetch_array($exec)){
                                    ?>
                                        <option value="<?php echo $rw['CountryID'];?>" 
                                            <?php if($rw['CountryID']==$row['MotherCountryID']) echo "selected";?>>
                                            
                                            <?php echo $rw['CountryKH']?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                   </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Mother Occupation</label>
                  <div class="col-md-8 col-lg-9">
                  <select name="motheroccupation" id="" class="form-select" >
                                   <?php
                                    $sql="SELECT * FROM occupation_tbl ORDER BY OccupationID";
                                    $exec=mysqli_query($conn,$sql);
                                    while($rw=mysqli_fetch_array($exec)){
                                    ?>
                                        <option value="<?php echo $rw['OccupationID'];?>" 
                                            <?php if($rw['OccupationID']==$row['MotherOccupationID']) echo "selected";?>>
                                            
                                            <?php echo $rw['OccupationKH']?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                   </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Family CurrentAddress</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="familtyaddr" type="text" value="<?php echo $row['FamilyCurrentAddress'] ?>" class="form-control" id="renewPassword">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Spouse Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="spousename" type="text" value="<?php echo $row['SpouseName'] ?>" class="form-control" id="renewPassword">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Spouse Age</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="spouseage" type="text" value="<?php echo $row['SpouseAge'] ?>" class="form-control" id="renewPassword">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Phone Number</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="phonenumber" type="text" value="<?php echo $row['GuardianPhoneNumber'] ?>" class="form-control" id="renewPassword">
                  </div>
                </div>
                <?php } ?>

                <div class="text-center">
                  <button type="submit" name="btn_up_background" class="btn btn-primary">Save Changes</button>
                </div>
              </form><!-- End Change Password Form -->

            </div>
            <!-- Program -->
            <?php require("Function2.php"); ?>
            <!-- <div class="tab-pane fade pt-3" id="profile-setting">

            <form method="post" enctype="multipart/form-data" >

            <div class="row mb-3">
  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Faculty</label>
  <div class="col-md-8 col-lg-9">
    <select class="form-select" name="facultytxt" id="" onchange="updateMajorList(this.value)" >
    <option value="">
      Select One
    </option>
        <?php getFaculty(); ?>
    </select>
  </div>
</div>

<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Major</label>
  <div class="col-md-8 col-lg-9">
  <select name="majortxt" class="form-select" id="">
  
    </select>
  </div>
</div>


<div class="row mb-3">
  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Year</label>
  <div class="col-md-8 col-lg-9">
    <select class="form-select" name="yeartxt" id="">
    <option value="">
      Select One
    </option>
        <?php getYear(); ?>
    </select>
  </div>
</div>

<div class="row mb-3">
  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Semester</label>
  <div class="col-md-8 col-lg-9">
  <select class="form-select" name="semestertxt" id="">
  <option value="">
      Select One
    </option>
        <?php getSemester(); ?>
    </select>
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Shift</label>
  <div class="col-md-8 col-lg-9">
    <select name="shifttxt" class="form-select" id="">
    <option value="">
      Select One
    </option>
    <?php getShift();  ?>
    </select>
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Degree</label>
  <div class="col-md-8 col-lg-9">
    <select name="degreetxt" class="form-select" id="">
    <option value="">
      Select One
    </option>
    <?php getDegree();  ?>
    </select>
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">AcademicYear</label>
  <div class="col-md-8 col-lg-9">
    <select name="academictxt" class="form-select" id="">
    <option value="">
      Select One
    </option>
    <?php getAcad();  ?>
    </select>
  </div>
</div>

<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Batch</label>
  <div class="col-md-8 col-lg-9">
  <select name="batchtxt" class="form-select" id="">
  <option value="">
      Select One
    </option>
    <?php getBatch();  ?>
    </select>
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Campus</label>
  <div class="col-md-8 col-lg-9">
    <select name="campustxt" class="form-select" id="">
    <option value="">
      Select One
    </option>
    <?php getCampus();  ?>
    </select>
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Start Date</label>
  <div class="col-md-8 col-lg-9">
  <input
                      type="date"
                      class="form-control"
                      name="startdatetxt"
                      id="dateInput"
                    />
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">End Date</label>
  <div class="col-md-8 col-lg-9">
  <input
                      type="date"
                      class="form-control"
                      name="enddatetxt"
                      id="dateInput"
                    />
</div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Date Issue</label>
  <div class="col-md-8 col-lg-9">
  <input
                      type="date"
                      class="form-control"
                      name="dateissuetxt"
                      id="dateInput"
                    />
  </div>
</div>

<div class="text-center">
  <button type="submit" class="btn btn-primary" name="btn_add_pro" >Add</button>
</div>
</form>

            </div> -->

            <!-- Student Status -->
            <div class="tab-pane fade pt-3" id="profile-settin">

            <form method="post" enctype="multipart/form-data" >

<div class="row mb-3">
  <h6 style="text-align: center;" >Educational Background</h6>
  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">School Type</label>
  <div class="col-md-8 col-lg-9">
    <select class="form-select" name="schooltype" id="">
    <option value="">
      Select One
    </option>
        <?php getSchoolType(); ?>
    </select>
  </div>
</div>

<div class="row mb-3">
  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">School Name</label>
  <div class="col-md-8 col-lg-9">
  <input type="text" name="schoolnametxt" class="form-control" >
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Academic Year</label>
  <div class="col-md-8 col-lg-9">
  <input type="text" name="academicyear" class="form-control" >
  </div>
</div>
<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Province</label>
  <div class="col-md-8 col-lg-9">
  <input type="text" name="province" class="form-control" >
  </div>
</div>
<h6 style="text-align: center;" >Program</h6>
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

           

            
            <!-- Student Status View -->
            <div class="tab-pane fade show  profile-overview" id="profile-set">            
              <!-- <h5 class="card-title">About</h5>
              <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

              <div><h4 style="text-align: center;" >Student Status</h4></div>
                <?php
               
                
               $sql1="SELECT * FROM `studentstatus_tbl` 
               INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID
               INNER JOIN program_tbl ON studentstatus_tbl.ProgramID = program_tbl.ProgramID
               INNER JOIN faculty_tbl ON program_tbl.FacultyID = faculty_tbl.FacultyID
               INNER JOIN major_tbl ON program_tbl.MajorID = major_tbl.MajorID
               INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
               INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
               INNER JOIN academicyear_tbl ON program_tbl.AcademicYearID = academicyear_tbl.AcademicYearID
               INNER JOIN batch_tbl ON program_tbl.BatchID = batch_tbl.BatchID
               INNER JOIN campus_tbl ON program_tbl.CampusID = campus_tbl.CampusID
               INNER JOIN degree_tbl ON program_tbl.DegreeID = degree_tbl.DegreeID
               INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID WHERE studentstatus_tbl.StudentID  = $id";
             $rs=$conn->query($sql1);
                    while($rw = mysqli_fetch_assoc($rs)){
                ?>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Program ID</div>
                <div class="col-lg-9 col-md-8 A" ><h6><?php echo $rw['ProgramID'] ?></h6></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Faculty</div>
                <div class="col-lg-9 col-md-8 A" ><h6><?php echo $rw['FacultyEN'] ?></h6></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Major</div>
                <div class="col-lg-9 col-md-8 A" ><h6><?php echo $rw['MajorEN'] ?></h6></div>
              </div>

              <div class="row">
              <div class="col-lg-3 col-md-4 label">Year</div>
                <div class="col-lg-9 col-md-8 A" ><h6><?php echo $rw['YearEN'] ?></h6></div>
              </div>
              
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Semester</div>
                <div class="col-lg-9 col-md-8 A" ><h6><?php echo $rw['SemesterEN'] ?></h6></div>
              </div>
              
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Shift</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['ShiftEN'] ?></h6></div>
              </div>

                    

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Degree</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['DegreeNameEN'] ?></h6></div>
              </div>



              <div class="row">
                <div class="col-lg-3 col-md-4 label">Academic Year</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['AcademicYear'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Batch</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['BatchEN'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Campus</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $rw['CampusEN'] ?></h6></div>
              </div>
     <div class="row">
         <div class="col-lg-3 col-md-4 label ">Assigned</div>
         <div class="col-lg-9 col-md-8 A" ><h6><?php echo $rw['Assigned'] ?></h6></div>
       </div>

       <div class="row">
         <div class="col-lg-3 col-md-4 label">Note</div>
         <div class="col-lg-9 col-md-8 A" ><h6><?php echo $rw['Note'] ?></h6></div>
       </div>

       <div class="row">
         <div class="col-lg-3 col-md-4 label">AssignDate</div>
         <div class="col-lg-9 col-md-8 A" ><h6><?php echo $rw['AssignDate'] ?></h6></div>
       </div>

       <div class="row">
                      <p>==================================================================================</p>
       </div>

         
              <?php } ?>
              <?php
                $sql = "SELECT * FROM educationalbackground_tbl
                INNER JOIN schooltype_tbl on educationalbackground_tbl.SchoolTypeID = schooltype_tbl.SchoolTypeID
                WHERE StudentID = $id";
                $rs= $conn->query($sql);
                while($row=mysqli_fetch_assoc($rs)){
              ?>
              <div><h4 style="text-align: center;" >Educational Background</h4></div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">High School Name</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $row['NameSchool'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">High School Type</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $row['SchoolTypeEN'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Academic Year</div>
                <div class="col-lg-9 col-md-8"><h6><?php echo $row['AcademicYear'] ?></h6></div>
              </div>
               <?php } ?>
            </div>
            
           <!-- Manage Program -->
           <div class="tab-pane fade pt-3" id="profile">
            <h4 style="text-align: center;" >Manage Student Status</h4>
                  <?php 
                    $sql="SELECT * FROM `studentstatus_tbl` 
                    WHERE studentstatus_tbl.StudentID = $id";
                    $rs=$conn->query($sql);
                    while($row=mysqli_fetch_assoc($rs)){
                      
                  ?>
           <form method="post" enctype="multipart/form-data" >

      <div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Program</label>
  <div class="col-md-8 col-lg-9">
    <select name="facultytxt" id="" class="form-select">
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
                  <input name="programidtxt"  type="text" class="form-control" id="Facebook" value="<?php echo $row['Assigned'] ?>">
                  </div>
      </div>

         <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Note</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="programidtxt"  type="text" class="form-control" id="Facebook" value="<?php echo $row['Note'] ?>">
      </div>
      </div>

         <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">AssignDate</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="programidtxt"  type="date" class="form-control" id="dateInput" value="<?php echo $row['AssignDate'] ?>">
      </div>
      <?php } ?>
      <h4 style="text-align: center; margin-top: 50px; " >Manage Student Educational Background</h4>
                  <?php 
                    $sql="SELECT * FROM educationalbackground_tbl WHERE StudentID = $id";
                    $rs=$conn->query($sql);
                    while($row=mysqli_fetch_assoc($rs)){
                      
                  ?>

<div class="row mb-3">
                  <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Educational ID</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="educationalid" readonly type="text" class="form-control" id="Facebook" value="<?php echo $row['EducationalBackgroundID'] ?>">
                  </div>
      </div>
      <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">School Type</label>
                  <div class="col-md-8 col-lg-9">
                  <select name="schooltytxt" id="" class="form-select" >
                                   <?php
                                    $sql="SELECT * FROM schooltype_tbl ORDER BY SchoolTypeID";
                                    $exec=mysqli_query($conn,$sql);
                                    while($rw=mysqli_fetch_array($exec)){
                                    ?>
                                        <option value="<?php echo $rw['SchoolTypeID'];?>" 
                                            <?php if($rw['SchoolTypeID']==$row['SchoolTypeID']) echo "selected";?>>
                                            
                                            <?php echo $rw['SchoolTypeEN']?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                   </select>
                  </div>
      </div>
      <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">School Name</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="schoolnametxt"  type="text" class="form-control" id="Facebook" value="<?php echo $row['NameSchool'] ?>">
                  </div>
      </div>
      <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Academic Year</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="academictxt"  type="text" class="form-control" id="Facebook" value="<?php echo $row['AcademicYear'] ?>">
                  </div>
      </div>
      <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">City/Province</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="cityprovince"  type="text" class="form-control" id="Facebook" value="<?php echo $row['Province'] ?>">
                  </div>
      </div>
      <?php } ?>
      
      <div class="text-center">
                  <button type="submit" name="btn_up_pro" class="btn btn-primary">Save Changes</button>
                </div>
      </form>
      
         
          </div>

          <!-- Manage Educational -->
          <!-- <div class="tab-pane fade pt-3" id="pr">
            <h4 style="text-align: center;" >Manage Student Educational Background</h4>
                  <?php 
                    $sql="SELECT * FROM educationalbackground_tbl WHERE StudentID = $id";
                    $rs=$conn->query($sql);
                    while($row=mysqli_fetch_assoc($rs)){
                      
                  ?>
           <form method="post" enctype="multipart/form-data" >
      <div class="row mb-3">
                  <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Educational ID</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="educationalid" readonly type="text" class="form-control" id="Facebook" value="<?php echo $row['EducationalBackgroundID'] ?>">
                  </div>
      </div>
      <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">School Type</label>
                  <div class="col-md-8 col-lg-9">
                  <select name="schooltytxt" id="" class="form-select" >
                                   <?php
                                    $sql="SELECT * FROM schooltype_tbl ORDER BY SchoolTypeID";
                                    $exec=mysqli_query($conn,$sql);
                                    while($rw=mysqli_fetch_array($exec)){
                                    ?>
                                        <option value="<?php echo $rw['SchoolTypeID'];?>" 
                                            <?php if($rw['SchoolTypeID']==$row['SchoolTypeID']) echo "selected";?>>
                                            
                                            <?php echo $rw['SchoolTypeEN']?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                   </select>
                  </div>
      </div>
      <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">School Name</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="schoolnametxt"  type="text" class="form-control" id="Facebook" value="<?php echo $row['NameSchool'] ?>">
                  </div>
      </div>
      <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Academic Year</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="academictxt"  type="text" class="form-control" id="Facebook" value="<?php echo $row['AcademicYear'] ?>">
                  </div>
      </div>
      <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">City/Province</label>
                  <div class="col-md-8 col-lg-9">
                  <input name="cityprovince"  type="text" class="form-control" id="Facebook" value="<?php echo $row['Province'] ?>">
                  </div>
      </div>
      <div class="text-center">
                  <button type="submit" name="btn_up_edu" class="btn btn-primary">Save Changes</button>
                </div>
      </form>
      <?php } ?>
         
          </div> -->
            
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->

<?php
  if(isset($_POST['btn_up'])){
    $nameKhmer = $_POST['namekhmer_txt'];
    $namelatin = $_POST['namelatin_txt'];
    $familyname = $_POST['familyname_txt'];
    $givenname = $_POST['givenname_txt'];
    $gender = $_POST['gender_txt'];
    $idpass = $_POST['idpassport_txt'];
    $nationality = $_POST['nationality_txt'];
    $country = $_POST['country_txt'];
    $dob = $_POST['dob_txt'];
    $pob = $_POST['pob_txt'];
    $phone = $_POST['phone_txt'];
    $email = $_POST['email_txt'];
    $currentaddr = $_POST['currentaddr_txt'];
    $currentaddrPP = $_POST['currentaddrPP_txt'];
    $photo = $_FILES['photo'];

    if ($photo) {
      $photo = $_FILES['photo']['name'];
      move_uploaded_file($_FILES['photo']['tmp_name'], "../../image/$photo");
  }

  // Prepare SQL update statement
  $sql_update = "UPDATE studentinfo_tbl SET
                      NameInKhmer='$nameKhmer',
                      NameInLatin='$namelatin',
                      FamilyName='$familyname',
                      GivenName='$givenname',
                      SexID='$gender',
                      IDPassportNo='$idpass',
                      NationalityID='$nationality',
                      CountryID='$country',
                      DOB='$dob',
                      POB='$pob',
                      PhoneNumber='$phone',
                      Email='$email',
                      CurrentAddress='$currentaddr',
                      CurrentAddressPP='$currentaddrPP'";
                     
  
  // Include image update in SQL statement if an image is uploaded
  if ($photo) {
      $sql_update .= ", Photo='$photo'";
  }

  $sql_update .= " WHERE StudentID=$id";

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
            window.location.href = window.location.href; // Refresh the current page.
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
<!-- Update background -->
<?php
  if(isset($_POST['btn_up_background'])){
    $fathername = $_POST['fathername'];
    $fatherage = $_POST['fatherage'];
    $fathernationality = $_POST['fathernationaity'];
    $fathercountry = $_POST['fathercounty'];
    $fatheroccupation = $_POST['fatheroccupation'];
    $mothername = $_POST['mothername'];
    $motherage = $_POST['motherage'];
    $mothernationality = $_POST['mothernationality'];
    $mothercountry = $_POST['mothercountry'];
    $motheroccupation = $_POST['motheroccupation'];
    $familyaddr = $_POST['familtyaddr'];
    $spousename = $_POST['spousename'];
    $spouseage = $_POST['spouseage'];
    $phonenumber = $_POST['phonenumber'];
    
  $sql_update = "UPDATE familybackground_tbl SET
                      FatherName='$fathername',
                      FatherAge='$fatherage',
                      FatherNationalityID='$fathernationality',
                      FatherCountryID='$fathercountry',
                      FatherOccupationID='$fatheroccupation',
                      MotherName='$mothername',
                      MotherAge='$motherage',
                      MotherNationalityID='$mothernationality',
                      MotherCountryID='$mothercountry',
                      MotherOccupationID='$motheroccupation',
                      FamilyCurrentAddress='$familyaddr',
                      SpouseName='$spousename',
                      SpouseAge='$spouseage',
                      GuardianPhoneNumber='$phonenumber' WHERE StudentID = '$id'";
                     
  
 

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
            window.location.href = window.location.href; // Refresh the current page.
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
     

<?php
 }
else {
    
?>




<main id="main" class="main">
  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Create
</button>
<?php
  include("Function.php");
?>
<!-- Modal -->
<div class="modal fade"  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content"   >
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="row g-3" method="post" enctype="multipart/form-data" >
                  <div class="col-12">
                    <label  class="form-label"
                      >Name In Khmer</label
                    >
                    <input type="text" class="form-control" name="namekhmer_txt" />
                  </div>
                 
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Name In Latin</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      name="namelatin_txt"
                    />
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Family Name</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      name="familyname_txt"
                    />
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Given Name</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      name="givenname_txt"
                    />
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Gender</label
                    >
                    <select name="gender_txt"  class="form-select" >
                    <?php getSex(); ?>
                    </select>
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >ID Passport Number</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      name="idpassport_txt"
                    />
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Nationality</label
                    >
                    <select name="nationality_txt"  class="form-select" >
                    <?php getNationality(); ?>
                    </select>
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Country</label
                    >
                    <select name="country_txt" class="form-select" >
                    <?php getCountry(); ?>
                    </select>
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Date Of Birth</label
                    >
                    <input
                      type="date"
                      class="form-control"
                      name="dob_txt"
                      id="dateInput"
                    />
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Place Of Birth</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      name="pob_txt"
                    />
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Phone Number</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      name="phonenumber_txt"
                    />
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Email</label
                    >
                    <input
                      type="email"
                      class="form-control"
                      name="email_txt"
                    />
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Current Address</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      name="currentadrr_txt"
                    />
                  </div>
                  <div class="col-12">
                    <label for="inputPassword4" class="form-label"
                      >Current Address PP</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      name="currentadrrPP_txt"
                    />
                  </div>
                  <div class="col-12">
                    <label for="inputAddress" class="form-label">Student Image</label>
                    <input
                      type="file"
                      class="form-control"
                      name="photo_txt"
                    />
                  </div>
                  
                  <div class="text-center">
                    <input type="submit" name="btn_sub" class="btn btn-primary">
                      
                    </input>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     
                    </input>
                  </div>
                </form>
      </div>
        
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
    </div>
  </div>
</div>

<div class="pagetitle">
    <h1>List Student</h1>
    <div class="card-header">
        <form method="post">
            <div class="input-group mb-3">
                

                <input type="text" class="form-control mx-2" placeholder="Search by Student ID" name="searchId">
                <button class="btn btn-outline-dark mx-2" type="submit" name="search" style="border-radius: 5px;" >Search</button>
                <a href="?tag=list_stu" class="btn btn-outline-success" style="border-radius: 5px;" >Refresh</a>
            </div>
        </form>
    </div>
</div>

      
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body"  >
                <h5 class="card-title">Student Table</h5>

                <!-- Table with stripped rows -->
                <table class="table table-striped" cellpadding="2"  >
                  <thead>
                    <tr>
                      <th scope="col">StudentId</th>
                      <th scope="col">Name In Khmer</th>
                      <!-- <th scope="col">Name In Latin</th> -->
                      
                      <!-- <th scope="col">ID Passport</th> -->
                      <th scope="col">Nationality</th>
                      <th scope="col">Country</th>
                      
                      <th scope="col">Phone Number</th>
                      <!-- <th scope="col">Email</th> -->
                      <th scope="col">Current Address</th>
                      <th scope="col">Current Address PP</th>
                      <th scope="col" colspan="3" >Action</th>
                    </tr>
                  </thead>
                  <tbody>

                        


                  <!-- ------------------------------------------------------------ -->
                  <?php
if(isset($_POST['search'])) { 
    $searchId = $_POST['searchId'] ?? '';
    if ($searchId != '') {
        $stmt = $conn->prepare("SELECT StudentID , NameInKhmer , NameInLatin , FamilyName , GivenName , sex_tbl.SexID , SexKH , SexEN , IDPassportNo , nationality_tbl.NationalityID , NationalityKH , NationalityEN , country_tbl.CountryID , CountryKH , CountryEN , DOB , POB , PhoneNumber , Email , CurrentAddress , CurrentAddressPP , RegisterDate , Photo  FROM `studentinfo_tbl` 
        INNER JOIN sex_tbl on studentinfo_tbl.SexID = sex_tbl.SexID
        INNER JOIN country_tbl ON studentinfo_tbl.CountryID = country_tbl.CountryID
        INNER JOIN nationality_tbl ON studentinfo_tbl.NationalityID = nationality_tbl.NationalityID WHERE StudentId = ?");
        $stmt->bind_param("s", $searchId);
        $stmt->execute();
        $result = $stmt->get_result();
        

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['StudentID']}</td>";
            echo "<td>{$row['NameInKhmer']}</td>";
            // echo "<td>{$row['NameInLatin']}</td>";
            // echo "<td>{$row['IDPassportNo']}</td>";
            // echo "<td>****</td>"; 
            echo "<td>{$row['NationalityKH']}</td>";
            echo "<td>{$row['CountryKH']}</td>";
            echo "<td>{$row['PhoneNumber']}</td>";
            // echo "<td>{$row['Email']}</td>";
            echo "<td>{$row['CurrentAddress']}</td>";
            echo "<td>{$row['CurrentAddressPP']}</td>";
            echo "<td>";
            echo "<a class='btn btn-primary mx-2' href='?tag=list_stu&op=view&id={$row['StudentID']}'>View</a>";
            // echo "<a class='btn btn-success mx-2' href='?tag=list_stu&op=edit&id={$row['StudentID']}'>Edit</a>";
            echo "<a class='btn btn-danger' onclick='return confirm(\"Are you sure to delete?\");' href='?tag=list_stu&op=del&id={$row['StudentID']}'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        $stmt->close();
    }
       


}
else {
    $sql = "SELECT StudentID , NameInKhmer , NameInLatin , FamilyName , GivenName , sex_tbl.SexID , SexKH , SexEN , IDPassportNo , nationality_tbl.NationalityID , NationalityKH , NationalityEN , country_tbl.CountryID , CountryKH , CountryEN , DOB , POB , PhoneNumber , Email , CurrentAddress , CurrentAddressPP , RegisterDate , Photo  FROM `studentinfo_tbl` 
    INNER JOIN sex_tbl on studentinfo_tbl.SexID = sex_tbl.SexID
    INNER JOIN country_tbl ON studentinfo_tbl.CountryID = country_tbl.CountryID
    INNER JOIN nationality_tbl ON studentinfo_tbl.NationalityID = nationality_tbl.NationalityID
    ORDER BY StudentID ASC";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
            echo "<td>{$row['StudentID']}</td>";
            echo "<td>{$row['NameInKhmer']}</td>";
            // echo "<td>{$row['NameInLatin']}</td>";
            // echo "<td>{$row['IDPassportNo']}</td>";
            // echo "<td>****</td>"; 
            echo "<td>{$row['NationalityKH']}</td>";
            echo "<td>{$row['CountryKH']}</td>";
            echo "<td>{$row['PhoneNumber']}</td>";
            // echo "<td>{$row['Email']}</td>";
            echo "<td>{$row['CurrentAddress']}</td>";
            echo "<td>{$row['CurrentAddressPP']}</td>";
            echo "<td>";
            echo "<a class='btn btn-primary mx-2' href='?tag=list_stu&op=view&id={$row['StudentID']}'>View</a>";
            // echo "<a class='btn btn-success mx-2' href='?tag=list_stu&op=edit&id={$row['StudentID']}'>Edit</a>";
            echo "<a class='btn btn-danger' onclick='return confirm(\"Are you sure to delete?\");' href='?tag=list_stu&op=del&id={$row['StudentID']}'>Delete</a>";
            echo "</td>";
            echo "</tr>";
    }
}
?>
        
                            </tbody>
                </table>
                <?php
                    }
                        ?>
                <!-- End Table with stripped rows -->
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>