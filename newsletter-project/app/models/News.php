<?php
namespace App\Models;


use App\Core\Model;
use App\Core\Database;

class News implements Model {


    /**
     * If limit is set, it returns passed number of records from table. 
     * Otherwise, it returns all records.
     */
    public function fetchMany($limit = null){
        $db = new Database;
        if (isset($limit)) {
            $query = "select * from news order by created_at DESC limit $limit";
        }
        else {
            
            $query = "select * from news order by created_at DESC";

        }
        $result = $db->read($query);
        return $result;
        
    }

    public function fetchOneById($id)
    {
        $db = new Database;
        $result = $db->read("SELECT news.id, news.image_url, news.title, 
        news.content,
        news.created_at, 
        news.category_id,
        categories.name from news 
        LEFT JOIN categories ON (news.category_id = categories.id)  WHERE news.id=$id");
        return $result;

    }

    public function add($data) {
        $title = $data['title'];
        $content = $data['content'];
        $categoryId = $data['category_id'];

        $db = new Database();
        $users = $db->read("SELECT user_email FROM subscriptions WHERE category_id =". $categoryId);
  
    
        $query = "INSERT INTO news (title, content, category_id, created_at, updated_at) VALUES ('$title', '$content', '$categoryId', NOW(), NOW())";
        $db->write($query);
        foreach ($users as $user) {
            sendMail($user->user_email); 
         }
    }

    public function update($data)
    {
        $db = new Database;
        $model = $this->fetchOneById($data['id']);
        $dataModel= $model[0];
        // prettyArrayDisplay($model);


        $id = $dataModel->id;
        $title = isset($data['title']) ? $data['title'] : $dataModel->title;
        $content = isset($data['content']) ? $data['content'] : $dataModel->content;
        $categoryId = isset($data['category_id']) ? $data['category_id'] : $dataModel->category_id;
        $users = $db->read("SELECT user_email FROM subscriptions WHERE news_id =". $id);
      
 



        $query = "UPDATE news SET title = '$title', content = '$content', category_id = '$categoryId', updated_at = NOW() WHERE id = $id";
        $db->write($query);
        foreach ($users as $user) {
            sendMail($user->user_email); 
         }
  

        
    }
    public function delete($id)
    {
        $db = new Database(); 
        $db->write("DELETE FROM news WHERE id = '$id'");
        
    }

    
    
}