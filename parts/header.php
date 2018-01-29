<?php include_once 'class/util/viewUtil.php'; ?>

<div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" style="margin-bottom: 120px;">
    <div class="container">
        <a href="../" class="navbar-brand">LDAP - GUI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" style="">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo "index.php"; ?>">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?<?php echo viewUtil::$viewId.'=0'; ?>">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?<?php echo viewUtil::$viewId.'=1'; ?>">Groups</a>
                </li>
            </ul>

            <ul class="nav navbar-nav ml-auto">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Username">
                    <input class="form-control mr-sm-2" type="password" placeholder="Password">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Login</button>
                </form>
            </ul>

        </div>
    </div>
</div>