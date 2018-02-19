<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 19/02/2018
 * Time: 10:17
 */
?>

<h3>File Export</h3>
<br>

<form action="parts/actions/file/exportAction.php" method="post">
    <div class="form-group">
        <input type="hidden" name="format" value="csv">
        <button type="submit" class="btn btn-primary">Export to CSV</button>
    </div>
</form>

<form action="parts/actions/file/exportAction.php" method="post">
    <div class="form-group">
        <input type="hidden" name="format" value="json">
        <button type="submit" class="btn btn-primary">Export to JSON</button>
    </div>

</form>