<?php
include("./connect.php");
global $conn;

if(isset($_POST['programID'])) {
    $id = $_POST['programID'];
}
?>