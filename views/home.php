<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Portal</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/main.js"></script>
</head>
<body>
    <h2>Teacher Portal</h2>
    <button onclick="showAddStudentModal()">Add New Student</button>
    <table id="studentsTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Subject</th>
                <th>Marks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Student rows will be populated here -->
        </tbody>
    </table>
    <div id="addStudentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddStudentModal()">&times;</span>
            <h2>Add Student</h2>
            <form id="addStudentForm" onsubmit="return addStudent()">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>
                <label for="marks">Marks:</label>
                <input type="number" id="marks" name="marks" required>
                <button type="submit">Add</button>
            </form>
        </div>
    </div>
</body>
</html>
