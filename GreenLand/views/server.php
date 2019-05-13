<?php

    isset($_SESSION['username']) ? '' : session_start();

    //    if(isset($_SESSION['username'])){} else if(!isset($_SESSION['username'])){
    //        session_start();
    //    }

    // my vars

    $Fname;
    $Lname;
    $username;
    $Pnumber;
    $gender;
    $email;
    $searchTerm;
    $role;
    $errors = array();

    // db connection
    $db = mysqli_connect('localhost', 'root', '', 'database_systems');

    // REGISTER USER
    if(isset($_POST['reg_user'])){
        // receive all input values from the form
        $Fname = mysqli_real_escape_string($db, $_POST['Fname']);
        $Lname = mysqli_real_escape_string($db, $_POST['Lname']);
        $gender = mysqli_real_escape_string($db, $_POST['Gender']);
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $role = mysqli_real_escape_string($db, $_POST['role']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


        // Validation
        if(empty($username)) {
            array_push($errors, "Username is required");
        }
        if(empty($email)) {
            array_push($errors, "Email is required");
        }
        if(empty($password_1)) {
            array_push($errors, "Password is required");
        }
        if($password_1 != $password_2){
            array_push($errors, "Passwords do not match");
        }

        // Checking the db if the user exists
        $user_check_array = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_array);
        $user = mysqli_fetch_assoc($result);

        // If a user or email exists
        if($user){
            if($user['username'] === $username){
                array_push($errors, "Username already exists");
            }

            if($user['email'] === $email){
                array_push($errors, "Email already exists");
            }
        }
        try{
            if(count($errors) == 0){
                $password = md5($password_1);

                $query = "INSERT INTO users(username, Password, email, role) VALUES('$username', '$password', '$email', '$role')";
                mysqli_query($db, $query);
                $_SESSION['username'] = $username;
                header('location: login.php');
            }
        }catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    // Login
    if(isset($_POST['login_user'])){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $secret_word = 'ramis project';

        if(empty($username)){
            array_push($errors, "Username is required");
        }

        if(empty($password)){
            array_push($errors, "Password is required");
        }

        if(count($errors) == 0){
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $results = mysqli_query($db, $query);
            $users = mysqli_fetch_assoc($results);

            if(mysqli_num_rows($results) == 1 && pc_validate($users['username'], $users['Password'])){
                setcookie('login', $users['username'].','.md5($users['username'].$secret_word), time() + (86400 * 30));

                // $_SESSION['username'] = $username;
                // $_SESSION['success'] = 'You are now logged in';

                header('location: index.php');
            }else{
                array_push($errors, "Wrong username/password combination");
            }
        }
    }



    // Search
    if(isset($_POST['searchSubmit'])){
        $searchTerm = $_GET['searchTerm']; // Gets the data from the client-side
        $searchTerm = htmlspecialchars($searchTerm); // Transforms everything from Html to actual text
        $searchTerm = mysqli_real_escape_string($db, $_POST['searchTerm']); // Helps against SQL injections

        $searchQuery = "SELECT * FROM Products WHERE(`name` LIKE `%".$searchTerm."%`) OR ('description' LIKE `%".$searchTerm."%`)";
        $searchResults = mysqli_query($db, $searchQuery);

        if(mysqli_num_rows($searchResults) > 0){
            while($results = mysqli_fetch_array($searchResults)){
                echo $results;
            }
        }
    }


    // Verify a user function
    function pc_validate($user,$pass){
        $users = array($user => $pass);
        if(isset($users[$user]) && ($users[$user] == $pass)){
            return true;
        }else{
            return false;
        }
    }

    function onLogin($user){
        $token = md5(uniqid(rand(), true));
    }