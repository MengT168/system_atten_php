<?php
// fetch_rooms.php
include 'db_connection.php'; // Make sure this file connects to your database

if (isset($_POST['campusID'])) {
    $campusID = $_POST['campusID'];

    $query = "SELECT RoomID, RoomName FROM room_tbl WHERE CampusID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $campusID);
    $stmt->execute();
    $result = $stmt->get_result();

    $rooms = "<option value=''>Select One</option>";
    while ($row = $result->fetch_assoc()) {
        $rooms .= "<option value='{$row['RoomID']}'>{$row['RoomName']}</option>";
    }

    echo $rooms;
}
?>
