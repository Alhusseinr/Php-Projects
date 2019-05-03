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
    $user_check_query = "CALL CheckIfUserExists('$username', '$email')";
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
            $ip = GetUserIp();

            // Hashing the password
            $hashed_password = md5($password);

            // MySql query to insert into DB
            $query = "CALL CreateUser('$username', '$email', '$hashed_password', '$ip')";
            $result = mysqli_query($DB, $query);
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
        $find_user_query = "CALL CheckIfUserExists('$username', '$email')";
        $results = mysqli_query($DB, $find_user_query);
        $userInfo = mysqli_fetch_assoc($results);

        if(mysqli_num_rows($results) == 1){
            $userId = $userInfo['users_id'];

            if(empty($userInfo['ip_address']) || is_null($userInfo['ip_address']) || $userInfo['ip_address'] == 0 && empty($userInfo['port']) || is_null($userInfo['port']) || $userInfo['port'] == 0){
                $ip = GetUserIp();

                if($ip != $userInfo['ip_address']){
                    $insert_ip = "UPDATE users SET ip_address='$ip' WHERE users_id='$userId' AND username='$username'";
                    $result = mysqli_query($DB, $insert_ip);

                    $message = "New login into your account from: ".$ip;

                    mail('Ramialhussein98@gmail.com', 'Someone Logged into your account', $message);
                }
            }

            $_SESSION['role'] = $userInfo['role'];
            $_SESSION['username'] = $username;
            setcookie('userid', $userInfo['users_id'], time() + (60 * 60 * 24 * 30), "/");
            setcookie('username', $userInfo['username'], time() + (60 * 60 * 24 * 30), "/");
            setcookie('email', $userInfo['email'], time() + (60 * 60 * 24 * 30), "/");
            setcookie('password', $userInfo['password'], time() + (60 * 60 * 24 * 30), "/");

            header('location: ../index.php');
        }else{
            array_push($errors, "Wrong username/password combination");
        }
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

function GetUserPort(){
    return $port = $_SERVER['REMOTE_PORT'];
}


?>