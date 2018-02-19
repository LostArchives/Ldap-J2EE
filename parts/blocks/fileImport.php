<?php
/**
 * Created by PhpStorm.
 * User: Valentin
 * Date: 19/02/2018
 * Time: 10:17
 */

?>

<h3>File Import</h3>
<br>

<form action="parts/actions/file/importAction.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden" name="format" value="csv">
        <input type="file" name="fileToUpload" class="form-control-file" accept=".csv">
    </div>
    <button type="submit" class="btn btn-primary" >Upload CSV File</button>
</form>

<br>

<form action="parts/actions/file/importAction.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden" name="format" value="json">
        <input type="file" name="fileToUpload" class="form-control-file" accept=".json">
    </div>
    <button type="submit" class="btn btn-primary" >Upload JSON File</button>
</form>
