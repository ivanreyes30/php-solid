<?php
    include_once "$filepath/web/views/admin/student.modal.php";
?>

<link rel="stylesheet" href="<?php echo "{$appUrl}/web/views/styles/admin-home.css" ?>">

<div class="card container">
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
            <button type="button" class="btn btn-success btn-student-modal" data-bs-toggle="modal" data-bs-target="#studentModal">
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
                        <td>1</td>
                        <td>student@gmail.com</td>
                        <td>Ivan Reyes</td>
                        <td>26</td>
                        <td>1.0</td>
                        <td class="text-center">
                            <i class="bi bi-trash-fill actions text-danger"></i>
                            <i class="bi bi-pencil-square actions text-warning" data-bs-toggle="modal" data-bs-target="#studentModal"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-outline-danger float-right">Logout</button>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>