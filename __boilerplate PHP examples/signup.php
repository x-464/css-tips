<?php

    include "includes/db_connect.php";
    include "assets/components/header.php";

    // gets data from form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST"){

        // makes individual variables from post data
        $name     = trim($_POST["name"]);
        $email    = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $pConfirm = trim($_POST["passwordConfirm"]);

        // should check for empty post data here too

        // hashes the password, better for security
        if ($password === $pConfirm && filter_var($email, FILTER_VALIDATE_EMAIL)){
            // checks csrf token, uses hash_equals not === to stop timing attacks
            if (!isset($_POST["csrf_token"]) || !hash_equals($_SESSION["csrf_token"], $_POST["csrf_token"])) {
                die("Invalid CSRF token");
            }
            unset($_SESSION["csrf_token"]);


            $pHashed = password_hash($password, PASSWORD_DEFAULT);

            try{
                // tries to add a user to the users table
                $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                $stmt ->execute([$name, $email, $pHashed]);

                // log the user in if it worked
                $_SESSION["userID"] = $pdo->lastInsertId();
                header("Location: dashboard.php"); 
                exit();
            }
            catch (PDOException $e){
                if ($e->errorInfo[1] == 1062){
                    // email duplicate error
                }
                // safely handle errors
            }
        }
        else{
            // handle errors, program specific
        }
    }
    
    // ...php

?>