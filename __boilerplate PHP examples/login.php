<?php

    include "includes/db_connect.php";
    include "assets/components/header.php";

    if (!isset($_POST["csrf_token"]) || !hash_equals($_SESSION["csrf_token"], $_POST["csrf_token"])) {
        die("Invalid CSRF token");
    }
    unset($_SESSION["csrf_token"]);

    // gets data from form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST"){

        // makes individual variables from post data
        $email = $_POST["email"];
        $password = $_POST["password"];

        // checks if the email is valid (needs @ and .com etc)
        $stmt = $pdo->prepare("SELECT userID, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user["password"])) {
            session_regenerate_id(true);
            // logs the user in and redirects them to the dashboard
            $_SESSION["userID"] = $user["userID"];
            $_SESSION["loggedIn"] = true;
            header("location: dashboard.php");
            exit;
        }
        else {
            // handle errors, program specific
            // vague error messages
        }      

    }

    // ...php

?>