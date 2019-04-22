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
$query = "SELECT * FROM products ORDER BY product_id ASC"

//$username = $_SESSION['username'];
//$query = "SELECT * FROM users where username='$username'";
//$results = mysqli_query($db, $query);
//$data = mysqli_fetch_assoc($results);

$result = mysqli_query($db, $query)

?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>
        Rami's Shop | <?php echo $page_title ?>
    </title>

    <?php include('./UserControls/topScripts.php') ?>
</head>
<body>
    <?php include('./UserControls/NavBar.php') ?>
    <section class="container">
        <section id="mainBody">
            <div class="row">
                <div class="col-md-12" style="border:1px solid lightgray;">
                    <div class="row">
                        <?php
                        if($result):
                            if(mysqli_num_rows($result) > 0):
                                while($product = mysqli_fetch_assoc($result)):
                        ?>
                        <div class="col-sm-4 col-md-3">
                            <form method="post" action="index.php?action=add&id=id=<?php $product['product_id']; ?>">
                                <img src="<?php echo $product['img']; ?>" />
                                <label>
                                    <?php echo $product['name']; ?>
                                </label>
                                <label>
                                    Left in stock:  <?php
                                                        if($product['quantity'] > 10){
                                                           echo '<strong>10+</strong>';
                                                        }else{
                                                            echo $product['quantity'];
                                                        }

                                    ?>
                                </label>
                                <label>
                                    <?php echo $product['price']; ?>
                                </label>
                            </form>
                        </div>
                        <?php
                                endwhile:
                            endif:
                        endif:
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <?php include('./UserControls/bottomScripts.php') ?>
    <?php include('./UserControls/Footer.php') ?>
</body>
</html>