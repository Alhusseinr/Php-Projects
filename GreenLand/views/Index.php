<?php
    session_start();

    if(!isset($_SESSION['username'])){
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['username']);
        header("location: login.php");
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Greenland Diary</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="../public/css/style.css" type="text/css" />
    </head>
    <body>
    <?php include ('nav.html')?>
        <div class="header">
            <h2>Home Page</h2>
        </div>
        <div class="content">
            <?php if(isset($_SESSION['success'])) : ?>
                <div class="error success">
                    <h3>
                        <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </h3>
                </div>
            <?php endif; ?>

            <!-- Info -->
            <?php if(isset($_SESSION['username'])) : ?>
                <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
                <p> <a href="login.php?logout='1'" style="color: red;">logout</a> </p>
            <?php endif ?>
        </div>
        <!--<section class="mainBanner img gradient">
            <div class="container">
                <div class="row centered text-center">
                    <div class="txtWhite">
                        <h1>
                            Place an order today
                        </h1>
                        <h3>
                            Deliver anywhere you want whenever you want
                        </h3>

                        <a href="#" class="btn btn-warning">Get Started</a>
                    </div>
                </div>
            </div>
        </section>-->

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>



