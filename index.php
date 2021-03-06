<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LDAP - GUI</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>


<?php

include_once("class/services/ldapUserService.class.php");
$ldapUserService = ldapUserService::getInstance();
?>

<div class="container-fluid" style="margin-top: 100px;">

    <!-- head part of main page -->
    <?php include 'parts/header.php'; ?>

    <?php if ($_SESSION["logged"]): ?>
    <!-- First row which manage user -->
    <div class="row">

        <?php
        $viewId = $_GET[viewUtil::$viewId];
        $views = viewUtil::getView($viewId);
        if (!empty($views)):
            ?>

            <div class="col-4">

                <!-- Add form part -->
                <?php include $views["form"]; ?>

            </div>

            <div class="col-8">

                <!-- users list part -->
                <?php include $views["list"]; ?>

            </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
    <!-- Footer part of main page -->
    <?php include 'parts/footer.php'; ?>

</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-confirmation.min.js"></script>
<script src="js/main.js"></script>
<script src="js/manageGroup.js"></script>

</body>
</html>
