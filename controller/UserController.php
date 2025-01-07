<?php


class UserController{

    private $conn;

    public function __construct()
    {
        require_once 'config/Database.php'; 
        $this->conn = (new Database())->getConnection(); 
      
    }

    public function loginProcess() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            // Consulta preparada para buscar al usuario
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
                // Verificar la contraseña
                if (password_verify($password, $row['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
    
                    // Redirigir al dashboard
                    header("Location: index.php?page=dashboard");
                    exit();
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "User not found.";
            }
        }
    }

    
    public function registerProcess()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recibir datos del formulario
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            
            // Validar datos básicos
            if (empty($username) || empty($email) || empty($password)) {
                echo "<script>alert('All fields are required.');</script>";
                return;
            }
    
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('Invalid email format.');</script>";
                return;
            }
    
            // Encriptar la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Verificar si el usuario ya existe
            $sql = "SELECT * FROM users WHERE email = :email OR username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                echo "<script>alert('User already exists.');</script>";
            } else {
                // Insertar nuevo usuario
                $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    
                if ($stmt->execute()) {
                    echo "<script>alert('Registration successful. Redirecting to login...');</script>";
                    echo "<script>window.location.href = 'index.php?page=login';</script>";
                } else {
                    echo "<script>alert('Error occurred while registering.');</script>";
                }
            }
        }
    }
    

    public function logOut(){
    session_unset();
    session_destroy();

    echo "<script>
    alert('You have successfully logged out.');
    window.location.href = 'index.php?page=landing';
    </script>"; 
    exit();
    }
}

?>
