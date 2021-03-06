<?php

isset($_SESSION['username']) ? '' : session_start();

$username;
$email;
$password;
$role;
$errors = array();

// My DB connection
$DB = mysqli_connect('localhost', 'root', '', 'database_systems');


// Register
if(isset($_POST['reg_user'])){
    global $DB;
    global $errors;

    $username = mysqli_real_escape_string($DB, $_POST['username']);
    $email = mysqli_real_escape_string($DB, $_POST['email']);
    $password = mysqli_real_escape_string($DB, $_POST['password_1']);

    empty($username) ? array_push($errors, 'Username is required') : '';

    empty($email) ? array_push($errors, 'Email is required') : '';

    empty($password) ? array_push($errors, 'Password is required') : '';

    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($DB, $user_check_query);

    // If a user or email exists
    if(mysqli_num_rows($result)){
        $data = mysqli_fetch_assoc($result);
        $data['username'] === $username ? array_push($errors, "Username taken") : '';
        $data['email'] === $email ? array_push($errors, "Email taken") : '';
    }

    if(count($errors) == 0){
        $ip = GetUserIp();
        $hashed_password = md5($password);
        $addIntoDB = "INSERT INTO users (username, email, Password, ip_add) VALUES('$username', '$email', '$hashed_password', '$ip')";
        $run = mysqli_query($DB, $addIntoDB);

        if($run = true){
            $_SESSION['username'] = $username;
            $_SESSION['users_id'] = $userData['users_id'];
            $_SESSION['role'] = $userData['role'];

            header("location: ../index.php");
        }
    }
}


//Login
if(isset($_POST['login_user'])){
    $username = mysqli_real_escape_string($DB, $_POST['username']);
    $password = mysqli_real_escape_string($DB, $_POST['password']);

    empty($username) ?  array_push($errors, "Username is required") : '';
    empty($password) ? array_push($errors, "Password is required") : '';

    if(count($errors) == 0){
        $password = md5($password);
        $find_user_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1;";
        $results = mysqli_query($DB, $find_user_query);
        $userInfo = mysqli_fetch_assoc($results);

        if(mysqli_num_rows($results) == 1){
            $userId = $userInfo['users_id'];

            if(empty($userInfo['ip_address']) || is_null($userInfo['ip_address']) || $userInfo['ip_address'] == 0 && empty($userInfo['port']) || is_null($userInfo['port']) || $userInfo['port'] == 0){
                $ip = GetUserIp();

                if($ip != $userInfo['ip_address']){
                    $insert_ip = "UPDATE users SET ip_address='$ip' WHERE users_id='$userId' AND username='$username'";
                    $result = mysqli_query($DB, $insert_ip);
                }
            }

            $_SESSION['role'] = $userInfo['role'];
            $_SESSION['username'] = $username;
            $_SESSION['users_id'] = $userInfo['users_id'];
            $_SESSION['email'] = $userInfo['email'];

            header('location: ../index.php');
        }else{
            array_push($errors, "Wrong username/password combination");
        }
    }
}

//logout
if(isset($_GET['logout'])){
    session_destroy();

    unset($_SESSION['username']);
    unset($_SESSION['role']);
    unset($_SESSION['users_id']);
    unset($_SESSION['email']);
    unset($_SESSION['msg']);

    header('location: ../login/Default.php');
}


// adding product into cart
if(isset($_POST['add_to_cart'])){
    $productId = mysqli_real_escape_string($DB, $_POST['product_id_h']);
    $product_name = mysqli_real_escape_string($DB, $_POST['product_name_h']);
    $product_price = mysqli_real_escape_string($DB, $_POST['product_price_h']);
    $product_quantity = mysqli_real_escape_string($DB, $_POST['quantity']);
    $loggedInUsername = $_SESSION['username'];
    $loggedInUserId = $_SESSION['users_id'];

    $cart_price = getCartPrice($product_quantity, $product_price);

    $checkIfInCart = "SELECT product_id FROM cart_product WHERE userId='$loggedInUserId' AND product_id='$productId'";
    $checkCart = mysqli_query($DB, $checkIfInCart);

    if(mysqli_num_rows($checkCart) > 0){
        //update cart qty
        $price = getCartPrice($product_quantity, $product_price);
        $updateCart = "UPDATE cart_product SET cart_qty = cart_qty + '$product_quantity', cart_price = cart_price + '$price' WHERE userId='$loggedInUserId' AND product_id='$productId'";
        $run = mysqli_query($DB, $updateCart);
        header('location: ./cart/Default.php');
    }else{
        $addingIntoProduct = "INSERT INTO cart_product(product_id, cart_qty, cart_price, productName, userId)
                            VALUES('$productId', '$product_quantity', '$cart_price', '$product_name', '$loggedInUserId')";
        $run1 = mysqli_query($DB, $addingIntoProduct);

        if($run1 = true){
            $addingIntoCart = "INSERT INTO cart(users_id, cart_product_id) VALUES('$loggedInUserId', (SELECT cart_product_id FROM cart_product where userId='$loggedInUserId'))";
            $run2 = mysqli_query($DB, $addingIntoCart);
            header('location: ./cart/Default.php');
        }
    }
}

if($_POST['ProductQty'] && $_POST['ProductId']){
    $newProductQty = $_POST['ProductQty'];
    $proId = $_POST['ProductId'];
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $getProductPrice = "SELECT price FROM products where product_id ='$proId'";
    $run = mysqli_query($DB, $getProductPrice);
    $data = mysqli_fetch_assoc($run);
    $productPrice = $data['price'];

    $newPrice = getCartPrice($newProductQty, $productPrice);
    $userData = getUserInfo($username, $email);
    $userId = $userData['users_id'];
    updateCart($newProductQty, $proId, $userId);
}

if(isset($_POST['checkout'])){

    $userId = $_SESSION['users_id'];
    $orderTotal = mysqli_real_escape_string($DB, $_POST['total']);

    $address1 = mysqli_real_escape_string($DB, $_POST['address1']);
    $address2 = mysqli_real_escape_string($DB, $_POST['address2']);
    $post_code = mysqli_real_escape_string($DB, $_POST['post_code']);
    $city = mysqli_real_escape_string($DB, $_POST['city']);
    $state = mysqli_real_escape_string($DB, $_POST['state']);

    $selectFromADD = "SELECT users_id FROM address WHERE users_id='$userId'";
    $r = mysqli_query($DB, $selectFromADD);

    if(mysqli_num_rows($r) > 0){

    }else{
        $insertIntoAddress = "INSERT INTO address(address1, address2, post_code, city, state, users_id) VALUES('$address1', '$address2', '$post_code', '$city', '$state', '$userId')";
        $s = mysqli_query($DB, $insertIntoAddress);

        $updateUsers = "UPDATE users SET address_id=(SELECT address_id FROM address WHERE users_id='$userId')";
        $h = mysqli_query($DB, $updateUsers);
    }

    $insertIntoCart = "INSERT INTO orders(address_id, users_id, totalPrice) VALUES((SELECT address_id FROM address WHERE users_id='$userId'), '$userId', '$orderTotal')";
    $addCart = mysqli_query($DB, $insertIntoCart);

    $setCart = "SELECT * FROM cart INNER JOIN cart_product INNER JOIN products ON cart.users_id = cart_product.userId AND cart_product.product_id = products.product_id WHERE users_id='$userId'";
    $run = mysqli_query($DB, $setCart);

    while($products = mysqli_fetch_assoc($run)){
        $productName = mysqli_real_escape_string($DB, $products['productName']);
        $productQty = mysqli_real_escape_string($DB, $products['cart_qty']);
        $productPrice = mysqli_real_escape_string($DB, $products['price']);
        $productId = mysqli_real_escape_string($DB, $products['prodcut_id']);

        $addintoorderdetails = "INSERT INTO orders_detail(order_id, users_id, product_name, product_quantity, product_price) VALUES((SELECT order_id FROM orders WHERE users_id='$userId'), '$userId', '$productName', '$productQty', '$productPrice')";
        $add = mysqli_query($DB, $addintoorderdetails);

        $removeFromProducts = "UPDATE products SET quantity = quantity - '$productQty' WHERE product_id='$productId'";
        $minus = mysqli_query($DB, $addintoorderdetails);
    }

    if($add = true){
        $updateOrders = "UPDATE orders SET order_detail_id=(SELECT orders_detail_id FROM orders_detail WHERE users_id='$userId')";
        $update = mysqli_query($DB, $updateOrders);

        if($update = true){
            $removeFromCart = "DELETE FROM cart WHERE users_id='$userId'";
            $f = mysqli_query($DB, $removeFromCart);

            $removeFromCartPro = "DELETE FROM cart_product WHERE userId='$userId'";
            $g = mysqli_query($DB, $removeFromCartPro);

            header('location: ../recipts/Default.php');
        }
    }
}

if(isset($_POST['remove'])){
    $productId = mysqli_real_escape_string($DB, $_POST['proId']);

    $delete = "DELETE FROM cart_product WHERE product_id='$productId'";
}

// Functions

function updateCart($newProductQty, $proId, $userId){
    global $DB;
    global $productPrice;

    if($newProductQty > 0){
        $proPrice = getCartPrice($newProductQty, $productPrice);
        $updateCart = "UPDATE cart_product SET cart_qty = cart_qty - '$newProductQty', cart_price = cart_price - '$proPrice' WHERE userId = '$userId' AND product_id = '$proId'";
        $run = mysqli_query($DB, $updateCart);
    }

}

function getCartPrice($product_quantity, $product_price){

    $productTotal =  $product_quantity * $product_price;

    return $productTotal;
}

function checkLoggedIn(){
    if(!isset($_SESSION['username']) && !isset($_SESSION['users_id'])){
        $_SESSION['msg'] = "You must be logged in to use this site";
        header('location: ./login/Default.php');
    }
}

function GetUserIp(){

    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        // IP from shared internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //IP pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

function addProduct($product_name, $product_price, $product_quantity){
    $adding_into_product = "INSERT INTO cart_product(product_id, quantity, price)";
}

function getUserInfo($username, $email){
    global $DB;

    $query = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";
    $run = mysqli_query($DB, $query);
    $data = mysqli_fetch_assoc($run);

    return $data;
}

function getItemsTotal(){
    global $DB;

    $userInfo = getUserInfo($_SESSION['username'], $_SESSION['email']);
    $userId = $userInfo['users_id'];
    $getItemsQty = "SELECT * FROM cart_product WHERE userId = '$userId'";
    $getItems = mysqli_query($DB, $getItemsQty);

    $total = 0;

    while($data = mysqli_fetch_assoc($getItems)){
        $total += $data['cart_qty'];
    }

    return $total;

}

function getTotalPrice(){
    global $DB;

    $userInfo = getUserInfo($_SESSION['username'], $_SESSION['email']);
    $userId = $userInfo['users_id'];
    $getItemsQty = "SELECT * FROM cart_product WHERE userId = '$userId'";
    $getItems = mysqli_query($DB, $getItemsQty);

    $total = 0;

    while($data = mysqli_fetch_assoc($getItems)){
        $total += $data['cart_price'];
    }

    return $total;
}


?>