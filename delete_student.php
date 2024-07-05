<?php
include_once 'libs/load.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

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
