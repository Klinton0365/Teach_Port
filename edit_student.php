<?php include 'libs/load.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Student</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<body>
    <?php
    if (isset($_GET['id'])) {
        $conn = Database::getConnection();
        $id = $_GET['id'];
        $sql = "SELECT * FROM student WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();
    } else { ?>
        <script>
            window.location.href = "home.php";
        </script>
    <?php }
    ?>
    <div class="container">
        <h2>Edit Student</h2>
        <form id="editStudentForm" onsubmit="return editStudent()">
            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $student['id']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $student['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $student['subject']; ?>" required>
            </div>
            <div class="form-group">
                <label for="marks">Marks</label>
                <input type="number" class="form-control" id="marks" name="marks" value="<?php echo $student['marks']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
    <script>
        function editStudent() {
            const formData = new FormData(document.getElementById('editStudentForm'));
            fetch('update_student.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        window.location.href = 'home.php?message=Successfully updated the student record';
                    } else {
                        alert('Error updating student: ' + data.message);
                    }
                });
            return false;
        }
    </script>
</body>

</html>