<?php
session_start();
require_once 'controller/AccommodationController.php';


$controller = new AccommodationController();
$accommodations = $controller->getAllAccommodations();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Alojamientos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('layouts/navbar.php'); ?>

<section>
     <div class="position-relative"> 
    
        <img class="w-100" src="https://i.pinimg.com/1200x/f0/3d/62/f03d62aad467da42b4f12730fa5f364d.jpg" alt="">

        <div class="position-absolute mt-5 top-50 start-50 translate-middle">

        <h1 class="text-light fw-bold text-shadow text-center" style="font-size: 4rem;" >Where next?</h1>

        <h2 class="text-light text-center  fw-semibold text-shadow" style="font-size: 18pt;" >Save your favorite accommodations all around the word for your next trip!</h2>
        
        <div class="d-flex justify-content-center pt-2">

        <button class="btn btn-dark">
       <a class="nav-link" href="index.php?page=register">Register</a>
      </button>

      <a href="index.php?page=login" class="btn btn-primary">Log In</a>
      
       </div>
       </div>
        </div>
    
</section>

    <div class="container my-5">
        <h1 class="text-center mb-4">Find Your Home Away from Home</h1>
        <div class="row">
            <?php foreach ($accommodations as $accommodation): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="<?php echo htmlspecialchars($accommodation['image'] ?? 'default.jpg'); ?>" 
                             class="card-img-top" 
                             alt="<?php echo htmlspecialchars($accommodation['name'] ?? 'Imagen no disponible'); ?>" 
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($accommodation['name'] ?? 'N/A'); ?></h5>
                            <p class="card-text">Price: $<?php echo htmlspecialchars($accommodation['price'] ?? '0.00'); ?></p>
                            <p class="card-text"><?php echo htmlspecialchars($accommodation['description'] ?? 'Sin descripción.'); ?></p>
                            <a href="index.php?page=dashboard"><button class="btn btn-primary">Add to Profile</button></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

