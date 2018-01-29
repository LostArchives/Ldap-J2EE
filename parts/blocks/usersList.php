<?php

include_once(dirname(__FILE__, 3) . "/class/ldapUser.class.php");
include_once(dirname(__FILE__, 3) . "/class/ldapUserService.class.php");

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
            <td><a href="<?php echo './parts/actions/removeUserAction.php?uid='.$user->getUid(); ?>"><button type="button" class="btn btn-danger">Remove</button></a></td>
        </tr>
        <?php
    endforeach;
    ?>


    </tbody>
</table>