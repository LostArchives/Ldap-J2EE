<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 11/01/18
 * Time: 15:38
 */

?>

<!-- Add user form -->
<form action="../actions/addUserAction.php">
    <div class="form-group">
        <label for="userName">Name</label>
        <input type="text" name="userName" class="form-control" id="userName" placeholder="Enter your name">
    </div>
    <div class="form-group">
        <label for="userSurname">Surname</label>
        <input type="text" name="userSurname" class="form-control" id="userSurname" placeholder="Enter your surname">
    </div>
    <div class="form-group">
        <label for="userPassword">Password</label>
        <input type="password" name="userPassword" class="form-control" id="userPassword" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="userRepeatPassword">Repeat password</label>
        <input type="password" name="userRepeatPassword" class="form-control" id="userRepeatPassword" placeholder="Repeat password">
    </div>
    <button type="submit" class="btn btn-primary">Add user</button>
</form>