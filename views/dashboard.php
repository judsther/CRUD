<?php
require_once 'models/UserAccommodation.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$model = new UserAccommodation();
$accommodations = $model->getUserAccommodations($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Vinculando Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Barra de navegación -->
            <?php include('layouts/navbar.php'); ?>

            <!-- Contenido principal del dashboard -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <h1 class="h2">My Profile</h1>

                <!-- Mensaje de bienvenida al usuario -->
                <div class="alert alert-success">
                    Welcome <?php echo $_SESSION['username']; ?>!
                </div>

                
                <div class="container mt-4">
    <h2>Your Saved Accommodations</h2>
    <div class="row">
        <?php foreach ($accommodations as $accommodation): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?php echo $accommodation['image']; ?>" class="card-img-top" alt="Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $accommodation['name']; ?></h5>
                        <p class="card-text"><?php echo $accommodation['description']; ?></p>
                        <form action="index.php?page=removeAccommodation" method="POST">
                            <input type="hidden" name="accommodation_id" value="<?php echo $accommodation['id']; ?>">
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
                
                </div>
            </main>
        </div>
    </div>

    <!-- Script para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
