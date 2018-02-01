<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 11/01/18
 * Time: 15:38
 */


if (isset($_GET['uid'])) {
    $uid = htmlspecialchars_decode($_GET['uid']);
}
if (isset($_GET['name'])) {
    $name = htmlspecialchars_decode($_GET['name']);
}
if (isset($_GET['surname'])) {
    $surname = htmlspecialchars_decode($_GET['surname']);
}

?>

<?php
if (!isset($uid)):
?>

    <!-- Add user form -->
    <form action="parts/actions/user/addUserAction.php" method="post">
    <div class="form-group">
        <label for="userName">Name</label>
        <input type="text" name="userName" class="form-control" id="userName" placeholder="Enter your name">
    </div>
    <div class="form-group">
        <label for="userSurname">Surname</label>
        <input type="text" name="userSurname" class="form-control" id="userSurname" placeholder="Enter your surname">
    </div>
    <button type="submit" class="btn btn-primary">Add user</button>
</form>

<?php
    else:;
?>

<h2>Update information of <?php echo $uid; ?></h2>
<!-- Add user form -->
        <form action="parts/actions/user/updateUserAction.php" method="post">
    <input type="hidden" name="uid" value="<?php echo $uid; ?>">
    <div class="form-group">
        <label for="userName">Name</label>
        <input type="text" name="userName" class="form-control" id="userName" value="<?php echo (!empty($name) ? $name : 'Enter '.$uid.' name'); ?>">
    </div>
    <div class="form-group">
        <label for="userSurname">Surname</label>
        <input type="text" name="userSurname" class="form-control" id="userSurname" value="<?php echo (!empty($surname) ? $surname : 'Enter '.$uid.' surname'); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update user</button>
    <a href="<?php echo 'http://'.$_SERVER["SERVER_NAME"].'/ldap/index.php'; ?>"><button type="button" class="btn btn-info">Reset</button></a>
</form>

<?php
    endif;
?>