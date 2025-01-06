<?php
session_start();
require_once 'config/Database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

if (isset($_GET['id'])) {
    $accommodationId = $_GET['id'];

    // Verificar que el alojamiento pertenece al usuario
    $query = "SELECT * FROM accommodations WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $accommodationId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: dashboard.php?error=Accommodation not found!");
        exit();
    }

    $accommodation = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $query = "UPDATE accommodations SET name = ?, description = ?, location = ?, price = ?, image = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssii", $name, $description, $location, $price, $image, $accommodationId, $userId);

    if ($stmt->execute()) {
        header("Location: dashboard.php?success=Accommodation updated!");
        exit();
    } else {
        $error = "Error updating accommodation.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Accommodation</title>
</head>
<body>
    <form method="POST" action="editAccommodation.php?id=<?php echo $accommodationId; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($accommodation['name']); ?>"><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo htmlspecialchars($accommodation['description']); ?></textarea><br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" ><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" min="0">
        <label for="image">Image URL:</label>
        <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($accommodation['image']); ?>"><br>
       
        <button type="submit">Update Accommodation</button>
    </form>
</body>
</html>
