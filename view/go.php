<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $SITE->Info('description'); ?>">
    <link rel="icon" href="favicon.ico">
    <title><?php echo $SITE->Info('name'); ?></title>
    <script src="view/js/jquery-1.11.0.js"></script>
</head>
<body>

<script type="text/javascript">
setTimeout(function() {
  window.location.href = "<?php  GoURL($URL);  ?>";
}, 10);
</script>