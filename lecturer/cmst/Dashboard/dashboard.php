<?php
     $conn = mysqli_connect("localhost","root","","demo_db");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-6 col-lg-4 col-md-6">
              <div class="card info-card sales-card">

              

                <a href="index.php?tag=schedule">
                <div class="card-body">
                  <h5 class="card-title">Schedule</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <div class="ps-3">
                     <!-- <?php
                       
                        $sql = "SELECT COUNT(*) c FROM `studentinfo_tbl`";
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_assoc($result);
                        echo '<h6>' . $row['c'] . " / Students" . '</h6>';
                     ?> -->
                     <h6>My Schedule</h6>
                    </div>
                  </div>
                </div>
                </a>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-6 col-md-6">
              <div class="card info-card revenue-card">
              
              <a href="index.php?tag=attendance">
              <div class="card-body">
                  <h5 class="card-title">Attendance</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-clipboard-user"></i>
                    </div>
                    <div class="ps-3">
                     <!-- <?php
                       
                        $sql = "SELECT COUNT(*) c FROM `attendance_tbl`";
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_assoc($result);
                        echo '<h6>' . $row['c'] . " / Attendace" . '</h6>';
                     ?> -->
                     <h6>My Attendance</h6>
                    </div>
                  </div>
                </div>
              </a>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            

      </div>
    </section>

  </main><!-- End #main -->