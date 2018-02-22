<?php session_start(); ?>
<?php include_once 'class/util/viewUtil.class.php'; ?>

<div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" style="margin-bottom: 120px;">
    <div class="container">
        <a href="index.php" class="navbar-brand">LDAP - GUI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" style="">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <ul class="navbar-nav mr-auto">
                <?php if ($_SESSION["logged"]): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="?<?php echo viewUtil::$viewId . '=0'; ?>">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?<?php echo viewUtil::$viewId . '=1'; ?>">Groups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?<?php echo viewUtil::$viewId . '=2'; ?>">Import / Export</a>
                    </li>
                <?php endif ?>
            </ul>

            <ul class="nav navbar-nav ml-auto">
                <?php if ($_SESSION["logged"]): ?>
                    <a class="nav-link" href="#">User : Admin</a>
                    <form action="parts/actions/user/logoutAction.php" class="form-inline my-2 my-lg-0" method="post">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Logout</button>
                    </form>
                    <form action="parts/actions/global/clearAction.php" class="form-inline my-2 my-lg-0" method="post">
                        <button class="btn btn-danger my-2 my-sm-0" type="submit">Clear All</button>
                    </form>
                <?php else: ?>
                    <form action="parts/actions/user/loginAction.php" class="form-inline my-2 my-lg-0" method="post">
                        <input class="form-control mr-sm-2" type="text" name="login" placeholder="admin" disabled>
                        <input class="form-control mr-sm-2" type="password" name="password" placeholder="Password">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Login</button>
                    </form>
                <?php endif ?>
            </ul>

        </div>
    </div>
</div>

<?php include("messages.php") ?>
