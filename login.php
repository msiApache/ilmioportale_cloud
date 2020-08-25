<?php

use Ilmioportale\Controller\UsersController;

// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}
spl_autoload_register(
    function ($className) {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        include __DIR__ . '/library/' . $className . '.php';
    }
);
$config = include_once __DIR__ . '/Common/config.php';
$username = $password = "";
$username_err = $password_err = "";

$operationManager = new UsersController($config);
$operationManager->login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/css/login.css" type="text/css">
    <link rel="shortcut icon" href="/assets/home.ico"/>
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-login">
        <ul class="login-nav">
            <li class="login-nav__item active">
                <a href="#">IL MIO PORTALE</a>
            </li>
        </ul>
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label for="login-input-user" class="login__label">
                Username
            </label>
            <input id="login-input-user" class="login__input" type="text" name="username"
                   value="<?php echo $username; ?>"/>
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label for="login-input-password" class="login__label">
                Password
            </label>
            <input id="login-input-password" class="login__input" type="password" name="password"/>
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <label for="login-sign-up" class="login__label--checkbox">
        </label>
        <div class="form-group">
            <input type="submit" class="login__submit" value="ACCEDI">
        </div>
    </form>
</div>
</body>
</html>
