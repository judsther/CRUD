<?php


require_once 'models/UserAccommodation.php';


    class UserAccommodationController {

        

        public function addAccommodation() {
            if (!isset($_SESSION['user_id']) || !isset($_POST['accommodation_id'])) {
                // Manejar errores: usuario no autenticado o alojamiento no especificado
                return;
            }
    
            $userId = $_SESSION['user_id'];
            $accommodationId = $_POST['accommodation_id'];
    
            // Conexión a la base de datos 
            $db = new Database();
            $conn = $db->getConnection();
    
            // Inserta en la tabla que relaciona usuarios y alojamientos
            $stmt = $conn->prepare("INSERT INTO user_accommodations (user_id, accommodation_id) VALUES (:user_id, :accommodation_id)");
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':accommodation_id', $accommodationId, PDO::PARAM_INT);
    
            $stmt->execute();
        
    
          
        }

        
    
    

    public function removeAccommodation()
    {
        session_start();
        if (isset($_POST['accommodation_id'], $_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $accommodationId = $_POST['accommodation_id'];

            $model = new UserAccommodation();
            $model->removeFromUser($userId, $accommodationId);
        }
    }
}
