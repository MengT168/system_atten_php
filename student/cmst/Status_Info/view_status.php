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

<main id="main" class="main">

<div class="pagetitle">
  <h1>Student Status</h1>
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
        $Id = $_SESSION['id'];
        $conn = mysqli_connect("localhost","root","","demo_db");
    $sql="SELECT * FROM studentinfo_tbl WHERE StudentId = '$Id' ";
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
          <ul class="nav nav-tabs ">
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-set" style="font-weight: bolder;
               font-size: 20px; color: white; background-color: green;">View Status</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                      <?php
                        $sql="SELECT StudentID , NameInKhmer , NameInLatin , FamilyName , GivenName , sex_tbl.SexID , SexKH , SexEN , IDPassportNo , nationality_tbl.NationalityID , NationalityKH , NationalityEN , country_tbl.CountryID , CountryKH , CountryEN , DOB , POB , PhoneNumber , Email , CurrentAddress , CurrentAddressPP , RegisterDate , Photo  FROM `studentinfo_tbl` 
                        INNER JOIN sex_tbl on studentinfo_tbl.SexID = sex_tbl.SexID
                        INNER JOIN country_tbl ON studentinfo_tbl.CountryID = country_tbl.CountryID
                        INNER JOIN nationality_tbl ON studentinfo_tbl.NationalityID = nationality_tbl.NationalityID WHERE StudentId = '$Id' ";
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
                          $id=$_SESSION['id'];
                            $sql = "SELECT StudentID FROM familybackground_tbl WHERE StudentID = '$id'";
                            $exec=mysqli_query($conn, $sql);
                          $count=mysqli_num_rows($exec);

                          if($count>0){
                echo '<div class="tab-pane fade pt-3" id="profile-settings">Data already created</div>';
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

            <div class="tab-pane fade pt-3" id="profile-change-password">
            <h5 class="card-title">Profile Details</h5>
                <?php
                 $Id = $_SESSION['id'];
                
             $sql="SELECT * FROM familybackground_tbl
             INNER JOIN country_tbl on familybackground_tbl.FatherCountryID = country_tbl.CountryID
             INNER JOIN nationality_tbl ON familybackground_tbl.FatherNationalityID = nationality_tbl.NationalityID
             INNER JOIN occupation_tbl ON familybackground_tbl.FatherOccupationID = occupation_tbl.OccupationID WHERE StudentId = '$Id' ";
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
            <div class="tab-pane fade pt-3" id="profile-change-passwor">
              <!-- Update Family Background -->
              <?php
                        $sql="SELECT * FROM familybackground_tbl
                        INNER JOIN country_tbl on familybackground_tbl.FatherCountryID = country_tbl.CountryID
                        INNER JOIN nationality_tbl ON familybackground_tbl.FatherNationalityID = nationality_tbl.NationalityID
                        INNER JOIN occupation_tbl ON familybackground_tbl.FatherOccupationID = occupation_tbl.OccupationID WHERE StudentId = '$Id'  ";
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
            
          </div><!-- End Bordered Tabs -->
                
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

  $sql_update .= " WHERE StudentID=$Id";

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
                      GuardianPhoneNumber='$phonenumber' WHERE StudentID = '$Id'";
                     
  
 

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
     