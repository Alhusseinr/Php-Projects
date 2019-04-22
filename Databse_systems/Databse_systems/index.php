<?php
session_start();

$page_title = 'Home';

if(!isset($_SESSION['username'])){
    $_SESSION['msg'] = "You must be logged in to use this site";
    header('location: /login/Default.php');
}else{
    setcookie('login', $_SESSION['username'].','.md5($_SESSION['username'].$secret_word), time() + (86400 * 30));
}

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    header('location: /login/Default.php');
}

$db = mysqli_connect('localhost', 'root', '', 'database_systems');
$query = "SELECT * FROM products ORDER BY product_id ASC";
$result = mysqli_query($db, $query);


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
    <?php include('./UserControls/NavBar.php'); ?>
    <section id="mainBody">
        <!--<iframe src="https://vlipsy.com/embed/J1JL9As0?loop=1&sharing=0" style="height:100%; width:100%;" frameborder="0"></iframe>-->
        <!--<video autoplay muted loop id="">
            <source src="https://www.youtube.com/watch?v=NmS9ZX9O5bw" />
        </video>-->
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
                                        <button type="submit" class="btn btn-outline-success">Register</button>
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
                    if($result):
                        if(mysqli_num_rows($result) > 0):
                            while($product = mysqli_fetch_assoc($result)):
                    ?>
                    <div class="col-sm-4 col-md-3" style="text-align: center;">
                        <form method="post" action="index.php?action=add&id=id=<?php $product['product_id']; ?>">
                            <div class="col-md-12">
                                <img src="<?php echo $product['img']; ?>" class="img-fluid" />
                            </div>
                            <div class="col-md-12">
                                <label>
                                    <?php echo $product['name']; ?>
                                </label>
                            </div>
                            <div class="col-md-12">
                                <label>
                                    Left in stock:  <?php
                                if($product['quantity'] > 10){
                                    echo '<strong>10+</strong>';
                                }else{
                                    echo '<strong>'.$product['quantity'].'</strong>';
                                }

                                                    ?>
                                </label>
                            </div>
                            <div class="col-md-12">
                                <label>
                                    <?php echo $product['price']; ?>
                                </label>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outline-success">Add to cart</button>
                            </div>
                        </form>
                    </div>
                    <?php
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

    <script></script>
</body>
</html>