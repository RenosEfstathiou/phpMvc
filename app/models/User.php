<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Login User
    public function login($email, $password)
    {
        $query = "SELECT * FROM users WHERE user_email = :email ";
        $this->db->query($query);
        $this->db->bind(":email", $email);
        $res = $this->db->single();
        $hashed_pass = $res->user_password;

        if (password_verify($password, $hashed_pass)) {
            return $res;
        } else {
            return false;
        }
    }
    // Find user by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE user_email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    // Register User 
    public function register($data)
    {
        $query = "INSERT INTO users(user_name,user_email,user_password) VALUES (:name,:email,:password) ";
        $this->db->query($query);
        // Bind values to query
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
