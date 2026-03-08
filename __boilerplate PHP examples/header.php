<?php

    if (!isset(session_status() === PHP_SESSION_NONE)){
        session_start();
    }

    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

?>

    <!-- every php file sets the title -->
    <title><?=$title?></title>

    <!-- also sets which css files they need via directories, so no overhead is used to load unused css files -->
    <?php foreach ($cssDir as $i): ?>
        <link rel="stylesheet" href="<?=$i?>">
    <?php endforeach; ?>