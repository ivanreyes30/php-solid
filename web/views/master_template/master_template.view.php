<?php
    global $appUrl;
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        <?php echo $this->title; ?>
    </title>
    <link rel="stylesheet" href="<?php echo "{$appUrl}/web/views/styles/global.css" ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body>
    <div class="app">
        <?php include_once $this->body; ?>
    </div>
</body>

</html>