<?php
session_start();
include 'Connection.php';

//inheritance

class User extends Connection {
    //Sign Out
                            // $_POST
    public function signUp($request){
        $firstname = $request['first_name'];
        $lastname = $request['last_name'];
        $username = $request['username'];
        $password = $request['password'];

        $hashed_password = password_hash($password,PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name,last_name,username,password) VALUES ('$firstname','$lastname','$username','$hashed_password')";

        if ($this->conn->query($sql)) {
            header('location: ../views/sign-in.php');
            exit;
        }else {
            die("Error: ".$this->conn->error);
        }
    }

    //Sign In
    public function signIn($request){
        $username = $request['username'];
        $password = $request['password'];

        $sql = "SELECT * FROM users WHERE username = '$username'";

        if ($result = $this->conn->query($sql)) {
            if($result->num_rows ==1) {
                $user = $result->fetch_assoc();

                if (password_verify($password,$user['password'])) {
                    session_start();
                    $_SESSION['id']         = $user['id'];
                    $_SESSION['full_name']   = $user['first_name'] . " " .  $user['last_name'];
                    $_SESSION['user']   = $user['username'];
                    header('location: ../views/dashboard.php');
                    exit;
                }else {
                    die("ERROR: Incorrect Password " .$this->conn->error);
                }
            }else {
                die('ERROR: Username does not match' . $this->conn->error);
            }
        }else{
            die('ERROR: '.$this->conn->error);
        }
    }

    //Dashboard
    public function displayUsers(){
        $sql = "SELECT * FROM users";
        if ($result = $this->conn->query($sql)) {
            return $result;
        }else {
            die("ERROR: ".$this->conn->error);
        }
    }

    //edit-user
    public function getUser(){
        $user_id = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id = $user_id";

        if ($result = $this->conn->query($sql)) {
            return $result->fetch_assoc();
        }else {
            die("ERROR: ".$this->conn->error);
        }
    }

    public function updateUserInfo($first_name, $last_name, $username){
        $user_id = $_SESSION['id'];
        $sql = "UPDATE users SET `first_name` = '$first_name', `last_name` = '$last_name', `username` = '$username' WHERE id = $user_id";

        if ($this->conn->query($sql)) {
            header("location: ../views/dashboard.php");
        }else {
            die("ERROR: ".$this->conn->error);
        }
    }

    public function updatePhoto($user_id, $photo_name, $photo_tmp){
        $sql = "UPDATE users SET `photo` = '$photo_name' WHERE id = $user_id";

        if ($this->conn->query($sql)) {
            $destination = "../assets/images/$photo_name";
            move_uploaded_file($photo_tmp, $destination);
            header("refresh: 0");
        }else {
            die("Error in moving the photo. " . $this->conn->error);
        }
    }

    // public function logout()
    // {
    //     session_start();
    //     session_unset();
    //     session_destroy();

    //     header('location: ../views');
    //     exit;
    // }

    public function deleteUser(){
        $user_id = $_SESSION['id'];
        $sql = "DELETE FROM users WHERE id = $user_id";

        if ($this->conn->query($sql)) {
            header("location: ../views/sign-in.php");
        }
    }
    // public function deleteUser()
    // {
    //     session_start();
    //     $id = $_SESSION['id'];

    //     $sql = "DELETE FROM users WHERE id = $id";

    //     if ($this->conn->query($sql)){
    //         $this->logout();
    //     } else {
    //         die('Error deleting your account: ' . $this->conn->error);
    //     }
    // }
}




