<?php
include_once '../libs/core/Database.class.php';
include_once '../libs/core/Session.class.php';

$action = $_GET['action'];

if ($action == 'fetch') {
    fetchStudents();
} elseif ($action == 'add') {
    addStudent();
} elseif ($action == 'edit') {
    editStudent();
} elseif ($action == 'delete') {
    deleteStudent();
}

function fetchStudents() {
    $conn = Database::getConnection();
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);

    $students = array();
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    echo json_encode($students);
}

function addStudent() {
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
}

function editStudent() {
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
}

function deleteStudent() {
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
}
?>
