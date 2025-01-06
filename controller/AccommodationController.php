<?php 
    require_once './config/Database.php';
    require_once './models/Accommodation.php';
    
    class AccommodationController {
        private $db;
    
        public function __construct() {
            $database = new Database();
            $this->db = $database->getConnection();
        }
    
        public function getAllAccommodations() {
            $query = "SELECT * FROM accommodations"; 
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    
public function createAccommodation() {

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $userId = $_SESSION['user_id'];

    
    $model = new Accommodation();
    $result = $model->createAccommodation($name, $description, $location, $price, $image, $userId);

    if ($result) {
        header("Location: dashboard.php?success=Accommodation added successfully");
    } else {
        header("Location: addAccommodation.php?error=Failed to add accommodation");
    }
}
        }
    
public function editAccommodation(){

        $userId = $_SESSION['user_id'];

        if (isset($_GET['id'])) {
            $accommodationId = $_GET['id'];
        
            // Verificando que el alojamiento pertenece al usuario
            $query = "SELECT * FROM accommodations WHERE id = ? AND user_id = ?";
            $stmt = $this->db->prepare($query);
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
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sssii", $name, $description, $location, $price, $image, $accommodationId, $userId);
        
            if ($stmt->execute()) {
                header("Location: dashboard.php?success=Accommodation updated!");
                exit();
            } else {
                $error = "Error updating accommodation.";
            }
        }

    }
}


    ?>
    