
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Accommodation</title>
</head>
<body class="bg-dark text-light">
    <section class="container" style="width: 500px;">
    <form method="POST" action="editAccommodation.php?id=<?php echo $accommodationId; ?>">
        <label class="form-label" for="name">Name:</label>
        <input class="form-control" type="text" id="name" name="name" value="<?php echo htmlspecialchars($accommodation['name']); ?>"><br>
        <label class="form-label" for="description">Description:</label>
        <textarea class="form-control" id="description" name="description"><?php echo htmlspecialchars($accommodation['description']); ?></textarea><br>
        <label class="form-label" for="location">Location:</label>
        <input class="form-control" type="text" id="location" name="location" ><br>
        <label class="form-label" for="price">Price:</label>
        <input class="form-control" type="number" id="price" name="price" step="0.01" min="0">
        <label class="form-label" for="image">Image URL:</label>
        <input class="form-control" type="text" id="image" name="image" value="<?php echo htmlspecialchars($accommodation['image']); ?>"><br>
       
        <button class="btn btn-light" type="submit">Update Accommodation</button>
    </form>
    </section>
</body>
</html>
