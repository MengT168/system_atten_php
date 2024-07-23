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
                            <h5 class="card-title">Absent Report By Batch</h5>
                            <div class="row g-2">
                                <div class="col-3">
                                    <label class="form-label">Batch</label>
                                    <select id="batch" name="academicpro" class="form-select">
                                        <option value="">Select One</option>
                                        <?php getBatch(); ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <a id="searchMajorBtn" style="margin-top: 30px;" href="#" class="btn btn-primary">Search</a>
                                </div>
                                <div class="col-3 hidden" id="lecturerNameContainer">
                                    <label class="form-label">Lecturer Name</label>
                                    <input type="text" id="lecturerName" class="form-control">
                                </div>
                                <div class="col-2 hidden" id="searchNameBtnContainer">
                                    <a id="searchNameBtn" style="margin-top: 30px;" href="#" class="btn btn-primary">Search by Name</a>
                                </div>
                                <div class="col-2 hidden" id="refreshBtnContainer">
                                    <a id="searchNameBtn" style="margin-top: 30px;" href="?tag=batch_lecturer_report&op=search&batch=<?php echo $batch = isset($_GET['batch']) ? $_GET['batch'] : null; ?> "class="btn btn-primary">Refresh</a>
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
        if (isset($_GET['op']) && $_GET['op'] == 'search' && isset($_GET['tag']) && $_GET['tag'] == 'batch_lecturer_report') {
            $batch = isset($_GET['batch']) ? $_GET['batch'] : null;
            $lecturerName = isset($_GET['lecturerName']) ? $_GET['lecturerName'] : null;

            if ($batch !== null && $batch !== '') {
                $query = "SELECT * FROM `schedule_tbl` 
                    INNER JOIN program_tbl ON schedule_tbl.ProgramID = program_tbl.ProgramID
                    INNER JOIN batch_tbl ON program_tbl.BatchID = batch_tbl.BatchID
                    INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
                    INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
                    INNER JOIN major_tbl ON program_tbl.MajorID = major_tbl.MajorID
                    INNER JOIN subject_tbl ON schedule_tbl.SubjectID = subject_tbl.SubjectID
                    INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID
                    INNER JOIN lecturer_tbl ON schedule_tbl.LecturerID = lecturer_tbl.LecturerID
                    INNER JOIN campus_tbl ON program_tbl.CampusID = campus_tbl.CampusID
                    INNER JOIN room_tbl ON schedule_tbl.RoomID = room_tbl.RoomID
                    INNER JOIN faculty_tbl ON program_tbl.FacultyID = faculty_tbl.FacultyID
                    WHERE batch_tbl.BatchID=$batch";

                if ($lecturerName !== null && $lecturerName !== '') {
                    $query .= " AND lecturer_tbl.LecturerName LIKE '%" . $conn->real_escape_string($lecturerName) . "%'";
                }
                // $query .= " GROUP BY schedule_tbl.LecturerID";

                $result = $conn->query($query);

                if ($result) {
                    echo '<div class="row"><div class="col-lg-12"><div class="card"><div class="card-body" id="reportTable" >';
                    echo '<div class="text-center"><h1>REPORT LECTURER TEACH BY BATCH</h1></div>';
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
                            <th>Subject</th>
                            <th>Room</th>
                          </tr></thead>';
                    echo '<tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td style="font-weight: bold;">' . htmlspecialchars($row["LecturerName"]) . '</td>
                                <td style="font-weight: bold;">' . htmlspecialchars($row["FacultyEN"]) . '</td>
                                <td style="font-weight: bold;">' . htmlspecialchars($row["MajorEN"]) . '</td>
                                <td style="font-weight: bold;">' . htmlspecialchars($row["SemesterEN"]) . '</td>
                                <td style="font-weight: bold;">' . htmlspecialchars($row["YearEN"]) . '</td>
                                <td style="font-weight: bold;">' . htmlspecialchars($row["ShiftEN"]) . '</td>
                                <td style="font-weight: bold;">' . htmlspecialchars($row["BatchEN"]) . '</td>
                                <td style="font-weight: bold;">' . htmlspecialchars($row["CampusEN"]) . '</td>
                                <td style="font-weight: bold;">' . htmlspecialchars($row["SubjectEN"]) . '</td>
                                <td style="font-weight: bold;">' . htmlspecialchars($row["RoomName"]) . '</td>
                              </tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div></div></div></div>';

                    echo '<script>
                        document.getElementById("lecturerNameContainer").classList.remove("hidden");
                        document.getElementById("searchNameBtnContainer").classList.remove("hidden");
                        document.getElementById("refreshBtnContainer").classList.remove("hidden");
                        document.getElementById("exportBtnContainer").classList.remove("hidden");
                    </script>';
                } else {
                    echo "Invalid query: " . $conn->error;
                }
            } else {
                echo "Batch not provided.";
            }
        }
        ?>
    </main>
    <script>
        document.getElementById('searchMajorBtn').addEventListener('click', function(event) {
            event.preventDefault(); 

            var batch = document.getElementById('batch').value;
            
            var url = '?tag=batch_lecturer_report&op=search';
            url += '&batch=' + encodeURIComponent(batch);
            
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

            var batch = document.getElementById('batch').value;
            if (!batch) {
                swal("Error", "Please select a batch before searching by name.", "error");
                return;
            }

            var lecturerName = document.getElementById('lecturerName').value;
            
            var url = '?tag=batch_lecturer_report&op=search';
            url += '&batch=' + encodeURIComponent(batch);
            url += '&lecturerName=' + encodeURIComponent(lecturerName);
            
            window.location.href = url;
        });

        // Restore the batch selection after a search
        var currentBatch = new URLSearchParams(window.location.search).get('batch');
        if (currentBatch) {
            document.getElementById('batch').value = currentBatch;
        }
    </script>
</body>
</html>
