<?php
// Iniciar sesión
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cargar archivos necesarios
require_once 'controller/AccommodationController.php';
require_once 'controller/UserController.php'; // Asegúrate de cargar el controlador de usuario

// Páginas permitidas
$validPages = ['landing', 'accommodations', 'dashboard', 'addAccommodation', 'removeAccommodation', 'createAccommodation', 'editAccommodation', 'login', 'logout', 'register'];
$page = isset($_GET['page']) && in_array($_GET['page'], $validPages) ? $_GET['page'] : 'landing';

// Controlador y vista según la página
switch ($page) {
    case 'landing':
        include 'views/landingPage.php';
        break;

    case 'createAccommodation':
        $controller = new AccommodationController();
        $controller->createAccommodation();
        include 'views/createAccommodation.php';
        break;

    case 'editAccommodation':  
        include 'views/editAccommodation.php';
        break;

    case 'accommodations':
        $controller = new AccommodationController();
        $accommodations = $controller->getAllAccommodations();
        include 'views/accommodations.php';
        break;

    case 'dashboard':
        include 'views/dashboard.php';
        break;

    case 'addAccommodation':
        require_once 'controller/UserAccommodationController.php';
        $controller = new UserAccommodationController();
        $controller->addAccommodation();
        header("Location: index.php?page=dashboard");
        exit();

    case 'removeAccommodation':
        require_once 'controller/UserAccommodationController.php';
        $controller = new UserAccommodationController();
        $controller->removeAccommodation();
        header("Location: index.php?page=dashboard");
        exit();

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario de inicio de sesión
            $userController = new UserController();
            $userController->loginProcess();

        }
        include 'views/login.php';  
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Procesar el formulario 
            $userController = new UserController();
            $userController->registerProcess();
        }
        include 'views/register.php';  
        break;

    case 'logout':
        $userController = new UserController();
        $userController->logOut();
        break;

    default:
        echo "Error: La página solicitada no es válida.";
        exit();
}
