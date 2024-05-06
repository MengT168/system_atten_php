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
                <h5 class="card-title">Lecturer Form</h5>

                <!-- Vertical Form -->
                <form class="row g-3" method="post" enctype="multipart/form-data" >
                  <div class="col-12">
                    <label  class="form-label"
                      >Lecturer Name</label
                    >
                    <input type="text" class="form-control" name="lecturer_name" />
                  </div>
                  <div class="col-12">
                    <label for="inputAddress" class="form-label">Lecturer Image</label>
                    <input
                      type="file"
                      class="form-control"
                      name="photo_txt"
                    />
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