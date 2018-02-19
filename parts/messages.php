<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 19/02/2018
 * Time: 11:57
 */

//$ldapMessage = ldapMessageUtil::getInstance();
include_once(dirname(__FILE__, 2) . "/class/util/ldapMessageUtil.class.php");

$ldapMessage = ldapMessageUtil::getInstance();

if ($_GET["message"]) :
    $type = $_GET["type"];
    $action = $_GET["action"];
    $param = $_GET["param"];
    if ($type == "success"):
        ?>
        <div class="alert alert-<?php echo $type; ?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?php echo $ldapMessage->getSuccessMessage($action, $param); ?></strong>
        </div>

    <?php endif ?>
    <?php if ($type =="danger"): ?>
    <div class="alert alert-<?php echo $type; ?> alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $ldapMessage->getErrorMessage($action, $param); ?></strong>
    </div>

    <?php endif ?>


<?php endif ?>