<?php
include_once 'libs/core/Database.class.php';

$conn = Database::getConnection();
$sql = "SELECT * FROM student";
$result = $conn->query($sql);

$students = array();
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

echo json_encode($students);
?>
