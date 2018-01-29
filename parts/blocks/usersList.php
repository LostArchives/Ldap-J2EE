
<?php

include "ldapUser.class.php";

// getting users data in order to display it
$users = $ldapService->getUsers();

?>

<hr/>

<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Surname</th>
        <th scope="col">Name</th>
    </tr>
    </thead>
    <tbody>

    <?php

        $counter = 0;
        foreach ($users as &$user) {
            echo htmlspecialchars('<th scope="row">'.++$counter.'</th>');
            echo htmlspecialchars('<td>'.$user->getName().'</td>');
            echo htmlspecialchars('<td>'.$user->getSurname().'</td>');
        }
    ?>

    </tbody>
</table>