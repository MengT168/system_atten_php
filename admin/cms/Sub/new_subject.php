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
    <title>Document</title>
    <script>
        function updateMajorList(FacultyID) {
            $.ajax({
                url: 'FetchFacul.php',
                type: 'POST',
                data: { facultyID: FacultyID },
                success: function(response) {
                    $('select[name="majorId"]').html(response);
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
                            <h5 class="card-title">Subject Form</h5>

                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div >
                                    <label class="form-label my-3">Please Select Year</label>
                                    <select name="YearID" class="form-select" id="">
                                        <option value="">Select Year</option>
                                        <?php getYear() ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label my-3">Please Select Faculty</label>
                                    <select name="FacultyID" class="form-select" onchange="updateMajorList(this.value)">
                                        <option value="">Select Faculty</option>
                                        <?php getFaculty() ?>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label my-3">Please Select Major</label>
                                    <select name="majorId" class="form-select" id="">
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label my-3">Please Select Semester</label>
                                    <select name="SemesterID" class="form-select" id="">
                                        <option value="">Select Semester</option>
                                        <?php getSemester() ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Subject (KH) </label>
                                    <input type="text" class="form-control" name="SubjectKH" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Subject (EN) </label>
                                    <input type="text" class="form-control" name="SubjectEN" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Credit Number </label>
                                    <input type="text" class="form-control" name="CreditNumber" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Hour</label>
                                    <input type="text" class="form-control" name="Hours" required />
                                </div>
                                <div class="text-center">
                                    <input type="submit" name="btn_sub" class="btn btn-primary">
                                    </input>
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
