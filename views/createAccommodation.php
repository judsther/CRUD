

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Create New Accommodation</title>
</head>
<body class="bg-dark text-light">
    <section class="container mt-5" style="width: 500px;">
        <h2>Create New Accommodation</h2>
    <form method="POST" action="index.php?page=createAccommodation" enctype="multipart/form-data">

    <div class="mb-3">
        <label class="form-label" for="name">Name:</label>
        <input class="form-control" type="text" id="name" name="name" required>
   </div>
   <div class="mb-3">
        <label class="form-label" for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" required></textarea><br>
    </div>
    <div class="mb-3">
        <label class="form-label" for="location">Location:</label>
        <input class="form-control" type="text" id="location" name="location" required><br>
    </div>
    <div class="mb-3">
        <label class="form-label" for="price">Price:</label>
        <input class="form-control" type="number" id="price" name="price" step="0.01" min="0" required><br>
    </div>
    <div class="mb-3">
        <label class="form-label" for="image">Image URL:</label>
        <input class="form-control" type="text" id="image" name="image"><br>
    </div>
        <button class="btn btn-light" type="submit">Create Accommodation</button>
    </form>
    <section></section>
</body>
</html>
