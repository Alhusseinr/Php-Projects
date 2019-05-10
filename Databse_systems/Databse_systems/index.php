<?php
$page_title = 'Home';

?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>
        Rami's Shop | <?php echo $page_title ?>
    </title>

    <?php include('./UserControls/topScripts.php'); ?>
</head>
<body>
    <?php

    include('./UserControls/NavBar.php');

    checkLoggedIn();

    $query_getProducts = "CALL GetAllProducts";
    $products = mysqli_query($DB, $query_getProducts);

    ?>
    <section id="mainBody">
        <div class="mainBanner" style="margin-top: 3.5em;">
            <div class="row">
                <div class="col-md-6" style="text-align: center;">
                    <h1 style="margin-top: 2em; font-size: 3.5em;">Star Wars Collectable Shop</h1>
                    <h3 style="margin-top: .5em; font-size:2em;">Want to find rare items to add to your collection?</h3>
                    <h4 style="margin-top: .75em; font-size: 1.5em;">Over 100 rare collectables listed have a look around</h4>
                    <h4 style="margin-top: .75em; font-size: 1.5em;">Want to become a memeber? Sign up Today</h4>
                    <div class="row">
                        <div class="pnl">
                            <h2 style="margin-top:.25em;">Sign Up</h2>
                            <div class="boxes">
                                <div class="col-md-12" style="text-align: left !important; margin: .5em 0 .5em 0;">
                                    <label>Username: </label>
                                    <input class="form-control" />
                                </div>
                                <div class="col-md-12" style="text-align: left !important; margin: .5em 0 .5em 0;">
                                    <label>Email: </label>
                                    <input class="form-control" />
                                </div>
                                <div class="col-md-12" style="text-align: left !important; margin: .5em 0 .5em 0;">
                                    <label>Password: </label>
                                    <input class="form-control" />
                                </div>
                                <div class="col-md-12" style="text-align: left !important; margin: .5em 0 .5em 0;">
                                    <label>Confirm Password: </label>
                                    <input class="form-control" />
                                </div>
                                <div class="row">
                                    <div class="col-md-3" style="text-align: left !important; margin: .5em 0 .5em 0;">
                                        <button type="submit" name="reg_user" class="btn btn-outline-success">Register</button>
                                    </div>
                                    <div class="col-md-9 align-self-center" style="text-align: right !important; margin: .5em 0 .5em 0;">
                                        already have an account
                                        <a href="/login/Default.php">Sign In</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <?php

                    if($products):
                        if(mysqli_num_rows($products) > 0):
                            while($count < 8 && $product = mysqli_fetch_assoc($products)):
                    ?>
                    <div class="col-sm-4 col-md-3" style="text-align: center;">
                        <div class="inner">
                            <form class="formBox" method="post" action="index.php">
                                <input type="hidden" name="product_id_h" value="<?php echo $product['product_id'] ?>" />
                                <input type="hidden" name="product_name_h" value="<?php echo $product['name']; ?>" />
                                <input type="hidden" name="product_price_h" value="<?php echo $product['price']; ?>" />

                                <div class="col-md-12" style="padding: 0; ">
                                    <img src="<?php echo $product['img']; ?>" class="img-fluid img-responsive" />
                                </div>
                                <div class="row" style="margin-top: 1em;">
                                    <div class="col-md-6" style="padding: 0;">
                                        <label id="product_name" name="product_name">
                                            <?php echo $product['name']; ?>
                                        </label>
                                    </div>

                                    <div class="col-md-6">
                                        <label>
                                            <?php
                                if($product['quantity'] > 10){
                                    echo 'Left in stock: <strong>10+</strong>';
                                }elseif($product['quantity'] == 0){
                                    echo '';
                                }else{
                                    echo 'Left in stock: <strong>'. $product['quantity'] .'</strong>';
                                }
                                            ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label name="product_price" id="product_price">
                                        Price: <?php echo $product['price']; ?>
                                    </label>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                if($product['quantity'] == 0){
                                    echo '<a class="btn btn-outline-success disabled" style="color: #28a745;">Add to cart</a>';
                                }else{
                                    echo '<button type="submit" name="add_to_cart" class="btn btn-outline-success">Add to cart</button>';
                                }
                                            ?>

                                        </div>
                                        <div class="col-md-6">

                                            <?php if($product['quantity'] == 0): ?>
                                            <strong style="color: red;">Out of Stock</strong>
                                            <?php else: ?>

                                            <select class="form-control" name="quantity" id="quantity">
                                                <?php
                                                      for($i = 1; $i <= $product['quantity']; $i++){
                                                          echo '<option>'.$i.'</option>';
                                                      }
                                                ?>
                                            </select>

                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                                $count++;
                            endwhile;
                        endif;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php include('./UserControls/bottomScripts.php'); ?>
    <?php include('./UserControls/Footer.php'); ?>
</body>
</html>