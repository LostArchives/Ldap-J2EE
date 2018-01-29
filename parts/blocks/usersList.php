
<?php

include "ldapUser.class.php";

// getting users data in order to display it
$users = $ldapService->getUsers();

?>

<hr/>

<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">uid</th>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
    </tr>
    </thead>
    <tbody>

    <?php

        foreach ($users as &$user) {
            echo htmlspecialchars('<th scope="row">'.$user->getUid().'</th>');
            echo htmlspecialchars('<td>'.$user->getFirstname().'</td>');
            echo htmlspecialchars('<td>'.$user->getLastname().'</td>');
        }
    ?>

    </tbody>
</table>