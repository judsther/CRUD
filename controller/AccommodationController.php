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
    }

    ?>
    