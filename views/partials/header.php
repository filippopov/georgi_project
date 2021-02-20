<?php
/** @var \Georgi\Core\ViewInterface $this */ ;
$uriJunk = isset($uriJunk) ? $uriJunk : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Georgi</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    
    <link rel="stylesheet" type="text/css" href="<?= $uriJunk?>css/styles.css">
    <link rel="stylesheet" type="text/css" href="<?= $uriJunk?>css/forms.css">
    
</head>
<body>
    <header>
        <p class="site-title">
            <a href="<?php echo $this->uri('users', 'profile') ?>">Georgi Project</a>
        </p>
        <nav>
            <ul>
                <?php if ($this->authenticationService->isAuthenticated()): ?>
                    <li><a href="<?php echo $this->uri('users', 'profile') ?>">Home</a></li>
                    <li><a href="<?php echo $this->uri('users', 'logout') ?>">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?php echo $this->uri('users', 'login') ?>">Login</a></li>
                    <li><a href="<?php echo $this->uri('users', 'registration') ?>">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>