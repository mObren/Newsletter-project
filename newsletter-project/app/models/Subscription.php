<?php
namespace App\Models;


use App\Core\Database;

class Subscription   {


    public function insert($data) {
        $newsId = isset($data['news_id']) ? intval($data['news_id']) : null;
        $email = $data['user_email'];
        $categoryId = isset($data['category_id']) ? intval($data['category_id']) : NULL;

        $db = new Database();
        
        if ($categoryId === NULL) {
            $query = "INSERT INTO subscriptions (user_email, category_id, news_id, created_at, updated_at)
             VALUES ('$email', null, $newsId, NOW(), NOW())";
            

        } else if($newsId === NULL) {
            $query = "INSERT INTO subscriptions (user_email, category_id, news_id, created_at, updated_at)
             VALUES ('$email', $categoryId, null, NOW(), NOW())";

        }
        $db->write($query);
      
        
    }
    public function getSubscriptionsWithNewsAndCats($limit = null) {
        $db = new Database;
        if (isset($limit)) {
            $query = "SELECT subscriptions.user_email, 
            subscriptions.created_at, 
            news.title, 
            categories.name from subscriptions 
            LEFT JOIN news ON (subscriptions.news_id = news.id)
            LEFT JOIN categories on 
            (subscriptions.category_id = categories.id) order by subscriptions.created_at DESC limit $limit";
        }
        else {
            
            $query = "SELECT subscriptions.user_email,
            subscriptions.created_at, 
            news.title, 
            categories.name from subscriptions 
            LEFT JOIN news ON (subscriptions.news_id = news.id) 
            LEFT JOIN categories on 
            (subscriptions.category_id = categories.id) order by subscriptions.created_at DESC";

        }
        $result = $db->read($query);
        return $result;

    }
    /**
     * If limit is set, it returns passed number of records from table. 
     * Otherwise, it returns all records.
     */
    public function fetchMany($limit = null){
        $db = new Database;
        if (isset($limit)) {
            $query = "select * from subscriptions order by created_at DESC limit $limit";
        }
        else {
            
            $query = "select * from subscriptions order by created_at DESC";

        }
        $result = $db->read($query);
        return $result;
        
    }

    public function fetchOneById($id)
    {
        
    }
}