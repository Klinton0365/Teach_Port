<?php
include_once 'libs/load.php';

$name = $_POST['name'];
$subject = $_POST['subject'];
$marks = $_POST['marks'];

$conn = Database::getConnection();

$sql = "SELECT * FROM student WHERE name=? AND subject=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $subject);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $sql = "UPDATE student SET marks=marks+? WHERE name=? AND subject=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $marks, $name, $subject);
} else {
    $sql = "INSERT INTO student (name, subject, marks) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $subject, $marks);
}

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}
?>
