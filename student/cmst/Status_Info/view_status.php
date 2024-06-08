<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
<main id="main" class="main">
       
       <section class="section">
           <div class="row">
               <div class="col-lg-8">
                   <div class="card">
                       <div class="card-body">
                       <div class="tab-pane fade show  profile-overview" >            
             

              <div><h4 style="text-align: center;" >Student Status</h4></div>
                <?php

                $id = $_SESSION['id'];
                
               $sql1="SELECT * FROM `studentstatus_tbl` 
               INNER JOIN studentinfo_tbl ON studentstatus_tbl.StudentID = studentinfo_tbl.StudentID
               INNER JOIN program_tbl ON studentstatus_tbl.ProgramID = program_tbl.ProgramID
               INNER JOIN faculty_tbl ON program_tbl.FacultyID = faculty_tbl.FacultyID
               INNER JOIN major_tbl ON program_tbl.MajorID = major_tbl.MajorID
               INNER JOIN year_tbl ON program_tbl.YearID = year_tbl.YearID
               INNER JOIN semester_tbl ON program_tbl.SemesterID = semester_tbl.SemesterID
               INNER JOIN academicyear_tbl ON program_tbl.AcademicYearID = academicyear_tbl.AcademicYearID
               INNER JOIN batch_tbl ON program_tbl.BatchID = batch_tbl.BatchID
               INNER JOIN campus_tbl ON program_tbl.CampusID = campus_tbl.CampusID
               INNER JOIN degree_tbl ON program_tbl.DegreeID = degree_tbl.DegreeID
               INNER JOIN shift_tbl ON program_tbl.ShiftID = shift_tbl.ShiftID WHERE studentstatus_tbl.StudentID  = $id";
             $rs=$conn->query($sql1);
                    while($rw = mysqli_fetch_assoc($rs)){
                ?>

              <div class="row">
                <div class="col-lg-6 col-md-4 label ">Program ID</div>
                <div class="col-lg-6 col-md-8 A" ><h6><?php echo $rw['ProgramID'] ?></h6></div>
              </div>

              <div class="row">
                <div class="col-lg-6 col-md-4 label">Faculty</div>
                <div class="col-lg-6 col-md-8 A" ><h6><?php echo $rw['FacultyEN'] ?></h6></div>
              </div>

              <div class="row">
                <div class="col-lg-6 col-md-4 label">Major</div>
                <div class="col-lg-6 col-md-8 A" ><h6><?php echo $rw['MajorEN'] ?></h6></div>
              </div>

              <div class="row">
              <div class="col-lg-6 col-md-4 label">Year</div>
                <div class="col-lg-6 col-md-8 A" ><h6><?php echo $rw['YearEN'] ?></h6></div>
              </div>
              
              <div class="row">
                <div class="col-lg-6 col-md-4 label">Semester</div>
                <div class="col-lg-6 col-md-8 A" ><h6><?php echo $rw['SemesterEN'] ?></h6></div>
              </div>
              
              <div class="row">
                <div class="col-lg-6 col-md-4 label">Shift</div>
                <div class="col-lg-6 col-md-8"><h6><?php echo $rw['ShiftEN'] ?></h6></div>
              </div>

                    

              <div class="row">
                <div class="col-lg-6 col-md-4 label">Degree</div>
                <div class="col-lg-6 col-md-8"><h6><?php echo $rw['DegreeNameEN'] ?></h6></div>
              </div>



              <div class="row">
                <div class="col-lg-6 col-md-4 label">Academic Year</div>
                <div class="col-lg-6 col-md-8"><h6><?php echo $rw['AcademicYear'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-4 label">Batch</div>
                <div class="col-lg-6 col-md-8"><h6><?php echo $rw['BatchEN'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-4 label">Campus</div>
                <div class="col-lg-6 col-md-8"><h6><?php echo $rw['CampusEN'] ?></h6></div>
              </div>
     <div class="row">
         <div class="col-lg-6 col-md-4 label ">Assigned</div>
         <div class="col-lg-6 col-md-8 A" ><h6><?php echo $rw['Assigned'] ?></h6></div>
       </div>

       <div class="row">
         <div class="col-lg-6 col-md-4 label">Note</div>
         <div class="col-lg-6 col-md-8 A" ><h6><?php echo $rw['Note'] ?></h6></div>
       </div>

       <div class="row">
         <div class="col-lg-6 col-md-4 label">AssignDate</div>
         <div class="col-lg-6 col-md-8 A" ><h6><?php echo $rw['AssignDate'] ?></h6></div>
       </div>
         
              <?php } ?>
              <?php
                $sql = "SELECT * FROM educationalbackground_tbl
                INNER JOIN schooltype_tbl on educationalbackground_tbl.SchoolTypeID = schooltype_tbl.SchoolTypeID
                WHERE StudentID = $id";
                $rs= $conn->query($sql);
                while($row=mysqli_fetch_assoc($rs)){
              ?>
              <div><h4 style="text-align: center; margin-top: 10px; " >Educational Background</h4></div>
              <div class="row">
                <div class="col-lg-6 col-md-4 label">High School Name</div>
                <div class="col-lg-6 col-md-8"><h6><?php echo $row['NameSchool'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-4 label">High School Type</div>
                <div class="col-lg-6 col-md-8"><h6><?php echo $row['SchoolTypeEN'] ?></h6></div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-md-4 label">Academic Year</div>
                <div class="col-lg-6 col-md-8"><h6><?php echo $row['AcademicYear'] ?></h6></div>
              </div>
               <?php } ?>
            </div>
                       </div>
                   </div>
               </div>
           </div>
       </section>
   </main>
</body>
</html>