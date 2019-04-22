<?php 
include('../server/Default.php');

$page_title = "Login";

?>
<html>
<head>
    <title>Ramis Shop | <?php echo $page_title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php include('../UserControls/topScripts.php') ?>
</head>
<body>
    <div class="container pnl" style="margin-top: 14em;">
        <h1>Login</h1>
        <form method="post" action="Default.php">
            <div class="row">
                <div class="col-md-12">
                    <label>Username</label>
                    <input class="form-control" type="text" name="username" autocomplete="off" />
                </div>
                <div class="col-md-12">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password" autocomplete="off" />
                </div>
                <div class="col-md-6" style="margin-top: 1em;">
                    <?php include('../errors.php') ?>
                </div>
                <div class="col-md-6 text-right" style="margin-top: 1em;">
                    <button type="submit" class="btn btn-outline-success" name="login_user">Login</button>

                    <p style="margin-top: 1em;">
                        Not yet a member?
                        <a href="../register/Default.php">Sign up</a>
                    </p>
                </div>
            </div>
        </form>
    </div>

    <?php include('../UserControls/bottomScripts.php') ?>
</body>
</html>
