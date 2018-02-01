<?php

include_once(dirname(__FILE__, 3) . "/class/bean/ldapUser.class.php");
include_once(dirname(__FILE__, 3) . "/class/services/ldapUserService.class.php");

// getting users data in order to display it
$users = ldapUserService::getInstance()->getUsers();
?>

<hr/>

<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Surname</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Home directory</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    <?php
    $counter = 0;

    foreach ($users as &$user):

        $counter++;
        ?>
        <tr>
            <th scope="row"><?php echo $counter; ?></th>
            <td><?php echo $user->getSurname(); ?></td>
            <td><?php echo $user->getName(); ?></td>
            <td><?php echo $user->getDescription(); ?></td>
            <td><?php echo $user->getHomeDirectory(); ?></td>
            <td>
                <div class="row">

                    <div class="col-6">
                        <form method="post" action="index.php">

                            <input type="hidden" name="uid" value="<?php echo $user->getUid(); ?>">
                            <input type="hidden" name="name" value="<?php echo $user->getName(); ?>">
                            <input type="hidden" name="surname" value="<?php echo $user->getSurname(); ?>">
                            <input type="hidden" name="description" value="<?php echo $user->getDescription(); ?>">
                            <input type="hidden" name="homeDirectory" value="<?php echo $user->getHomeDirectory(); ?>">

                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                    </div>

                    <div class="col-6">
                        <a href="<?php echo './parts/actions/user/removeUserAction.php?uid=' . $user->getUid(); ?>">
                            <button type="button" class="btn btn-danger">Remove</button>
                        </a>
                    </div>
                </div>
            </td>
        </tr>
    <?php
    endforeach;
    ?>


    </tbody>
</table>