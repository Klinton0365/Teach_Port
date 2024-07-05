<?php
include_once 'libs/core/Database.class.php';

$id = $_POST['id'];
$name = $_POST['name'];
$subject = $_POST['subject'];
$marks = $_POST['marks'];

$conn = Database::getConnection();
$sql = "UPDATE student SET name=?, subject=?, marks=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $name, $subject, $marks, $id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}
?>
