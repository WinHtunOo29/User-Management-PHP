<?php

namespace Libs\Database;
use PDOException;

class UsersTable {
    private $db = null;
    public function __construct(MYSQL $db)
    {
        $this->db = $db->connect();
    }

    public function insert($data) 
    {
        try{
            $query = "
                INSERT INTO users (name,email,phone,address,password,role_id,created_at)
                VALUES (:name,:email,:phone,:address,:password,:role_id, NOW())
            ";
            $statement = $this->db->prepare($query);
            $statement->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage() ();
        }
    }

    public function getAll() {
        $query = "
            SELECT users.*,roles.name AS role, roles.value
            FROM users LEFT JOIN roles ON users.role_id = roles.id
        ";
        $statement = $this->db->prepare($query);
        return $statement->fetchAll();
    }

    public function updatePhoto($id, $name) {
        $query = "
            UPDATE users SET photo=:name WHERE id=:id
        ";
        $statement=$this->db->prepare($query);
        $statement->execute([':name'=>$name, ':id'=>$id]);
        return $statement->rowCount();
    }

    public function findByEmailAndPassword($email, $password) {
        $query = "
            SELECT users.*, roles.name AS role, roles.value
            FROM users LEFT JOIN roles
            ON users.role_id = roles.id
            WHERE users.email = :email
            AND users.password = :password
        ";
        $statement = $this->db->prepare($query);
        $statement->execute([
            ':email'=>$email,
            ':password'=>$password
        ]);
        $row=$statement->fetch();
        return $row ?? false;
    }
}
