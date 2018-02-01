<?php

include_once(dirname(__FILE__, 3) . "/class/bean/ldapGroup.class.php");
include_once(dirname(__FILE__, 3) . "/class/services/ldapGroupService.class.php");

// getting users data in order to display it
$groups = ldapGroupService::getInstance()->getGroups();

$grouID;
?>

<hr/>

<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Dn</th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    <?php
    $counter = 0;

    foreach ($groups as &$group):

        $counter++;
        ?>
        <tr>
            <th scope="row"><?php echo $counter; ?></th>
            <td><?php echo $group->getName(); ?></td>
            <td><?php echo $group->getDn(); ?></td>
            <td>
                <button type="button" class="btn btn-info manageGroupBtn" data-dn="<?php echo $group->getDn(); ?>">Manage</button>

                <a href="<?php echo './parts/actions/group/removeGroupAction.php?dn=' . $group->getDn(); ?>">
                    <button type="button" class="btn btn-danger">Remove</button>
                </a>
            </td>
        </tr>
    <?php
    endforeach;
    ?>

    </tbody>
</table>


<!-- Modal which manages users of group -->
<div class="modal" id="modalManageGroup">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
