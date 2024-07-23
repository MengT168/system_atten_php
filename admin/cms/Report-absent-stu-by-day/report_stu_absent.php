<?php
    require("./connect.php");
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
                            <h5 class="card-title">Absent Report by Date Range</h5>
                            <div class="row g-2">
                                <div class="col-2">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" id="startDate" class="form-control">
                                </div>
                                <div class="col-2">
                                    <label class="form-label">End Date</label>
                                    <input type="date" id="endDate" class="form-control">
                                </div>
                                <div class="col-2">
                                    <a id="searchDateBtn" style="margin-top: 30px;" href="#" class="btn btn-primary">Search</a>
                                </div>
                                <div class="col-2 hidden" id="studentNameContainer">
                                    <label class="form-label">Student Name</label>
                                    <input type="text" id="studentName" class="form-control">
                                </div>
                                <div class="col-2 hidden" id="searchNameBtnContainer">
                                    <a id="searchNameBtn" style="margin-top: 30px;" href="#" class="btn btn-primary">Search by Name</a>
                                </div>
                                <div class="col-2 hidden" id="refreshBtnContainer">
                                    <a id="searchNameBtn" style="margin-top: 30px;" href="?tag=day_absent_stu&op=search&startDate=<?php echo $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null; ?>&endDate=<?php echo $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null; ?> "class="btn btn-primary">Refresh</a>
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
        if (isset($_GET['op']) && $_GET['op'] == 'search' && isset($_GET['tag']) && $_GET['tag'] == 'day_absent_stu') {
            $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
            $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;
            $studentName = isset($_GET['studentName']) ? $_GET['studentName'] : null;

            if ($startDate !== null && $endDate !== null) {
                $query = "SELECT * FROM attendance_tbl
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
                WHERE attendance_tbl.Attended = 3 AND attendance_tbl.AttendanceDateIssue BETWEEN '$startDate' AND '$endDate'";

                if ($studentName !== null) {
                    $query .= " AND studentinfo_tbl.NameInLatin LIKE '%$studentName%'";
                }

                $query .= " GROUP BY studentstatus_tbl.StudentStatusID;";

                $result = mysqli_query($conn, $query);

                if ($result) {
                    echo '<div class="row"><div class="col-lg-12"><div class="card"><div class="card-body" id="reportTable" >';
                    echo '<div class="text-center"><h1>STUDENT ABSENT BY DATE</h1></div>';
                    echo '<table class="report-table">';
                    echo '<thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Faculty</th>
                                    <th>Major</th>
                                    <th>Semester</th>
                                    <th>Year</th>
                                    <th>Shift</th>
                                    <th>Batch</th>
                                    <th>Campus</th>
                                    <th>Room</th>
                                    <th>Attended</th>
                                </tr>
                          </thead>';
                    echo '<tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        $studentStatusID = $row['StudentStatusID'];
                        $sqlCount = "
                            SELECT 
                                SUM(CASE WHEN Attended = 1 THEN 1 ELSE 0 END) AS C,
                                SUM(CASE WHEN Attended = 2 THEN 1 ELSE 0 END) AS P,
                                SUM(CASE WHEN Attended = 3 THEN 1 ELSE 0 END) AS A
                            FROM attendance_tbl
                            WHERE StudentStatusID = $studentStatusID AND AttendanceDateIssue BETWEEN '$startDate' AND '$endDate'
                            GROUP BY StudentStatusID;
                        ";
                        
                        $resultCount = $conn->query($sqlCount);
                        $C = $P = $A = 0;
                        if ($resultCount) {
                            $countRow = $resultCount->fetch_assoc();
                            $C = $countRow['C'];
                            $P = $countRow['P'];
                            $A = $countRow['A'];
                        }

                        echo '<tr>
                                <td style="font-weight: bold;">' . $row["NameInLatin"] . '</td>
                                <td style="font-weight: bold;">' . $row["FacultyEN"] . '</td>
                                <td style="font-weight: bold;">' . $row["MajorEN"] . '</td>
                                <td style="font-weight: bold;">' . $row["SemesterEN"] . '</td>
                                <td style="font-weight: bold;">' . $row["YearEN"] . '</td>
                                <td style="font-weight: bold;">' . $row["ShiftEN"] . '</td>
                                <td style="font-weight: bold;">' . $row["BatchEN"] . '</td>
                                <td style="font-weight: bold;">' . $row["CampusEN"] . '</td>
                                <td style="font-weight: bold;">' . $row["RoomName"] . '</td>
                                <td style="font-weight: bold;">(A = ' . $A . ')</td>
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
                echo "Please select a start date and an end date.";
            }
        }
        ?>
    </main>
    <script>
        document.getElementById('searchDateBtn').addEventListener('click', function(event) {
            event.preventDefault(); 

            var startDate = document.getElementById('startDate').value;
            var endDate = document.getElementById('endDate').value;
            
            var url = '?tag=day_absent_stu&op=search';
            url += '&startDate=' + encodeURIComponent(startDate);
            url += '&endDate=' + encodeURIComponent(endDate);
            
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

            var startDate = document.getElementById('startDate').value;
            var endDate = document.getElementById('endDate').value;
            if (!startDate || !endDate) {
                swal("Error", "Please select a start date and an end date before searching by name.", "error");
                return;
            }

            var studentName = document.getElementById('studentName').value;
            
            var url = '?tag=day_absent_stu&op=search';
            url += '&startDate=' + encodeURIComponent(startDate);
            url += '&endDate=' + encodeURIComponent(endDate);
            url += '&studentName=' + encodeURIComponent(studentName);
            
            window.location.href = url;
        });

        var currentStartDate = new URLSearchParams(window.location.search).get('startDate');
        var currentEndDate = new URLSearchParams(window.location.search).get('endDate');
        if (currentStartDate && currentEndDate) {
            document.getElementById('startDate').value = currentStartDate;
            document.getElementById('endDate').value = currentEndDate;
        }
    </script>
</body>
</html>
