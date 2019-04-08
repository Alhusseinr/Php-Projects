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

        <?php include('topScripts.php') ?>
    </head>
    <body>
        <section class="container">
            <?php include('nav.php') ?>
            <section id="mainBody">
                <div class="row">
                    <div class="col-md-3" id="filter">
                        <div class="inner" style="border-right: 1px solid lightgray;">
                            <ul>
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Milk</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Yogurt</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Cheese</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <?php include('results.php')?>
                    </div>
                </div>
            </section>
        </section>
    <?php include('bottomScripts.php') ?>
    </body>
</html>



