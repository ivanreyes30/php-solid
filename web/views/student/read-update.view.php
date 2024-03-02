<link rel="stylesheet" href="<?php echo "{$appUrl}/web/views/styles/student-read-update.css" ?>">

<div class="student-container">
    <form id="student-form">
        <div class="form-group">
            <h3>Student Information Details</h3>
            <small>You can view and update information of student.</small>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="first-name">First Name</label>
            <input type="text" id="first-name" name="first-name">
        </div>
        <div class="form-group">
            <label for="middle-name">Middle Name</label>
            <input type="text" id="middle-name" name="middle-name">
        </div>
        <div class="form-group">
            <label for="last-name">Last Name</label>
            <input type="text" id="last-name" name="last-name">
        </div>
        <button type="submit" class="btn btn-success">
            Update
        </button>
    </form>
</div>