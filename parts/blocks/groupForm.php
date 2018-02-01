<?php
/**
 * Created by PhpStorm.
 * User: jbuisine
 * Date: 11/01/18
 * Time: 15:38
 */

?>

<!-- Add group form -->
<form action="parts/actions/group/addGroupAction.php" method="post">
    <div class="form-group">
        <label for="groupName">Name</label>
        <input type="text" name="groupName" class="form-control" id="groupName" placeholder="Enter your group name">
    </div>
    <button type="submit" class="btn btn-primary">Add group</button>
</form>