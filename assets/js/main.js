document.addEventListener('DOMContentLoaded', function() {
    fetchStudents();

    document.getElementById('addStudentForm').onsubmit = function(event) {
        event.preventDefault();
        addStudent();
    };
});

function fetchStudents() {
    fetch('fetch_students.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#studentsTable tbody');
            tbody.innerHTML = '';
            data.forEach(student => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${student.name}</td>
                    <td>${student.subject}</td>
                    <td>${student.marks}</td>
                    <td>
                        <button onclick="editStudent(${student.id})">Edit</button>
                        <button onclick="deleteStudent(${student.id})">Delete</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        });
}

function showAddStudentModal() {
    document.getElementById('addStudentModal').style.display = 'block';
}

function closeAddStudentModal() {
    document.getElementById('addStudentModal').style.display = 'none';
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
            fetchStudents();
        } else {
            alert('Error adding student: ' + data.message);
        }
    });
}

function editStudent(id) {
    // Implement inline edit functionality here
}

function deleteStudent(id) {
    if (confirm('Are you sure you want to delete this student?')) {
        const formData = new FormData();
        formData.append('id', id);
        fetch('delete_student.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                fetchStudents();
            } else {
                alert('Error deleting student: ' + data.message);
            }
        });
    }
}
