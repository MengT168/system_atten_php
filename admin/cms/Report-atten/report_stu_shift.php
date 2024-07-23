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
                            <h5 class="card-title">Absent Report By Shift</h5>
                            <div class="row g-2">
                                <div class="col-3">
                                    <label class="form-label">Shift</label>
                                    <select id="shift" name="academicpro" class="form-select">
                                        <option value="">Select One</option>
                                        <?php getShift(); ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <a id="searchMajorBtn" style="margin-top: 30px;" href="#" class="btn btn-primary">Search</a>
                                </div>
                                <div class="col-3 hidden" id="studentNameContainer">
                                    <label class="form-label">Student Name</label>
                                    <input type="text" id="studentName" class="form-control">
                                </div>
                                <div class="col-2 hidden" id="searchNameBtnContainer">
                                    <a id="searchNameBtn" style="margin-top: 30px;" href="#" class="btn btn-primary">Search by Name</a>
                                </div>
                                <div class="col-2 hidden" id="refreshBtnContainer">
                                    <a id="searchNameBtn" style="margin-top: 30px;" href="?tag=shift_stu_report_atten&op=search&shift=<?php echo $shift = isset($_GET['shift']) ? $_GET['shift'] : null; ?> "class="btn btn-primary">Refresh</a>
                                </div>
                                <div  class="col-2 hidden" id="exportBtnContainer">
                                    <a id="exportBtn" style="margin-top: 30px;" href="#" class="btn btn-primary">Export to PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        if (isset($_GET['op']) && $_GET['op'] == 'search' && isset($_GET['tag']) && $_GET['tag'] == 'shift_stu_report_atten') {
            $shift = isset($_GET['shift']) ? $_GET['shift'] : null;
            $studentName = isset($_GET['studentName']) ? $_GET['studentName'] : null;

            if ($shift !== null) {
                $query = "SELECT attendance_tbl.Attended, studentinfo_tbl.NameInLatin, faculty_tbl.FacultyEN, major_tbl.MajorEN, semester_tbl.SemesterEN, 
                          year_tbl.YearEN, shift_tbl.ShiftEN, batch_tbl.BatchEN, campus_tbl.CampusEN, room_tbl.RoomName, lecturer_tbl.LecturerName, 
                          subject_tbl.SubjectEN, attendance_tbl.DateIssue
                          FROM attendance_tbl
                          INNER JOIN studentstatus_tbl ON attendance_tbl.StudentStatusID = studentstatus_tbl.StudentStatusID
                          INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID
                          INNER JOIN program_tbl ON studentstatus_tbl.ProgramID = program_tbl.ProgramID
                          INNER JOIN major_tbl ON program_tbl.MajorID = major_tbl.MajorID
                          INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
                          INNER JOIN faculty_tbl ON program_tbl.FacultyID = faculty_tbl.FacultyID
                          INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
                          INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID
                          INNER JOIN lecturer_tbl ON attendance_tbl.LecturerID = lecturer_tbl.LecturerID
                          INNER JOIN subject_tbl ON attendance_tbl.SubjectID = subject_tbl.SubjectID
                          INNER JOIN batch_tbl ON program_tbl.BatchID = batch_tbl.BatchID
                          INNER JOIN campus_tbl ON program_tbl.CampusID = campus_tbl.CampusID
                          INNER JOIN schedule_tbl ON subject_tbl.SubjectID = schedule_tbl.SubjectID
                          INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                          WHERE attendance_tbl.Attended = 1 AND shift_tbl.ShiftID=$shift";

                if ($studentName !== null) {
                    $query .= " AND studentinfo_tbl.NameInLatin LIKE '%$studentName%'";
                }

                $query .= " GROUP BY attendance_tbl.AttendanceID";

                $result = mysqli_query($conn, $query);

                if ($result) {
                    echo '<div class="row"><div class="col-lg-12"><div class="card"><div class="card-body" id="reportTable" >';
                    echo '<div class="text-center"><h1>STUDENT ABSENT BY SHIFT</h1></div>';
                    echo '<table class="report-table">';
                    echo '<thead><tr>
                            <th>Name</th>
                            <th>Faculty</th>
                            <th>Major</th>
                            <th>Semester</th>
                            <th>Year</th>
                            <th>Shift</th>
                            <th>Batch</th>
                            <th>Campus</th>
                            <th>Room</th>
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
                                <td style="font-weight: bold;" >' . $row["NameInLatin"] . '</td>
                                <td style="font-weight: bold;" >' . $row["FacultyEN"] . '</td>
                                <td style="font-weight: bold;" >' . $row["MajorEN"] . '</td>
                                <td style="font-weight: bold;">' . $row["SemesterEN"] . '</td>
                                <td style="font-weight: bold;">' . $row["YearEN"] . '</td>
                                <td style="font-weight: bold;">' . $row["ShiftEN"] . '</td>
                                <td style="font-weight: bold;" >' . $row["BatchEN"] . '</td>
                                <td style="font-weight: bold;" >' . $row["CampusEN"] . '</td>
                                <td style="font-weight: bold;" >' . $row["RoomName"] . '</td>
                                <td style="font-weight: bold;" >' . $row["LecturerName"] . '</td>
                                <td style="font-weight: bold;" >' . $row["SubjectEN"] . '</td>
                                <td style="font-weight: bold;" >' . $row["DateIssue"] . '</td>
                                <td style="font-weight: bold;" >' . $attendanceStatus . '</td>
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
                    echo "Invalid query: " . mysqli_error($conn);
                }
            } else {
                echo "shift not found.";
            }
        }
        ?>
    </main>
    <script>
        document.getElementById('searchMajorBtn').addEventListener('click', function(event) {
            event.preventDefault(); 

            var shift = document.getElementById('shift').value;
            
            var url = '?tag=shift_stu_report_atten&op=search';
            url += '&shift=' + encodeURIComponent(shift);
            
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

        document.getElementById('searchNameBtn').addEventListener('click', function(event) {
            event.preventDefault(); 

            var shift = document.getElementById('shift').value;
            if (!shift) {
                swal("Error", "Please select a shift before searching by name.", "error");
                return;
            }

            var studentName = document.getElementById('studentName').value;
            
            var url = '?tag=shift_stu_report_atten&op=search';
            url += '&shift=' + encodeURIComponent(shift);
            url += '&studentName=' + encodeURIComponent(studentName);
            
            window.location.href = url;
        });
        var currentBatch = new URLSearchParams(window.location.search).get('shift');
        if (currentBatch) {
            document.getElementById('shift').value = currentBatch;
        }
    </script>
</body>
</html>