<?php
// Iniciar sesión
session_start();

if (isset($_SESSION['user_id'])) {
    // Si ya está autenticado, redirigir al dashboard
    header("Location: index.php?page=dashboard");
    exit();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cargar archivos necesarios
require_once 'controller/AccommodationController.php';


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
                require_once 'login_process.php';  // Incluir la lógica de procesamiento
                // Si la sesión es exitosa, redirigir a dashboard
                if (isset($_SESSION['user_id'])) {
                    header("Location: index.php?page=dashboard");
                    exit();
                }
            }
            include 'views/login.php';  
            break;

            case 'register':

                include 'views/register.php';  
                break;            
            

        case 'logout':
            session_unset();
            session_destroy();
            header("Location: index.php?page=login");
            exit();
            
   
        

    default:
        echo "Error: La página solicitada no es válida.";
        exit();
}
