<?php

class UserAccommodation
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'crud-alojamientos');
    }

    public function addToUser($userId, $accommodationId)
    {
        $stmt = $this->db->prepare("INSERT INTO user_accommodations (user_id, accommodation_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $userId, $accommodationId);
        $stmt->execute();
        $stmt->close();
    }

    public function removeFromUser($userId, $accommodationId)
    {
        $stmt = $this->db->prepare("DELETE FROM user_accommodations WHERE user_id = ? AND accommodation_id = ?");
        $stmt->bind_param("ii", $userId, $accommodationId);

        if ($stmt->execute()) {
            echo "<script>
            alert('You have successfully removed it.');
            </script>"; 
        } else {
            error_log("Error removing accommodation: " . $stmt->error);
        }
        $stmt->close();
    }

    public function getUserAccommodations($userId)
    {
        $stmt = $this->db->prepare("SELECT a.* FROM accommodations a
                                    JOIN user_accommodations ua ON a.id = ua.accommodation_id
                                    WHERE ua.user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $accommodations = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $accommodations;
    }
}
