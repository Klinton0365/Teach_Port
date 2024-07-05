<?php
include_once 'libs/core/Database.class.php';

$id = $_POST['id'];

$conn = Database::getConnection();
$sql = "DELETE FROM student WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}
?>
