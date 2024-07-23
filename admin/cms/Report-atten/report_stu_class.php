<?php
require('Function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <title>Report Viewer</title>
    <style>
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .report-table th, .report-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .report-table th {
            background-color: #f2f2f2;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Absent Report By Classroom</h5>
                            <div class="row g-2">
                                <div class="col-3">
                                    <label class="form-label">Room</label>
                                    <select id="room" name="academicpro" class="form-select">
                                        <option value="">Select One</option>
                                        <?php getRoom(); ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <a id="searchRoomBtn" style="margin-top: 30px;" href="#" class="btn btn-primary">Search Room</a>
                                </div>
                                <div class="col-3 hidden" id="studentNameContainer">
                                    <label class="form-label">Student Name</label>
                                    <input type="text" id="studentName" class="form-control">
                                </div>
                                <div class="col-2 hidden" id="searchNameBtnContainer">
                                    <a id="searchStudentBtn" style="margin-top: 30px;" href="#" class="btn btn-primary">Search by Name</a>
                                </div>
                                <div class="col-2 hidden" id="refreshBtnContainer">
                                    <a id="refreshBtn" style="margin-top: 30px;" href="?tag=class_stu_report_atten&op=search&room=<?php echo $room = isset($_GET['room']) ? $_GET['room'] : null; ?>" class="btn btn-primary">Refresh</a>
                                </div>
                                <div class="col-2 hidden" id="exportBtnContainer">
                                    <a id="exportBtn" style="margin-top: 30px;" href="#" class="btn btn-primary">Export to PDF</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        if (isset($_GET['op']) && $_GET['op'] == 'search' && isset($_GET['tag']) && $_GET['tag'] == 'class_stu_report_atten') {
            $room = isset($_GET['room']) ? $_GET['room'] : null;
            $studentName = isset($_GET['studentName']) ? $_GET['studentName'] : null;

            if ($room !== null && $room !== '') {
                $proQuery = "SELECT studentstatus_tbl.ProgramID
                             FROM attendance_tbl
                             INNER JOIN studentstatus_tbl ON attendance_tbl.StudentStatusID = studentstatus_tbl.StudentStatusID
                             INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID
                             INNER JOIN program_tbl ON studentstatus_tbl.ProgramID = program_tbl.ProgramID
                             INNER JOIN schedule_tbl ON program_tbl.ProgramID = schedule_tbl.ProgramID
                             INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                             WHERE room_tbl.RoomID = $room";

                $rspro = $conn->query($proQuery);

                if ($rspro && $rspro->num_rows > 0) {
                    $row = mysqli_fetch_assoc($rspro);
                    $proId = isset($row['ProgramID']) ? $row['ProgramID'] : null;

                    if ($proId !== null) {
                        $query = "SELECT attendance_tbl.Attended, studentinfo_tbl.NameInLatin, faculty_tbl.FacultyEN, major_tbl.MajorEN, semester_tbl.SemesterEN, 
                          year_tbl.YearEN, shift_tbl.ShiftEN, batch_tbl.BatchEN, campus_tbl.CampusEN, room_tbl.RoomName, lecturer_tbl.LecturerName, 
                          subject_tbl.SubjectEN, attendance_tbl.DateIssue , academicyear_tbl.AcademicYear
                                  FROM attendance_tbl
                                  INNER JOIN studentstatus_tbl ON attendance_tbl.StudentStatusID = studentstatus_tbl.StudentStatusID
                                  INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID
                                  INNER JOIN program_tbl ON studentstatus_tbl.ProgramID = program_tbl.ProgramID
                                  INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
                                  INNER JOIN faculty_tbl ON program_tbl.FacultyID = faculty_tbl.FacultyID
                                  INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
                                  INNER JOIN major_tbl ON program_tbl.majorID = major_tbl.majorID
                                  INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID
                                  INNER JOIN lecturer_tbl ON attendance_tbl.LecturerID = lecturer_tbl.LecturerID
                                  INNER JOIN subject_tbl ON attendance_tbl.SubjectID = subject_tbl.SubjectID
                                  INNER JOIN schedule_tbl ON subject_tbl.SubjectID = schedule_tbl.SubjectID
                                  INNER JOIN batch_tbl ON program_tbl.BatchID = batch_tbl.BatchID
                                  INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                                  INNER JOIN academicyear_tbl ON program_tbl.AcademicYearID = academicyear_tbl.AcademicYearID
                                  INNER JOIN campus_tbl ON program_tbl.CampusID = campus_tbl.CampusID
                                  WHERE attendance_tbl.Attended = 1 AND room_tbl.RoomID = $room AND schedule_tbl.ProgramID = $proId
                                  ";

                        if ($studentName !== null && $studentName !== '') {
                            $query .= " AND studentinfo_tbl.NameInLatin LIKE '%$studentName%'";
                        }
                        $query .= "GROUP BY attendance_tbl.AttendanceID";


                        $result = $conn->query($query);

                        // $row12 = mysqli_fetch_assoc($result);
                        // echo '<div class="text-center"><h3> Academic Year : ' . $row12["AcademicYear"] . '</h3></div>';
                        if ($result) {
                            echo '<div class="row"><div class="col-lg-12"><div class="card"><div class="card-body" id="reportTable" >';
                            echo '<div class="text-center"><h1>STUDENT ABSENT BY CLASS</h1></div>';

                            echo '<table class="report-table">';
                            echo '<thead><tr>
                                    <th>Name</th>
                                    <th>Faculty</th>
                                    <th>Major</th>
                                    <th>Semester</th>
                                    <th>Year</th>
                                    <th>Shift</th>
                                    <th>Room</th>
                                    <th>Batch</th>
                                    <th>Campus</th>
                                    <th>Lecturer</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Attended</th>
                                  </tr></thead>';
                            echo '<tbody>';
                            while ($row = mysqli_fetch_assoc($result)) {
                                $attendanceStatus = '';
                                switch ($row['Attended']) {
                                    case 1:
                                        $attendanceStatus = 'C';
                                        break;
                                    case 2:
                                        $attendanceStatus = 'P';
                                        break;
                                    case 3:
                                        $attendanceStatus = 'A';
                                        break;
                                }
                                echo '<tr>
                                        <td style="font-weight: bold;">' . $row["NameInLatin"] . '</td>
                                        <td style="font-weight: bold;">' . $row["FacultyEN"] . '</td>
                                        <td style="font-weight: bold;">' . $row["MajorEN"] . '</td>
                                        <td style="font-weight: bold;">' . $row["SemesterEN"] . '</td>
                                        <td style="font-weight: bold;">' . $row["YearEN"] . '</td>
                                        <td style="font-weight: bold;">' . $row["ShiftEN"] . '</td>
                                        <td style="font-weight: bold;">' . $row["RoomName"] . '</td>
                                        <td style="font-weight: bold;">' . $row["BatchEN"] . '</td>
                                        <td style="font-weight: bold;">' . $row["CampusEN"] . '</td>
                                        <td style="font-weight: bold;">' . $row["LecturerName"] . '</td>
                                        <td style="font-weight: bold;">' . $row["SubjectEN"] . '</td>
                                        <td style="font-weight: bold;">' . $row["DateIssue"] . '</td>
                                        <td style="font-weight: bold;">'.$attendanceStatus.'</td>
                                      </tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                            echo '</div></div></div></div>';
                            echo '<script>
                         document.getElementById("studentNameContainer").classList.remove("hidden");
                        document.getElementById("searchNameBtnContainer").classList.remove("hidden");
                        document.getElementById("refreshBtnContainer").classList.remove("hidden");
                        document.getElementById("exportBtnContainer").classList.remove("hidden");
                    </script>';
                        } else {
                            echo "Invalid query: " . $conn->error;
                        }
                    } else {
                        echo "Program ID not found for room: $room";
                    }
                } else {
                    echo "Error fetching Program ID or no results found: " . $conn->error;
                }
            } else {
                echo "Room ID not provided.";
            }
        }
        ?>
    </main>
    <script>
        document.getElementById('searchRoomBtn').addEventListener('click', function(event) {
            event.preventDefault(); 

            var room = document.getElementById('room').value;
            
            if (!room) {
                swal("Error", "Please select a room first.", "error");
                return;
            }
            
            var url = '?tag=class_stu_report_atten&op=search';
            url += '&room=' + encodeURIComponent(room);
            
            window.location.href = url;
        });

        document.getElementById('exportBtn').addEventListener('click', function(event) {
            event.preventDefault();
            html2canvas(document.getElementById('reportTable')).then(function(canvas) {
                const { jsPDF } = window.jspdf;
                var imgData = canvas.toDataURL('image/jpg');
                var doc = new jsPDF('p', 'mm', 'a4');
                var imgHeight = canvas.height * 208 / canvas.width;
                doc.addImage(imgData, 'JPG' , 0, 0, 208, imgHeight);
                doc.save('report.pdf');
            });
        });


        document.getElementById('searchStudentBtn').addEventListener('click', function(event) {
            event.preventDefault(); 

            var room = document.getElementById('room').value;
            var studentName = document.getElementById('studentName').value;
            
            if (!room) {
                swal("Error", "Please select a room first.", "error");
                return;
            }
            
            var url = '?tag=class_stu_report_atten&op=search';
            url += '&room=' + encodeURIComponent(room);
            url += '&studentName=' + encodeURIComponent(studentName);
            
            window.location.href = url;
        });

        // Show the student search section and refresh button if a room is already selected
        var currentRoom = new URLSearchParams(window.location.search).get('room');
        if (currentRoom) {
            document.getElementById('studentNameContainer').classList.remove('hidden');
            document.getElementById('searchNameBtnContainer').classList.remove('hidden');
            document.getElementById('refreshBtnContainer').classList.remove('hidden');
        }

        // Set the room value from URL parameter
        if (currentRoom) {
            document.getElementById('room').value = currentRoom;
        }
    </script>
</body>
</html>
