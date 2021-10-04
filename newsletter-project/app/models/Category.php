<?php
namespace App\Models;


use App\Core\Model as Model;   
use App\Core\Database;

class Category implements Model {



    
    public function add($name) {
        $db = new Database();
    
        $query = "INSERT INTO categories (name, created_at, updated_at) VALUES ('$name', NOW(), NOW())";
        $db->write($query);
       
    }
 

    public function update($data)
    {
        $db = new Database;
        $model = $this->fetchOneById($data['id']);
        $dataModel= $model[0];
        prettyArrayDisplay($model);

        $id = $dataModel->id;
        $name = isset($data['name']) ? $data['name'] : $dataModel->name;
         prettyArrayDisplay($data);


        $query = "UPDATE categories SET name = '$name',  `updated_at` = NOW() WHERE id = $id";
        $db->write($query);

        
    }

    public function delete($id)
    {
        $db = new Database(); 
        $db->write("DELETE FROM categories WHERE id = '$id'");
        
    }

    /**
     * If limit is set, it returns passed number of records from table. 
     * Otherwise, it returns all records.
     */
    public function fetchMany($limit = null){
        $db = new Database;
        if (isset($limit)) {
            $query = "select * from categories order by created_at DESC limit $limit";
        }
        else {
            
            $query = "select * from categories order by created_at DESC";

        }
        $result = $db->read($query);
        return $result;
        
    }

    public function fetchOneById($id) {

        $db = new Database;
        $result = $db->read("select * from categories WHERE categories.id=$id");
        return $result;

    }
}