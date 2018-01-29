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
        <label for="userId">uId</label>
        <input type="text" name="userId" class="form-control" id="userId" placeholder="Enter user id">
    </div>
    <div class="form-group">
        <label for="userFirstname">Firstname</label>
        <input type="text" name="userFirstname" class="form-control" id="userFirstname" placeholder="Enter your firstname">
    </div>
    <div class="form-group">
        <label for="userLastname">Lastname</label>
        <input type="text" name="userLastname" class="form-control" id="userLastname" placeholder="Enter your lastname">
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