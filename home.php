<?php include 'libs/load.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Teacher Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/table.css">
    <style>
        table th,
        table td {
            width: 20%;
            /* 100% divided by 4 columns */
            text-align: center;
        }

        table th {
            text-align: center;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.bootstrap.min.css">
</head>

<body>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Teacher Portal</h2>
        <a href="login.php?logout">
            <img src="assets/logout.png" alt="logout" style="height: 30px; width: 30px; margin-right: 50px;">
        </a>
    </div>

    <div id="alertMessage" class="alert alert-danger" role="alert" style="display: none;"><strong>Info!</strong><span id="messageContent"></span></div>
    <br>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Mark</th>
                <th style="text-align:center;width:100px;">Add Student <button type="button" data-func="dt-add" class="btn btn-success btn-xs dt-add" onclick="showAddStudentModal()">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </button></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = Database::getConnection();
            $sql = "SELECT * FROM student";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['subject']}</td>
            <td>{$row['marks']}</td>
            <td>
                <button type='button' class='btn btn-primary btn-xs dt-edit' style='margin-right:16px;' onclick=\"editStudent({$row['id']})\">
                    <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                </button>
                <button type='button' class='btn btn-danger btn-xs dt-delete' onclick=\"showDeleteStudentModal({$row['id']}, '{$row['name']}', '{$row['subject']}', '{$row['marks']}')\">
                    <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
                </button>
            </td>
        </tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Add Student Modal -->
    <div id="addStudentModal" class="modal">
        <div class="modal-content" style="width: 400px;">
            <span class="close" onclick="closeAddStudentModal()">&times;</span>
            <div class="wrapper">
                <div class="inner">
                    <img src="images/image-1.png" alt="" class="image-1">
                    <form id="addStudentForm" onsubmit="return addStudent()">
                        <h3>Add New Student</h3>
                        <div class="form-holder">
                            <span class="lnr lnr-user"></span>
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                        </div>
                        <br>
                        <div class="form-holder">
                            <span class="lnr lnr-book"></span>
                            <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                        </div>
                        <br>
                        <div class="form-holder">
                            <span class="lnr lnr-pencil"></span>
                            <input type="number" name="marks" class="form-control" placeholder="Marks" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success" style="float: right;">
                            <span>Add</span>
                        </button>
                    </form>
                    <img src="images/image-2.png" alt="" class="image-2">
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Student Modal -->
    <div id="deleteStudentModal" class="modal">
        <div class="modal-content" style="width: 400px;">
            <span class="close" onclick="closeDeleteStudentModal()">&times;</span>
            <div class="wrapper">
                <div class="inner">
                    <h3>Confirm Deletion</h3>
                    <p id="deleteStudentMessage"></p>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton" onclick="deleteStudent()">YES</button>
                    <button type="button" class="btn btn-success" onclick="closeDeleteStudentModal()">NO</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchStudents();
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');
            if (message) {
                showMessage(message);
                // Remove the message parameter from the URL without reloading the page
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });

        function showAddStudentModal() {
            document.getElementById('addStudentModal').style.display = 'block';
        }

        function closeAddStudentModal() {
            document.getElementById('addStudentModal').style.display = 'none';
        }

        function showDeleteStudentModal(id, name, subject, marks) {
            document.getElementById('deleteStudentMessage').innerText = `You want to delete ${name} with ${subject} and ${marks}`;
            document.getElementById('confirmDeleteButton').setAttribute('data-id', id);
            document.getElementById('deleteStudentModal').style.display = 'block';
        }

        function closeDeleteStudentModal() {
            document.getElementById('deleteStudentModal').style.display = 'none';
        }

        function addStudent() {
            const formData = new FormData(document.getElementById('addStudentForm'));
            fetch('add_student.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        closeAddStudentModal();
                        window.location.href = 'home.php?message=Successfully added student';
                    } else {
                        alert('Error adding student: ' + data.message);
                    }
                });
            return false;
        }

        function fetchStudents() {
            fetch('fetch_students.php')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('#example tbody');
                    tbody.innerHTML = '';
                    data.forEach(student => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${student.id}</td>
                            <td>${student.name}</td>
                            <td>${student.subject}</td>
                            <td>${student.marks}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-xs dt-edit" style="margin-right:16px;" onclick="editStudent(${student.id})">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-danger btn-xs dt-delete" onclick="showDeleteStudentModal(${student.id}, '${student.name}', '${student.subject}', '${student.marks}')">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                </button>
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                });
        }

        function editStudent(id) {
            window.location.href = `edit_student.php?id=${id}`;
        }

        function deleteStudent() {
            const id = document.getElementById('confirmDeleteButton').getAttribute('data-id');
            fetch('delete_student.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        id: id
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        closeDeleteStudentModal();
                        window.location.href = 'home.php?message=Successfully deleted the student';
                    } else {
                        alert('Error deleting student: ' + data.message);
                    }
                });
        }

        function showMessage(message) {
            const alertDiv = document.getElementById('alertMessage');
            const messageContent = document.getElementById('messageContent');
            messageContent.innerText = message;
            alertDiv.style.display = 'block';
        }
    </script>
</body>

</html>