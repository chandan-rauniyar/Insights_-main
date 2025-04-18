<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $name;
    public $email;
    public $password;
    public $created_at;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    name = :name,
                    email = :email,
                    password = :password,
                    google_id = :google_id,
                    login_type = :login_type,
                    created_at = :created_at";

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $name = htmlspecialchars(strip_tags($data['name']));
        $email = htmlspecialchars(strip_tags($data['email']));
        $password = isset($data['password']) ? password_hash($data['password'], PASSWORD_BCRYPT) : null;
        $google_id = isset($data['google_id']) ? $data['google_id'] : null;
        $login_type = isset($data['google_id']) ? 'google' : 'manual';
        $created_at = date('Y-m-d H:i:s');

        // Bind values
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":google_id", $google_id);
        $stmt->bindParam(":login_type", $login_type);
        $stmt->bindParam(":created_at", $created_at);

        if($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . "
                WHERE email = :email
                LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $email = htmlspecialchars(strip_tags($email));
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function getUserByGoogleId($google_id) {
        $query = "SELECT * FROM " . $this->table_name . "
                WHERE google_id = :google_id
                LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $google_id = htmlspecialchars(strip_tags($google_id));
        $stmt->bindParam(":google_id", $google_id);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function updateGoogleId($user_id, $google_id) {
        $query = "UPDATE " . $this->table_name . "
                SET
                    google_id = :google_id,
                    login_type = 'google',
                    updated_at = :updated_at
                WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $updated_at = date('Y-m-d H:i:s');
        
        $stmt->bindParam(":google_id", $google_id);
        $stmt->bindParam(":updated_at", $updated_at);
        $stmt->bindParam(":id", $user_id);

        return $stmt->execute();
    }

    public function verifyPassword($email, $password) {
        $user = $this->getUserByEmail($email);
        if ($user && $user['login_type'] === 'manual' && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // Create new user
    public function createUser() {
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    name = :name,
                    email = :email,
                    password = :password,
                    login_type = 'manual',
                    created_at = :created_at";

        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->created_at = date('Y-m-d H:i:s');

        // Hash password
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        // Bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":created_at", $this->created_at);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Check if email exists
    public function emailExists() {
        $query = "SELECT id, name, email, password
                FROM " . $this->table_name . "
                WHERE email = :email
                LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->password = $row['password'];
            return true;
        }
        return false;
    }

    // Update password
    public function updatePassword() {
        $query = "UPDATE " . $this->table_name . "
                SET password = :password
                WHERE email = :email";

        $stmt = $this->conn->prepare($query);
        
        // Hash the password
        $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
        
        // Bind values
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":email", $this->email);

        return $stmt->execute();
    }

    // Create password reset token
    public function createPasswordResetToken() {
        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $query = "INSERT INTO password_resets
                SET
                    email = :email,
                    token = :token,
                    expires_at = :expires_at";

        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $token = htmlspecialchars(strip_tags($token));
        $expires = htmlspecialchars(strip_tags($expires));

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":expires_at", $expires);

        if($stmt->execute()) {
            return $token;
        }
        return false;
    }

    // Verify password reset token
    public function verifyPasswordResetToken($token) {
        $query = "SELECT email, expires_at
                FROM password_resets
                WHERE token = :token
                AND expires_at > NOW()
                LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $token = htmlspecialchars(strip_tags($token));
        $stmt->bindParam(":token", $token);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->email = $row['email'];
            return true;
        }
        return false;
    }

    public function updateProfile($user_id, $data) {
        $query = "UPDATE " . $this->table_name . "
                SET
                    name = :name,
                    password = :password,
                    updated_at = :updated_at
                WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        
        $name = htmlspecialchars(strip_tags($data['name']));
        $password = isset($data['password']) ? password_hash($data['password'], PASSWORD_BCRYPT) : null;
        $updated_at = date('Y-m-d H:i:s');

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":updated_at", $updated_at);
        $stmt->bindParam(":id", $user_id);

        return $stmt->execute();
    }

    public function getUserById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?> 