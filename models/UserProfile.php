<?php
class UserProfile {
    private $conn;
    private $table = 'user_profiles';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getProfileByUserId($userId) {
        $query = "SELECT up.*, u.name, u.email 
                 FROM " . $this->table . " up
                 JOIN users u ON up.user_id = u.id
                 WHERE up.user_id = :user_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createProfile($data) {
        $query = "INSERT INTO " . $this->table . " 
                (user_id, profile_photo, age, gender, bio, phone_number, address, date_of_birth) 
                VALUES (:user_id, :profile_photo, :age, :gender, :bio, :phone_number, :address, :date_of_birth)";
        
        $stmt = $this->conn->prepare($query);
        
        // Bind values
        $stmt->bindParam(":user_id", $data['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(":profile_photo", $data['profile_photo']);
        $stmt->bindParam(":age", $data['age'], PDO::PARAM_INT);
        $stmt->bindParam(":gender", $data['gender']);
        $stmt->bindParam(":bio", $data['bio']);
        $stmt->bindParam(":phone_number", $data['phone_number']);
        $stmt->bindParam(":address", $data['address']);
        $stmt->bindParam(":date_of_birth", $data['date_of_birth']);
        
        return $stmt->execute();
    }

    public function updateProfile($data) {
        $query = "UPDATE " . $this->table . " SET 
                profile_photo = :profile_photo,
                age = :age,
                gender = :gender,
                bio = :bio,
                phone_number = :phone_number,
                address = :address,
                date_of_birth = :date_of_birth
                WHERE user_id = :user_id";
        
        $stmt = $this->conn->prepare($query);
        
        // Bind values
        $stmt->bindParam(":profile_photo", $data['profile_photo']);
        $stmt->bindParam(":age", $data['age'], PDO::PARAM_INT);
        $stmt->bindParam(":gender", $data['gender']);
        $stmt->bindParam(":bio", $data['bio']);
        $stmt->bindParam(":phone_number", $data['phone_number']);
        $stmt->bindParam(":address", $data['address']);
        $stmt->bindParam(":date_of_birth", $data['date_of_birth']);
        $stmt->bindParam(":user_id", $data['user_id'], PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function updateSubscription($userId, $status, $endDate) {
        $query = "UPDATE " . $this->table . " SET 
                subscription_status = :status,
                subscription_end_date = :end_date
                WHERE user_id = :user_id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":end_date", $endDate);
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function uploadProfilePhoto($userId, $photoPath) {
        $query = "UPDATE " . $this->table . " SET profile_photo = :photo_path WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":photo_path", $photoPath);
        $stmt->bindParam(":user_id", $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
} 