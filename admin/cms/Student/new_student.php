<!DOCTYPE html>
<?php
  include("Function.php");
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
</head>
<body>
  

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
                <h5 class="card-title">Student Form</h5>

                <!-- Vertical Form -->
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
                    <input type="reset" class="btn btn-secondary">
                     
                    </input>
                  </div>
                </form>
                <!-- Vertical Form -->
              </div>
            </div>
          </div>
        </div>
      </section>
      
    </main>
    
   
</body>
</html>