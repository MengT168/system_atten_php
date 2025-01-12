<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
<?php
require("./connect.php");
$op = "";
$id = "";
global $conn;
if (isset($_GET['op']))
  $op = $_GET['op'];

if (isset($_GET['id']))
  $id = $_GET['id'];



if ($op == 'del') {
  $del = "DELETE FROM lecturer_tbl WHERE LecturerID=$id";

  $exec = mysqli_query($conn, $del);
  if ($exec) {
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
  } else
    $msg = "Delete Error: " . mysqli_error($conn);
}

?>

<?php
if ($op == 'view') {
?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Serif+Khmer:wght@100..900&display=swap');

    .A {
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
      <h1>Lecturer Information</h1>
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

              $conn = mysqli_connect("localhost", "root", "", "demo_db");
              $sql = "SELECT * FROM lecturer_tbl WHERE LecturerID = '$id' ";
              $rs = $conn->query($sql);
              while ($row = mysqli_fetch_assoc($rs)) {
              ?>

                <img src="../../lect_image/<?php echo $row['photo'] ?>" alt="Profile" class="rounded-circle">
                <h2><?php echo $row['LecturerName'] ?></h2>
                <h3>Lecturer</h3>
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
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <!-- <h5 class="card-title">About</h5>
              <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->

                  <h5 class="card-title">Profile Details</h5>
                  <?php

                  $sql = "SELECT * FROM `lecturer_tbl` WHERE LecturerID = '$id' ";
                  $rs = $conn->query($sql);
                  while ($rw = mysqli_fetch_assoc($rs)) {
                  ?>
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label ">Lecturer Name</div>
                      <div class="col-lg-9 col-md-8 A">
                        <h4><?php echo $rw['LecturerName'] ?></h4>
                      </div>
                    </div>
                </div>
              <?php } ?>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                <?php
                $sql = "SELECT * FROM `lecturer_tbl` WHERE LecturerID = '$id' ";
                $rs = $conn->query($sql);
                while ($row = mysqli_fetch_assoc($rs)) {
                ?>
                  <!-- Profile Edit Form -->
                  <form method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img id="profileImage" src="../../lect_image/<?php echo $row['photo'] ?>" alt="Profile" class="rounded-circle">
                        <div class="pt-2">
                          <!-- <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"  onclick="uploadProfileImage()"><i class="bi bi-upload"></i></a>
          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image" onclick="removeProfileImage()"><i class="bi bi-trash"></i></a> -->
                          <input type="file" class="form-control" name="photo" />
                        </div>
                      </div>

                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Lecturer Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="namekhmer_txt" type="text" class="form-control" id="fullName" value="<?php echo $row['LecturerName'] ?>">
                      </div>
                    </div>



                 

                  <?php } ?>
                  <div class="text-center">
                    <!-- <button type="submit" class="btn btn-primary" name="btn_up" >Save Changes</button> -->
                    <input type="submit" class="btn btn-primary" value="Save Changes" name="btn_up">
                  </div>
                  </form><!-- End Profile Edit Form -->

              </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php
  if (isset($_POST['btn_up'])) {
    $nameKhmer = $_POST['namekhmer_txt'];
    $photo = $_FILES['photo'];

    if ($photo) {
      $photo = $_FILES['photo']['name'];
      move_uploaded_file($_FILES['photo']['tmp_name'], "../../lect_image/$photo");
    }

    // Prepare SQL update statement
    $sql_update = "UPDATE lecturer_tbl SET
                      LecturerName='$nameKhmer',
                     ";


    // Include image update in SQL statement if an image is uploaded
    if ($photo) {
      $sql_update .= " Photo='$photo'";
    }

    $sql_update .= " WHERE LecturerID =$id";

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
} else {

?>




  <main id="main" class="main">
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Create
    </button>
    <?php
    include("Function.php");
    ?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Lecturer Info</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h5 class="card-title">Lecturer Form</h5>

            <!-- Vertical Form -->
            <form class="row g-3" method="post" enctype="multipart/form-data">
              <div class="col-12">
                <label class="form-label">Lecturer Name</label>
                <input type="text" class="form-control" name="lecturer_name" />
              </div>
              <div class="col-12">
                <label for="inputAddress" class="form-label">Lecturer Image</label>
                <input type="file" class="form-control" name="photo_txt" />
              </div>
              <div class="text-center">
                <input type="submit" name="btn_sub" class="btn btn-primary">

                </input>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </input>
                <input type="reset" class="btn btn-secondary">

                </input>
              </div>
            </form>
          </div>

          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
    </div>









    <div class="pagetitle">
      <h1>List Lecturer</h1>
      <div class="card-header">
        <form method="post">
          <div class="input-group mb-3">


            <input type="text" class="form-control mx-2" placeholder="Search by Lecturer ID" name="searchId">
            <button class="btn btn-outline-dark mx-2" type="submit" name="search" style="border-radius: 5px;">Search</button>
            <a href="?tag=list_lecturer" class="btn btn-outline-success" style="border-radius: 5px;">Refresh</a>
          </div>
        </form>
      </div>
    </div>


    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Lecturer Table</h5>

              <!-- Table with stripped rows -->
              <table class="table table-striped" cellpadding="2">
                <thead>
                  <tr>
                    <th scope="col">LecturerID</th>
                    <th scope="col">Lecture Name</th>
                    <th scope="col" colspan="3">Action</th>
                  </tr>
                </thead>
                <tbody>




                  <!-- ------------------------------------------------------------ -->
                  <?php
                  if (isset($_POST['search'])) {
                    $searchId = $_POST['searchId'] ?? '';
                    if ($searchId != '') {
                      $stmt = $conn->prepare("SELECT * FROM `lecturer_tbl` WHERE LecturerID = ?");
                      $stmt->bind_param("s", $searchId);
                      $stmt->execute();
                      $result = $stmt->get_result();


                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['LecturerID']}</td>";
                        echo "<td>{$row['LecturerName']}</td>";

                        echo "<td>";
                        echo "<a class='btn btn-primary mx-2' href='?tag=list_lecturer&op=view&id={$row['LecturerID']}'>View</a>";
                        echo "<a class='btn btn-danger' onclick='return confirm(\"Are you sure to delete?\");' href='?tag=list_lecturer&op=del&id={$row['LecturerID']}'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                      }
                      $stmt->close();
                    }
                  } else {
                    $sql = "SELECT * FROM `lecturer_tbl`
    ORDER BY LecturerID ASC";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>{$row['LecturerID']}</td>";
                      echo "<td>{$row['LecturerName']}</td>";
                      echo "<td>";
                      echo "<a class='btn btn-primary mx-2' href='?tag=list_lecturer&op=view&id={$row['LecturerID']}'>View</a>";
                      echo "<a class='btn btn-danger' onclick='return confirm(\"Are you sure to delete?\");' href='?tag=list_lecturer&op=del&id={$row['LecturerID']}'>Delete</a>";
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
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>