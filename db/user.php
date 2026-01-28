<?php
class user
{
    private $db;
    function __construct($con)
    {
        $this->db = $con;
    }
    function insertuser($username, $password)
    {
        try {
            $result = $this->getuserbyusername($username);
            if ($result["num"] > 0) {
                return false;
            } else {
                $new_password = md5($password, $username);
                $sql = "INSERT INTO users(username,password) VALUE(:username,:password)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":password", $new_password);
                $stmt->execute();
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    function getuserbyusername($username)
    {
        try {
            $sql = "SELECT COUNT(*) as num FROM users WHERE username = :username";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>