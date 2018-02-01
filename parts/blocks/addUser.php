<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 11/01/18
 * Time: 15:38
 */

?>

<!-- Add user form -->
<form action="parts/actions/addUserAction.php" method="post">
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