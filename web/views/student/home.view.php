<link rel="stylesheet" href="<?php echo "{$appUrl}/web/views/styles/student-home.css" ?>">

<div class="student-info">
    <h2>User Information</h2>
    <div class="mb-3">
        <label>Email:</label>
        <p class="form-control-static">
            <?php echo $_SESSION['account']['email']; ?>
        </p>
    </div>
    <div class="mb-3">
        <label>Full Name:</label>
        <p class="form-control-static">
            <?php echo $_SESSION['account']['name']; ?>
        </p>
    </div>
    <div class="mb-3">
        <label>Age:</label>
        <p class="form-control-static">
            <?php echo $_SESSION['account']['age']; ?>
        </p>
    </div>
    <div class="mb-3">
        <label>GPA:</label>
        <p class="form-control-static">
            <?php echo $_SESSION['account']['gpa']; ?>
        </p>
    </div>
    <div class="d-flex justify-content-center">
        <button class="btn btn-danger text-center w-50 logout">Logout</button>
    </div>
</div>