<?php
$page_title = 'Recipts';
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>
        Rami's Shop | <?php echo $page_title ?>
    </title>

    <?php include('../UserControls/topScripts.php'); ?>
</head>
<body>
    <?php

    include('../UserControls/NavBar.php');
    global $DB;

    $username = $_SESSION['username'];

    $History = "SELECT * FROM orders_detail d INNER JOIN users s on s.users_id = d.users_id INNER JOIN address a on s.users_id = a.users_id INNER JOIN orders o on o.users_id = s.users_id INNER JOIN products p on d.product_name = p.name";
    $run = mysqli_query($DB, $History);

    ?>

    <div class="row" style="margin-top: 3.5em;">
        <div class="col-md-12">
            <h3>
                Thank you for your order
                <strong>
                    <?php echo $username; ?>
                </strong>
            </h3>
        </div>
    </div>


    <?php
    if($run):
        if(mysqli_num_rows($run) > 0):
            while($data = mysqli_fetch_assoc($run)):
    ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $data['product_name'] ?>
                    </div>
                </div>
               
    <?php
            endwhile;
        endif;
    endif;
    ?>





    <?php include('./UserControls/bottomScripts.php'); ?>
    <?php include('./UserControls/Footer.php'); ?>
</body>
</html>