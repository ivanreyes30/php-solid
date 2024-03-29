<link rel="stylesheet" href="<?php echo "{$appUrl}/web/views/styles/login.css" ?>">

<div class="login-container">
    <form id="login-form">
        <?php include_once "$filepath/web/views/master_template/alert.view.php" ?>
        <h2 class="mb-4">Login</h2>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-4 text-right">
            Not a member? <a href="<?php echo "{$appUrl}/web/sign-up" ?>">Register</a>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>

<script src="<?php echo "{$appUrl}/web/views/js/login.js" ?>"></script>