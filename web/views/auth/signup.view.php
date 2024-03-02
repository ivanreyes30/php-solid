<link rel="stylesheet" href="<?php echo "{$appUrl}/web/views/styles/signup.css" ?>">

<div class="signup-form">
    <div class="mb-3">
        <h2>Sign Up</h2>
        <small>
            Already a member? <a href="">Sign In</a>
        </small>
    </div>
    <form>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" required>
        </div>
        <div class="mb-2">
            <label for="gpa" class="form-label">GPA</label>
            <input type="number" class="form-control" id="gpa" name="gpa" required>
        </div>
        <div class="mb-4">
            <input class="form-check-input" type="checkbox" id="agree-terms">
            <label class="form-check-label" for="agree-terms">
                I agree to the terms of the <a href="">Privacy Policy</a>.
            </label>
        </div>
        <button type="submit" class="btn btn-primary w-100 mb-3">Sign Up</button>
    </form>
</div>