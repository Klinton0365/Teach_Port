<?php include 'libs/load.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Teacher Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/main.js"></script>
    <link rel="stylesheet" href="assets/css/table.css">
    <style>
        table th, table td {
            width: 25%; /* 100% divided by 4 columns */
            text-align: center;
        }
        table th {
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.bootstrap.min.css">
</head>

<body>
    <h2>Teacher Portal</h2>
    <div class="alert alert-danger" role="alert"><strong>Info!</strong> Add row and Delete row are working. Edit row displays modal with row cells information.</div>
    <br>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Subject</th>
                <th>Mark</th>
                <th style="text-align:center;width:100px;">Add Student <button type="button" data-func="dt-add" class="btn btn-success btn-xs dt-add">
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
            <td>{$row['name']}</td>
            <td>{$row['subject']}</td>
            <td>{$row['marks']}</td>
            <td>
                <button type='button' class='btn btn-primary btn-xs dt-edit' style='margin-right:16px;'>
                    <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                </button>
                <button type='button' class='btn btn-danger btn-xs dt-delete'>
                    <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
                </button>
            </td>
        </tr>";
            }
            ?>
        </tbody>

    </table>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Row information</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <!-- <button onclick="showAddStudentModal()">Add New Student</button>
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
            <?php
            $conn = Database::getConnection();
            $sql = "SELECT * FROM student";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['subject']}</td>
                        <td>{$row['marks']}</td>
                        <td>
                            <button onclick=\"editStudent({$row['id']})\">Edit</button>
                            <button onclick=\"deleteStudent({$row['id']})\">Delete</button>
                        </td>
                    </tr>";
            }
            ?>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchStudents();
        });
    </script> -->
    <script src="assets/js/table.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>