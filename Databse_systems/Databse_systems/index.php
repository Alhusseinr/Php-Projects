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

    $query_getProducts = "SELECT * FROM products";
    $products = mysqli_query($DB, $query_getProducts);

    ?>
    <section id="mainBody">
        <div class="mainBanner" style="margin-top: 3.5em;">
            <div class="row">
                <div class="col-md-6" style="text-align: center;">
                    <h1 style="margin-top: 2em; font-size: 3.5em; color: white;">Star Wars Collectable Shop</h1>
                    <h3 style="margin-top: .5em; font-size:2em; color: white;">Want to find rare items to add to your collection?</h3>
                    <h4 style="margin-top: .75em; font-size: 1.5em; color: white;">Over 100 rare collectables listed have a look around</h4>
                    <h4 style="margin-top: .75em; font-size: 1.5em; color: white;">Want to become a memeber? Sign up Today</h4>
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
        <div class="row" style="margin-top: .5em;">
        <div class="col-md-12">
            <h1 style="text-align: center;">Collectables</h1>
        </div>
        
        <br/>

            <?php

            if($products):
                if(mysqli_num_rows($products) > 0):
                    while($count < 8 && $product = mysqli_fetch_assoc($products)):
            ?>
            <div class="col-sm-4 col-md-3" style="text-align: center; margin-top: 2em; ">
                <form method="post" action="index.php">
                    <input type="hidden" name="product_id_h" value="<?php echo $product['product_id'] ?>" />
                    <input type="hidden" name="product_name_h" value="<?php echo $product['name']; ?>" />
                    <input type="hidden" name="product_price_h" value="<?php echo $product['price']; ?>" />
                    <div class="card" style="width: 30em; margin: 0 auto; box-shadow: 0 15px 40px rgba(64,67,69,.17);">
                        <h5 class="card-title" style="margin-top: 1em; padding-right: .5em; padding-left: .5em;">
                            <?php echo $product['name']; ?>
                        </h5>
                        <img class="card-img-top" style="margin-top: .5em; border-radius: 0 !important;" src="/images/<?php echo $product['img']; ?>" alt="Card image cap" />
                        <div class="card-body">


                            <div class="row">
                                <div class="col-md-6" style="margin-bottom: 1em;">
                                    <label>
                                        <?php
                        if($product['quantity'] > 10){
                            echo 'Left in stock: <br/><strong>10+</strong>';
                        }elseif($product['quantity'] == 0){
                            echo '';
                        }else{
                            echo 'Left in stock: <br/><strong>'. $product['quantity'] .'</strong>';
                        }
                                        ?>
                                    </label>
                                </div>
                                <div class="col-md-6" style="margin-bottom: 1em;">
                                    Price:
                                    <br />
                                    <strong>
                                        $<?php echo $product['price']; ?>
                                    </strong>
                                </div>
                                <div class="col-md-6" style="margin-bottom: 1em;">
                                    <?php if($product['quantity'] == 0): ?>
                                    <strong style="color: red;">Out of Stock</strong>
                                    <?php else: ?>

                                    <select class="form-control" name="quantity" id="quantity" style="width: 4em; margin: 0 auto;">
                                        <?php
                                              for($i = 1; $i <= $product['quantity']; $i++){
                                                  echo '<option>'.$i.'</option>';
                                              }
                                        ?>
                                    </select>

                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6" style="margin-bottom: 1em;">
                                    <?php
                        if($product['quantity'] == 0){
                            echo '<a class="btn btn-outline-success disabled" style="color: #28a745;">Add to cart</a>';
                        }else{
                            echo '<button type="submit" name="add_to_cart" class="btn btn-outline-success">Add to cart</button>';
                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php
                        $count++;
                    endwhile;
                endif;
            endif;
            ?>
        </div>
    </section>
    <?php include('./UserControls/bottomScripts.php'); ?>
    <?php include('./UserControls/Footer.php'); ?>
</body>
</html>