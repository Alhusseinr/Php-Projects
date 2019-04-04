<?php include('server.php') ?>
<html>
    <head>
        <title>Registration system PHP and MySQL</title>
        <link rel="stylesheet" type="text/css" href="../public/css/style.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
    </head>
    <body>
        <div class="container pnl">
            <h1>Register</h1>
            <form method="post" action="register.php">
                <div class="row">
                    <div class="col-md-6" style="margin-top: 1em;">
                        <label>First Name: </label>
                        <input class="form-control" type="text" name="Fname" autocomplete="off">
                    </div>
                    <div class="col-md-6" style="margin-top: 1em;">
                        <label>Last Name: </label>
                        <input class="form-control" type="text" name="Lname" autocomplete="off">
                    </div>
                    <div class="col-md-6" style="margin-top: 1em;">
                        <label>Username: </label>
                        <input class="form-control" type="text" name="username" autocomplete="off">
                    </div>
                    <div class="col-md-6" style="margin-top: 1em;">
                        <label>Password: </label>
                        <input class="form-control" type="password" name="password_1" autocomplete="off">
                    </div>
                    <div class="col-md-6" style="margin-top: 1em;">
                        <label>Confirm Password: </label>
                        <input class="form-control" type="password" name="password_2" autocomplete="off">
                    </div>
                    <div class="col-md-6" style="margin-top: 1em;">
                        <label>Email: </label>
                        <input class="form-control" type="email" name="email" autocomplete="off">
                    </div>
                    <div class="col-md-6" style="margin-top: 1em;">
                        <label>Gender:</label>
                        <select name="Gender" class="form-control">
                            <option>Select...</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6" style="margin-top: 1em;">
                        <label>Role:</label>
                        <select name="role" class="form-control">
                            <option>Select...</option>
                            <option value="Customer">Customer</option>
                            <option value="Employee">Employee</option>
                            <option value="Supervisor">Supervisor</option>
                        </select>
                    </div>
                    <div class="col-md-6" style="margin-top: 1em;">
                        <?php include('errors.php') ?>
                    </div>
                    <div class="col-md-6 text-right" style="margin-top: 1em;">
                        <button type="submit" class="btn btn-outline-primary" name="reg_user">Register</button>

                        <p style="margin-top: 1em;"> Already a memeber?  <a href="login.php">Login</a></p>
                    </div>
                </div>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>
