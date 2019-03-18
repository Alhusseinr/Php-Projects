<?php include('server.php') ?>
<html>
    <head>
        <title>Registration system PHP and MySQL</title>
        <link rel="stylesheet" type="text/css" href="../public/css/style.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    </head>
    <body>
        <div class="container pnl" style="margin-top: 14em;">
            <h1>Login</h1>
            <form method="post" action="login.php">
                <div class="row">
                    <div class="col-md-12">
                        <label>Username</label>
                        <input class="form-control" type="text" name="username" autocomplete="off">
                    </div>
                    <div class="col-md-12">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" autocomplete="off">
                    </div>
                    <div class="col-md-6" style="margin-top: 1em;">
                            <?php include('errors.php') ?>
                    </div>
                    <div class="col-md-6 text-right" style="margin-top: 1em;">
                        <button type="submit" class="btn btn-outline-success" name="login_user">Login</button>

                        <p style="margin-top: 1em;"> Not yet a member? <a href="register.php">Sign up</a></p>
                    </div>
                </div>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>
