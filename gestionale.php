<?php

use Ilmioportale\Controller\UsersController;
use Ilmioportale\Controller\VehiclesController;
use Ilmioportale\PhpMailer\Mail;

spl_autoload_register(
    function ($className) {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        include __DIR__ . '/library/' . $className . '.php';
    }
);
session_start();


// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["username"] !== 'gianlucatuono') {
    header("location: login.php");
    exit;
}

include_once __DIR__ . '/html/header.html';
include_once __DIR__ . '/html/gestionale.html';
include_once __DIR__ . '/html/modalGestionale.html';

$config = include_once __DIR__ . '/Common/config.php';

/*################################################### FORM VEHICLES ##################################################*/

$vehiclesController = new VehiclesController($config);
$vehiclesController->fetchAllViewGestionale();
$vehiclesController->findViewVehicles();
$vehiclesController->insertVehicles();
$vehiclesController->deleteVehicles();
$vehiclesController->updateVehicles();

/*################################################### FORM ACCOUNT ###################################################*/

$usersController = new UsersController($config);
$usersController->findViewUsers();
$usersController->fetchAllView();
$usersController->insertUsers();
$usersController->updateUsers();
$usersController->deleteUsers();

/*################################################## FORM SEND MAIL ##################################################*/

$mail = new Mail();
$varVehicles = include_once __DIR__ . '/Common/variabili.php';

if (isset($_POST['mailApriliaPegaso'])) {
    $message = getMessage('aprilia', $vehiclesController->dataMsgVehicles('aprilia'));
    $mail->sendEmail($message);
}elseif (isset($_POST['mailSuzukiGsr'])){
    $message = getMessage('suzuki', $vehiclesController->dataMsgVehicles('suzuki'));
    $mail->sendEmail($message);
}elseif (isset($_POST['mailOpelAstra'])){
    $message = getMessage('astra', $vehiclesController->dataMsgVehicles('astra'));
    $mail->sendEmail($message);
}elseif (isset($_POST['mailOpelInsignia'])){
    $message = getMessage('insignia', $vehiclesController->dataMsgVehicles('insignia'));
    $mail->sendEmail($message);
}
include_once __DIR__ . '/html/footer.html';

