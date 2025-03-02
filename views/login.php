<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php?page=dashboard");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="bg-dark">

<section class="container d-flex justify-content-center m-4">
    <div class="card p-2">
        <h2>Login</h2>
        <!-- Cambiamos el action para que apunte a index.php y pase la página y el método -->
        <form class="form" action="index.php?page=login&action=process" method="POST">
            <label class="form-label" for="email">Email:</label>
            <input class="form-control" type="email" name="email" id="email" required><br><br>
            
            <label class="form-label" for="password">Password:</label>
            <input class="form-control" type="password" name="password" id="password" required><br><br>
            
            <button class="btn btn-dark" type="submit">Login</button>
        </form>
    </div>
</section>

</body>
</html>
