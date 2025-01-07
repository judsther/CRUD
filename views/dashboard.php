<?php

var_dump($_SESSION);

require_once 'controller/AccommodationController.php';
require_once 'controller/UserAccommodationController.php';

$controller = new AccommodationController();
$accommodations = $controller->getAllAccommodations();

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
<body class="bg-dark text-light">
<?php include('layouts/navbar.php'); ?>

<div class="position-relative overflow-hidden" style="height: 500px;"> 
    
    <img class="w-100" src="https://i.pinimg.com/1200x/9a/7f/b0/9a7fb09ce5e9ae80666e0e4b3be6a243.jpg" alt="">

    <div class="position-absolute mt-5 top-50 start-50 translate-middle">

    <h2 class="text-light fw-bold text-shadow text-center px-5" style="font-size: 2rem;" >My Profile</h2>

    <div class="alert alert-success">
                    Welcome <?php echo $_SESSION['username']; ?>!

                    <a href="views/createAccommodation.php" class="btn btn-success">Create Accommodation</a>
                </div>
   </div>
    </div>



    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="container mt-4">
    <h2>Your Saved Accommodations</h2>
    <div class="row">
        <?php foreach ($accommodations as $accommodation): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="<?php echo $accommodation['image']; ?>" class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
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
