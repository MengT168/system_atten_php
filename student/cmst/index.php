

<?php
session_start();
$conn = mysqli_connect("localhost","root","","demo_db");
$tag="";
$msg="";
$uid="";
$op="";
$id="";
$das="";

if(isset($_GET['op']))
  $op=$_GET['op'];

if(isset($_GET['id']))
  $id=$_GET['id'];

if(isset($_SESSION['idS']))
  $uid=$_SESSION['idS'];

if(isset($_GET['tag']))
  $tag=$_GET['tag'];

  if(isset($_GET['das']))
  $das=$_GET['das'];

if($tag=="logout")
  unset($_SESSION['log']);

// if(isset($_SESSION['ulog'])!=true){
//   header("Location: ../");
// }
if (isset($_SESSION['log'] ) && $_SESSION['log'] == true && $_SESSION['idS'] && $_SESSION['uname'] ) {
  // Fetch user profile data from the database based on the $uid (user ID)
  // $u_id = $_SESSION['idS'];
  $sqlchcek = "SELECT * FROM studentinfo_tbl WHERE StudentId = '$uid' ";
  $exec = mysqli_query($conn, $sqlchcek);
  
} else {
  header("Location: ../../");

  exit();
}
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<style>
        .nav-link:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }

        .nav-link.active {
            background-color: cyan;
            color: #fff;
        }
    </style>

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  </head>

  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
          <img src="assets/img/logo.png" alt="" />
          <span class="d-none d-lg-block">Student</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div>
      <!-- End Logo -->

     
      <!-- End Search Bar -->

      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle" href="#">
              <i class="bi bi-search"></i>
            </a>
          </li>
          

          
        <!--Profile  -->
         <?php
         
          while($userData = mysqli_fetch_assoc($exec)){
         ?>
          <li class="nav-item dropdown pe-3">
            <a
              class="nav-link nav-profile d-flex align-items-center pe-0"
              href="#"
              data-bs-toggle="dropdown"
            >
              <img
              src="../../image/<?php echo $userData['Photo']; ?>"
                alt="Profile"
                class="rounded-circle"
              />
              <!-- <span class="d-none d-md-block dropdown-toggle ps-2"
                ><?php echo $userData['userName'] ?></span -->
               </a
            ><!-- End Profile Iamge Icon -->

            <ul
              class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
            >
              <li class="dropdown-header">
                <h6><?php echo $userData['NameInLatin'] ?></h6>
                <span>Student</span>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>
            <?php
          }
            ?>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="?tag=logout">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </a>
              </li>
            </ul>
            <!-- End Profile Dropdown Items -->
          </li>
          <!-- End Profile Nav -->
        </ul>
      </nav>
      <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
          <a class="nav-link" href="?das=dashboard">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <!-- End Dashboard Nav -->

        <li class="nav-item">
        <a class="nav-link" href="?tag=stu_info">
        <i class="fa-solid fa-circle-info"></i><span>Information</span>
        </a>
      </li>



        <!-- VAN Sarath ForList Schedule -->

      <li class="nav-item">
        <a class="nav-link" href="?tag=schedule">
        <i class="fa-solid fa-calendar-days"></i><span>Schedule</span>
        </a>
      </li>

      
      <li class="nav-item">
        <a class="nav-link" href="?tag=status">
        <i class="fa-solid fa-list"></i><span>Status</span>
        </a>
      </li>


        <!-- End Components Nav -->
        <li class="nav-item">
        <a class="nav-link" href="?tag=stu_atten">
        <i class="fa-solid fa-clipboard-user"></i><span>Attendance</span>
        </a>
      </li>



        <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-n" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Scan Attendance</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-n" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
            <a href="?tag=scan">
              <i class="bi bi-circle"></i><span>Scan Here</span>
            </a>
          </li>
        </ul>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="?tag=scan">
        <i class="fa-solid fa-qrcode"></i><span>Scan Attendance</span>
        </a>
      </li>

        
        <!-- End Components Nav -->
      </ul>
    </aside>
    <!-- End Sidebar-->

    
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <!-- <footer id="footer" class="footer">
      <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong
        >. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </footer> -->
    <!-- End Footer -->

    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>


            <div>
                <?php
                    if($das=="dashboard")
                    {
                      include("Dashboard/dashboard.php");
                    }



                    if($tag=="stu_info")
                    include("Student_Info/student_Info.php");
                  elseif($tag=='stu_atten')
                    include("Attendance/view_attendance.php");

                    elseif($tag=='schedule')
                    include("Schedule_info/view_schedule.php");

                    elseif($tag=='status')
                    include("Status_Info/view_status.php");

                    elseif($tag=='scan')
                    include("Scan/scan.php");
                    
                  
              
else{
?>
		<!-- <h1 align="center">Welcome to Content Management System</h1>
		<p align="center">Click on menu to continue your work...</p> -->
<?php
	}
?>
            </div>

            <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    navLinks.forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Optionally, set the active class based on the current URL
            const currentUrl = window.location.href;
            navLinks.forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add('active');
                }
            });
        });
    </script>

  </body>
  

</html>






