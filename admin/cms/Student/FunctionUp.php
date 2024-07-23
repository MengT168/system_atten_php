<?php
require('./connect.php');
require ('../../vendor/phpoffice/phpexcel/Classes/PHPExcel.php');

function InsertFromExcel()
{
    global $conn;

    if (isset($_POST["btn_upload"])) {
        $file = $_FILES['student_excel']['tmp_name'];

        $excelReader = PHPExcel_IOFactory::createReaderForFile($file);
        $excelObj = $excelReader->load($file);
        $worksheet = $excelObj->getSheet(0);
        $lastRow = $worksheet->getHighestRow();

        for ($row = 2; $row <= $lastRow; $row++) {
            $namekhmer = $worksheet->getCell('A' . $row)->getValue();
            $namelatin = $worksheet->getCell('B' . $row)->getValue();
            $familyname = $worksheet->getCell('C' . $row)->getValue();
            $givenname = $worksheet->getCell('D' . $row)->getValue();
            $gender = $worksheet->getCell('E' . $row)->getValue();
            $idpassport = $worksheet->getCell('F' . $row)->getValue();
            $nationality = $worksheet->getCell('G' . $row)->getValue();
            $country = $worksheet->getCell('H' . $row)->getValue();
            $dob = $worksheet->getCell('I' . $row)->getValue();
            $pob = $worksheet->getCell('J' . $row)->getValue();
            $phonenumber = $worksheet->getCell('K' . $row)->getValue();
            $email = $worksheet->getCell('L' . $row)->getValue();
            $currentadrr = $worksheet->getCell('M' . $row)->getValue();
            $currentadrrPP = $worksheet->getCell('N' . $row)->getValue();
            $image = ""; // Add logic for image if needed

            if (!empty($namekhmer) && !empty($namelatin) && !empty($familyname) && !empty($givenname) && !empty($idpassport) && !empty($dob) && !empty($pob) && !empty($phonenumber) && !empty($email) && !empty($currentadrr) && !empty($currentadrrPP)) {
                $sql_ins = "INSERT INTO studentinfo_tbl (`NameInKhmer`, `NameInLatin`, `FamilyName`, `GivenName`, `SexID`, `IDPassportNo`, `NationalityID`, `CountryID`, `DOB`, `POB`, `PhoneNumber`, `Email`, `CurrentAddress`, `CurrentAddressPP`, `Photo`)
                            VALUES ('$namekhmer','$namelatin','$familyname','$givenname','$gender','$idpassport','$nationality', '$country' ,'$dob','$pob','$phonenumber','$email','$currentadrr' ,'$currentadrrPP' ,'$image')";
                $rs = $conn->query($sql_ins);
                if (!$rs) {
                    echo "Error inserting row $row: " . $conn->error . "<br>";
                }
            } else {
                echo "Missing data in row $row.<br>";
            }
        }
        echo '<script>
                $(document).ready(function(){
                    swal({
                        title: "Success!",
                        text: "Upload Success",
                        icon: "success",
                        button: "Done",
                    });
                });
              </script>';
    }
}

InsertFromExcel();
?>
