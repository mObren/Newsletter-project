<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Database;


class Admin implements Model {

    protected $id;
    protected $email;
    protected $password;
    protected $created_at;
    protected $updated_at;


    public function register($username, $password) {
        $db = new Database;
        $query = "INSERT INTO admins (username, password, created_at, updated_at) values ('$username', '$password', NOW(), NOW())";
    
        $db->write($query);
    }
    public function login($username, $password) {
        
        $db = new Database;
        $query = "SELECT * FROM admins WHERE username = '$username'";

        $user = $db->read($query);

        if (isset($user[0])) {
            $hashedPassword = $user[0]->password;

        if (password_verify($password, $hashedPassword)) {

            return $user[0];

        } else {
            return false;
        }
        }
        


    }


    public function update($id) {

    }

    public function delete($id){
         
    }

    public function fetchOneById($id) {

    }
    public function add($data) {

    }
} 
