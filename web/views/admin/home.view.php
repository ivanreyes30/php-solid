<?php
include_once "$filepath/web/views/admin/student.modal.php";
include_once "$filepath/web/views/master_template/alert.view.php";
?>

<link rel="stylesheet" href="<?php echo "{$appUrl}/web/views/styles/admin-home.css" ?>">

<div class="home-container container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="mb-3">
                    <h5 class="card-title">Student Information List</h5>
                    <p class="card-text">
                        <small>
                            You can create, update and delete students.
                        </small>
                    </p>
                </div>
                <button type="button" class="btn btn-success btn-student-modal action" data-bs-toggle="modal" action="create">
                    Add Student
                </button>
            </div>
            <div class="card-content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Email Address</td>
                            <td>Name</td>
                            <td>Age</td>
                            <td>GPA</td>
                            <td style="width: 8%;">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6">No data found.</td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-danger float-right logout">Logout</button>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo "{$appUrl}/web/views/js/admin-home.js" ?>"></script>