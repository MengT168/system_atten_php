<?php require('Function.php') ?>
<!DOCTYPE html>
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
    function Upmajor(facultytxt) {
      $.ajax({
        url: 'FetchFacul_listStu.php',
        type: 'POST',
        data: {
          facultyID: facultytxt
        },
        success: function(response) {
          $('select[name="majortxt"]').html(response);
        },
        error: function() {
          alert('Error fetching majors');
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
              <h5 class="card-title">Program Form</h5>

              <!-- Vertical Form -->
              <form method="post" enctype="multipart/form-data">

                <div class="row mb-3">
                  <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Faculty</label>
                  <div class="col-md-8 col-lg-9">
                    <select class="form-select" name="facultytxt" id="" onchange="Upmajor(this.value)">
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
                    <input type="date" class="form-control" name="startdatetxt" id="dateInput" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">End Date</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="date" class="form-control" name="enddatetxt" id="dateInput" />
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Date Issue</label>
                  <div class="col-md-8 col-lg-9">
                    <input type="date" class="form-control" name="dateissuetxt" id="dateInput" />
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="btn_add_pro">Add</button>
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