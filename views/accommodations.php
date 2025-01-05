<?php
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
<body class="bg-dark">
<?php include('layouts/navbar.php'); ?>
    <div class="container my-5">
        <h1 class="text-center text-light mb-4">Find Your Home Away from Home</h1>
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
            
                     
                            <!-- Formulario para añadir alojamiento -->
                    <form action="index.php?page=addAccommodation" method="POST">
                        <input type="hidden" name="accommodation_id" value="<?php echo htmlspecialchars($accommodation['id']); ?>">
                        <button type="submit" class="btn btn-primary">Add to Profile</button>
                    </form>
                      
                            <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success">Accommodation added successfully!</div>
                            <?php endif; ?>
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