<?php
  require('FunctionUp.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
</head>
<body>
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Student Form</h5>
                            <form class="row g-3" method="post" enctype="multipart/form-data">
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Student Excel File</label>
                                    <input type="file" class="form-control" name="student_excel">
                                </div>
                                <div class="text-center">
                                    <input type="submit" name="btn_upload" class="btn btn-primary" value="Upload">
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
