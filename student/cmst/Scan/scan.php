<?php
   $conn = mysqli_connect("localhost","root","","demo_db");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<main id="main" class="main">
  <div class="pagetitle">
          <h1> </h1>
        </div>
        <section class="section">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div id="reader" style="width: 300px"></div>
                  <form id="barcodeForm" action="Scan/scan.php" method="POST">
                <input type="hidden" id="barcode" name="barcode" value="">
                </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
</body>
</html>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        console.log(`Code matched = ${decodedText}`, decodedResult);
        document.getElementById('barcode').value = decodedText; // Set the decoded text in a hidden input
        document.forms["barcodeForm"].submit(); // Submit the form to process
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 30, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

// Assuming $conn is already created and connected to the database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $qrData = $_POST['barcode']; 

    parse_str($qrData, $data);
    $LecturerID = $data['LecturerID'];
    $SubjectID = $data['SubjectID'];

    $StudentID = $_SESSION['idS'];

    $sql = "SELECT StudentStatusID FROM studentstatus_tbl WHERE StudentID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $StudentID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $StudentStatusID = $row['StudentStatusID'];
    } else {
        $response['message'] = "StudentStatusID not found.";
        echo json_encode($response);
        exit;
    }

    // Current date
    $AttendanceDateIssue = date('Y-m-d');
    $DateIssue = date('Y-m-d');

    $checkSql = "SELECT COUNT(*) as count FROM attendance_tbl WHERE StudentStatusID = ? AND AttendanceDateIssue = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("is", $StudentStatusID, $AttendanceDateIssue);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $checkRow = $checkResult->fetch_assoc();

    if ($checkRow['count'] >= 2) {
        $response = "You have already scanned twice today.";
        echo '
        <script>
        $(document).ready(function(){
            swal({
                title: "Error",
                text: "' . $response . '",
                icon: "error",
                button: "Done",
            }).then(function() {
                window.location.href = "../index.php?tag=scan";
            });
        });
        </script>
        ';
        exit;
    }

    // Determine the section
    $Section = ($checkRow['count'] > 0) ? '2' : '1'; 

    // Other fields to insert
    $Attended = 1; 
    $AttendNote = 'Ok'; 

    // Insert data into attendance_tbl
    $insertSql = "INSERT INTO attendance_tbl (StudentStatusID, AttendanceDateIssue, SubjectID, Attended, AttendNote, Section, LecturerID, DateIssue)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("isiissis", $StudentStatusID, $AttendanceDateIssue, $SubjectID, $Attended, $AttendNote, $Section, $LecturerID, $DateIssue);

    if ($insertStmt->execute()) {
        echo '
        <script>
        $(document).ready(function(){
            swal({
                title: "Success",
                text: "Attendance recorded successfully for student ID: ' . $StudentID . '",
                icon: "success",
                button: "Done",
            }).then(function() {
                window.location.href = "../index.php?tag=scan";
            });
        });
        </script>
        ';
    } else {
        $response['message'] = "Failed to record attendance.";
        echo json_encode($response);
    }
}
?>
