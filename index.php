<?php

use Ilmioportale\Controller\VehiclesController;

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

spl_autoload_register(
    function ($className) {
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        include __DIR__ . '/library/' . $className . '.php';
    }
);


if ($_SESSION["username"] !== 'gianlucatuono') {
    include_once __DIR__ . '/html/headerGuest.html';
}else{
    include_once __DIR__ . '/html/header.html';
}

$config = include_once __DIR__ . '/Common/config.php';
$vehiclesController = new VehiclesController($config);
?>
<div class="container-fluid" style="padding-top: 20px">
<table class="table table-striped" style="background: #fff;">
    <thead style="background: #e6e6ea">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">CLASSE</th>
        <th scope="col">TARGA</th>
        <th scope="col">MODELLO</th>
        <th scope="col">SCADENZA ASSICURAZIONE</th>
        <th scope="col">SCADENZA BOLLO</th>
        <th scope="col">SCADENZA REVISIONE</th>
        <th scope="col">KM ULTIMA REVISIONE</th>
    </tr>
    </thead>
    <tbody>
    <tr>
<?php $vehiclesController->findViewVehiclesIndex(1); ?>
<?php $vehiclesController->findViewVehiclesIndex(2); ?>
<?php $vehiclesController->findViewVehiclesIndex(3); ?>
<?php $vehiclesController->findViewVehiclesIndex(4); ?>
    </tr>
    </tbody>
</table>
</div>
<?php
include_once __DIR__ . '/html/footer.html';