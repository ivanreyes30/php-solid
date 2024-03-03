<link rel="stylesheet" href="<?php echo "{$appUrl}/web/views/styles/errors.css" ?>">

<div class="error-container">
    <h1 class="error-heading text-danger">
        <?php echo $this->errorTitle; ?>
    </h1>
    <p class="error-message text-danger">
        <?php echo $this->errorMessage; ?>
    </p>
    <a href="#" class="btn btn-success go-back">Go Back</a>
</div>