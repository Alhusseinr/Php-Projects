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

    if(mysqli_connect_errno()){
        printf("Connecting to the database failed: %s\n", mysqli_connect_error());
        exit();
    }

    // Fetching the values of each variable
    $username = mysqli_real_escape_string($DB, $_POST['username']);
    $password = mysqli_real_escape_string($DB, $_POST['password_1']);
    $email = mysqli_real_escape_string($DB, $_POST['email']);

    // Validations
    if(empty($username)){
        array_push($errors, 'Username is required');
    }

    if(empty($password)){
        array_push($errors, 'Password is required');
    }

    if(empty($email)){
        array_push($errors, 'Password is required');
    }

    // MySql Query checking the DB if the user exists
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($DB, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    // If a user or email exists
    if($user){
        if($user['username'] === $username){
            array_push($errors, "Username taken");
        }

        if($user['email'] === $email){
            array_push($errors, "Email in use");
        }
    }

    try{
        if(count($errors) == 0){
            // Hashing the password
            $hashed_password = md5($password);
            // MySql query to insert into DB
            $query = "CALL CreateUser('$username','$email','$hashed_password')";
            mysqli_query($DB, $query);
            header("location: /login/Default.php");
        }
    }
    catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

}

//Login
if(isset($_POST['login_user'])){
    $username = mysqli_real_escape_string($DB, $_POST['username']);
    $password = mysqli_real_escape_string($DB, $_POST['password']);

    if(empty($username)){
        array_push($errors, "Username is required");
    }

    if(empty($password)){
        array_push($errors, "Password is required");
    }

    if(count($errors) == 0){
        $password = md5($password);
        $find_user_query = "CALL LogInUser('$username', '$password')";
        $results = mysqli_query($DB, $find_user_query);
        $user = mysqli_fetch_assoc($results);

        if(mysqli_num_rows($results) > 1){
            $_SESSION['username'] = $username;
            $_SESSION['success'] = 'You are now logged in';


            header('location: ../index.php');
        }else{
            array_push($errors, "Wrong username/password combination");
        }
    }
}


?>