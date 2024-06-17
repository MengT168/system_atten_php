<?php
session_start();
require("connect.php");
$tag = "";
$msg = "";
$uid = "";
$op = "";
$id = "";
$das = "";

if (isset($_GET['op']))
  $op = $_GET['op'];

if (isset($_GET['id']))
  $id = $_GET['id'];

if (isset($_SESSION['uid']))
  $uid = $_SESSION['uid'];

if (isset($_GET['tag']))
  $tag = $_GET['tag'];

if (isset($_GET['das']))
  $das = $_GET['das'];

if ($tag == "logout")
  unset($_SESSION['ulog']);


if (isset($_SESSION['ulog']) && $_SESSION['ulog'] == true) {
  // Fetch user profile data from the database based on the $uid (user ID)
  $u_id = $_SESSION['uid'];
  $sqlchcek = "SELECT * FROM user_tbl WHERE uId = '$u_id' ";
  $exec = mysqli_query($conn, $sqlchcek);
  if ($exec && mysqli_num_rows($exec) > 0) {
  }
} else {
  header("Location: ../index.php");

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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet" />
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet" />
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet" />

</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="" />
        <span class="d-none d-lg-block">Admin</span>
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
        while ($userData = mysqli_fetch_assoc($exec)) {
        ?>
          <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="<?php echo !empty($userData['src']) ? '../../images' . $userData['src'] : 'path_to_default_image.jpg'; ?>" alt="Profile" class="rounded-circle" />
              <!-- <span class="d-none d-md-block dropdown-toggle ps-2"
                ><?php echo $userData['uname'] ?></span -->
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6><?php echo $userData['username'] ?></h6>
                <span>Admin</span>
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
  <aside id="sidebar" class="sidebar" style="width: 280px;">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link" href="?das=dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Manage Student</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <!-- <li>
            <a href="?tag=new_stu">
              <i class="bi bi-circle"></i><span>New Student</span>
            </a>
          </li> -->
          <li>
            <a href="?tag=list_stu">
              <i class="bi bi-circle"></i><span>Student</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Manage Lecturer </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <!-- <li>
            <a href="?tag=new_lecturer">
              <i class="bi bi-circle"></i><span>New Lecturer</span>
            </a>
          </li> -->
          <li>
            <a href="?tag=list_lecturer">
              <i class="bi bi-circle"></i><span>List Lecturer</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Schedule</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <!-- <li>
            <a href="?tag=new_schedule">
              <i class="bi bi-circle"></i><span>Create Schedule</span>
            </a>
          </li> -->
          <li>
            <a href="?tag=view_schedule">
              <i class="bi bi-circle"></i><span>View Lecturer Schedule</span>
            </a>
          </li>
          <li>
            <a href="?tag=view_schedule2">
              <i class="bi bi-circle"></i><span>View Schedule</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav1" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Program</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav1" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
            <a href="?tag=list_program">
              <i class="bi bi-circle"></i><span>View Program</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-na" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Status</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-na" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
            <a href="?tag=status">
              <i class="bi bi-circle"></i><span>View Status</span>
            </a>
          </li>
          <li>
            <a href="?tag=new1">
              <i class="bi bi-circle"></i><span>New Status</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-n" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Educational Background</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-n" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
            <a href="?tag=educa">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav12" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Attendace</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav12" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
            <a href="?tag=attendance">
              <i class="bi bi-circle"></i><span>View Attendace</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Tables Nav -->

      <!-- Main menu side bar for input -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#faculty-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Manage School system</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="faculty-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
            <a href="?tag=new_program">
              <i class="bi bi-circle"></i><span>Create New Program</span>
            </a>
          </li>
          <li>
            <a href="?tag=new_facult">
              <i class="bi bi-circle"></i><span>Create New Faculty</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_major">
              <i class="bi bi-circle"></i><span>Create New Major</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_sub">
              <i class="bi bi-circle"></i><span>Create New Subject</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_dayweek">
              <i class="bi bi-circle"></i><span>Create New Day Week</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_room">
              <i class="bi bi-circle"></i><span>Create New Room</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_time">
              <i class="bi bi-circle"></i><span>Create New Time</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_degree">
              <i class="bi bi-circle"></i><span>Create New Degree</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_batch">
              <i class="bi bi-circle"></i><span>Create New Batch</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_campus">
              <i class="bi bi-circle"></i><span>Create New Campus</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_shift">
              <i class="bi bi-circle"></i><span>Create New Shift</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_year">
              <i class="bi bi-circle"></i><span>Create New Year</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_sex">
              <i class="bi bi-circle"></i><span>Create New Gender</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_country">
              <i class="bi bi-circle"></i><span>Create New Country</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_semester">
              <i class="bi bi-circle"></i><span>Create New Semester</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_schooltype">
              <i class="bi bi-circle"></i><span>Create New School Type</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_occupation">
              <i class="bi bi-circle"></i><span>Create New Occupation</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_nationality">
              <i class="bi bi-circle"></i><span>Create New Nationality</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_academicyear">
              <i class="bi bi-circle"></i><span>Create New Academic Year</span>
            </a>
          </li>

          <li>
            <a href="?tag=new_academicprogram">
              <i class="bi bi-circle"></i><span>Create New Academic Program</span>
            </a>
          </li>

        </ul>
      </li> -->

      <!-- Main menu side bar for input-->



      <!-- Main menu side bar for list show -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Major-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>View List Management</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Major-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        
          <li>
            <a href="?tag=list_facult">
              <i class="bi bi-circle"></i><span>Faculty</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_major">
              <i class="bi bi-circle"></i><span>Major</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_sub">
              <i class="bi bi-circle"></i><span>Subject</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_dayweek">
              <i class="bi bi-circle"></i><span>Day Week</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_room">
              <i class="bi bi-circle"></i><span>Room</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_time">
              <i class="bi bi-circle"></i><span>Time</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_degree">
              <i class="bi bi-circle"></i><span>Degree</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_batch">
              <i class="bi bi-circle"></i><span>Batch</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_campus">
              <i class="bi bi-circle"></i><span>Campus</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_shift">
              <i class="bi bi-circle"></i><span>Shift</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_year">
              <i class="bi bi-circle"></i><span>Year</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_sex">
              <i class="bi bi-circle"></i><span>Gender</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_country">
              <i class="bi bi-circle"></i><span>Country</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_semester">
              <i class="bi bi-circle"></i><span>Semester</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_schooltype">
              <i class="bi bi-circle"></i><span>School Type</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_occupation">
              <i class="bi bi-circle"></i><span>Occupation</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_nationality">
              <i class="bi bi-circle"></i><span>Nationality</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_academicyear">
              <i class="bi bi-circle"></i><span>Academic Year</span>
            </a>
          </li>

          <li>
            <a href="?tag=list_academicprogram">
              <i class="bi bi-circle"></i><span>Academic Program</span>
            </a>
          </li>

        </ul>
      </li>

      <!-- Main menu side bar for list show-->

    </ul>
  </aside>
  <!-- End Sidebar-->

  Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
  </div>
  </footer> -->
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>


  <div>
    <?php
    if ($das == "dashboard") {
      include("Dashboard/dashboard.php");
    }



    if ($tag == "new_stu")
      include("Student/new_student.php");
    elseif ($tag == 'list_stu')
      include("Student/list_student.php");


    if ($tag == "new_sub")
      include("Sub/new_subject.php");
    elseif ($tag == 'list_sub')
      include("Sub/list_subject.php");


      elseif ($tag == 'new_program')
      include("Program/new_program.php");
    elseif ($tag == "list_program")
      include("Program/list_program.php");

      elseif ($tag == "status")
      include("Student-Status/status.php");
      elseif ($tag == "new1")
      include("Student-Status/statasall.php");

      elseif ($tag == "educa")
      include("Educational/educational.php");


    elseif ($tag == 'new_lecturer')
      include("Lecturer/new_lecturer.php");
    elseif ($tag == "list_lecturer")
      include("Lecturer/list_lecturer.php");

      elseif ($tag == 'new_schedule')
      include("Schedule/new_schedule.php");
    elseif ($tag == "view_schedule")
      include("Schedule/view_schedule.php");
      elseif ($tag == "view_schedule2")
      include("Schedule/view_schedule2.php");


    elseif ($tag == 'new_facult')
      include("Faculty/new_faculty.php");
    elseif ($tag == "list_facult")
      include("Faculty/list_faculty.php");


    elseif ($tag == 'new_major')
      include("Major/new_major.php");
    elseif ($tag == "list_major")
      include("Major/list_major.php");


    elseif ($tag == 'new_degree')
      include("Degree/new_degree.php");
    elseif ($tag == "list_degree")
      include("Degree/list_degree.php");


    elseif ($tag == 'new_batch')
      include("Batch/new_batch.php");
    elseif ($tag == "list_batch")
      include("Batch/list_batch.php");


    elseif ($tag == 'new_campus')
      include("campus/new_campus.php");
    elseif ($tag == "list_campus")
      include("campus/list_campus.php");


    elseif ($tag == 'new_shift')
      include("Shift/new_shift.php");
    elseif ($tag == "list_shift")
      include("Shift/list_shift.php");


    elseif ($tag == 'new_dayweek')
      include("Dayweek/new_dayweek.php");
    elseif ($tag == "list_dayweek")
      include("Dayweek/list_dayweek.php");


    elseif ($tag == 'new_time')
      include("Time/new_time.php");
    elseif ($tag == "list_time")
      include("Time/list_time.php");


    elseif ($tag == 'new_room')
      include("Room/new_room.php");
    elseif ($tag == "list_room")
      include("Room/list_room.php");

      elseif ($tag == "attendance")
      include("Attendance/attendance.php");


    elseif ($tag == 'new_year')
      include("Year/new_year.php");
    elseif ($tag == "list_year")
      include("Year/list_year.php");


    elseif ($tag == 'new_sex')
      include("Sex/new_sex.php");
    elseif ($tag == "list_sex")
      include("Sex/list_sex.php");


    elseif ($tag == 'new_semester')
      include("Semester/new_semester.php");
    elseif ($tag == "list_semester")
      include("Semester/list_semester.php");


    elseif ($tag == 'new_schooltype')
      include("Schooltype/new_schooltype.php");
    elseif ($tag == "list_schooltype")
      include("Schooltype/list_schooltype.php");


    elseif ($tag == 'new_country')
      include("Country/new_country.php");
    elseif ($tag == "list_country")
      include("Country/list_country.php");


    elseif ($tag == 'new_nationality')
      include("Nation/new_nationality.php");
    elseif ($tag == "list_nationality")
      include("Nation/list_nationality.php");


    elseif ($tag == 'new_occupation')
      include("Job/new_occupation.php");
    elseif ($tag == "list_occupation")
      include("Job/list_occupation.php");


    elseif ($tag == 'new_academicprogram')
      include("Acadpro/new_academicprogram.php");
    elseif ($tag == "list_academicprogram")
      include("Acadpro/list_academicprogram.php");


    elseif ($tag == 'new_academicyear')
      include("Acadyear/new_academicyear.php");
    elseif ($tag == "list_academicyear")
      include("Acadyear/list_academicyear.php");


    elseif ($tag == "list_user")
      include("User/list_user.php");



    else {
    ?>
      <!-- <h1 align="center">Welcome to Content Management System</h1>
		<p align="center">Click on menu to continue your work...</p> -->
    <?php
    }
    ?>
  </div>


</body>

</html>