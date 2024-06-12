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
<script>
function updateTime(daytxt) {
    $.ajax({
        url: 'Fetch.php',
        type: 'POST',
        data: { daytxt: daytxt },
        success: function(response) {
            $('select[name="timetxt"]').html(response);
        },
        error: function() {
            alert('Error fetching majors');
        }
    });
}
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function updateProgram(programtxt) {
    $.ajax({
        url: 'fetch_programs.php',
        type: 'POST',
        data: { programID: programtxt },
        success: function(response) {
            $('select[name="subjecttxt"]').html(response);
        },
        error: function() {
            alert('Error fetching programs');
        }
    });
}
function updateRoom(campusID) {
    $.ajax({
        url: 'fetch_rooms.php',
        type: 'POST',
        data: { campusID: campusID },
        success: function(response) {
            $('select[name="roomtxt"]').html(response);
        },
        error: function() {
            alert('Error fetching rooms');
        }
    });
}
</script>
</head>
<body>
  

<main id="main" class="main">
      <section class="section">
        <div class="row">
          <div class="col-lg-10">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Schedule</h5>

                <form class="row g-3" method="post" enctype="multipart/form-data" >

                <div class="col-6">
                    <label for="inputPassword4" class="form-label"
                      >Program</label
                    >
                    <select name="programtxt" id="programSelect" class="form-select" onchange="updateProgram(this.value)" >
                    <?php getProgram(); ?>
                </select>
                  </div>

                  <div class="col-6">
                    <label  class="form-label"
                      >Subject</label
                    >
                    <select name="subjecttxt" class="form-select" ">
                  <option value="">Select One</option>
                  <!-- <?php getSubject(); ?> -->
                </select>
                  </div>
                 
                  <div class="col-6">
                    <label for="inputPassword4" class="form-label"
                      >Lecturer</label
                    >
                    <select name="lecturetxt"  class="form-select" >
                    <option value="">Select One</option>
                    <?php getLecture(); ?>
                    </select>
                  </div>
                  <div class="col-6">
                    <label for="inputPassword4" class="form-label"
                      >Day</label
                    >
                    <select name="daytxt"  class="form-select" onchange="updateTime(this.value)" >
                    <option value="">Select One</option>
                    <?php getDay(); ?>
                    </select>
                  </div>
                  <div class="col-6">
                    <label for="inputPassword4" class="form-label"
                      >Time</label
                    >
                    <select name="timetxt"  class="form-select" >
                   
                    </select>
                  </div>
                  <div class="col-6">
                    <label for="inputPassword4" class="form-label"
                      >Room</label
                    >
                    <select name="roomtxt"  class="form-select" >
                    <option value="">Select One</option>
                    <?php getRoom(); ?>
                    </select>
                  </div>
                  
                  <div class="col-6">
                    <label for="inputPassword4" class="form-label"
                      >Schedule Date</label
                    >
                    <input
                      type="date"
                      class="form-control"
                      name="scheduleDate"
                      id="dateInput"
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