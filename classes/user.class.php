<?php
require_once "DAL.class.php";

class User extends DAL
{
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        return $this->getData($sql);
    }
    public function insertUser($user_name, $email, $password, $role)
    {
        $sql = "INSERT INTO users (user_name,email,password,role) VALUES ('$user_name','$email','$password','$role')";
        return $this->execute($sql);
    }
    public function updateUser($user_id, $user_name, $email, $role)
    {
        $sql = "UPDATE users SET user_name= '$user_name',email='$email',role='$role'  WHERE user_id= '$user_id'";
        return $this->execute($sql);
    }
    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM users WHERE user_id='$user_id'";
        return $this->execute($sql);
    }
    public function checkUserName($user_name)
    {
        $sql = "SELECT * FROM users WHERE user_name='$user_name'";
        return $this->getData($sql);
    }
    public function checkNameId($user_id, $user_name)
    {
        $sql = "SELECT * FROM users WHERE user_name='$user_name' AND user_id != $user_id";
        return $this->getData($sql);
    }
    public function getUserById($user_id)
    {
        $sql = "SELECT password FROM users WHERE user_id='$user_id'";
        return $this->getdata($sql);
    }
    public function updatePassword($user_id, $password)
    {
        $sql = "UPDATE users SET password='$password' WHERE user_id='$user_id'";
        return $this->execute($sql);
    }
    public function registerUser($user_name, $email, $password)
    {
        $sql = "INSERT INTO users (user_name,email,password) VALUES ('$user_name','$email','$password')";
        return $this->execute($sql);
    }
}
