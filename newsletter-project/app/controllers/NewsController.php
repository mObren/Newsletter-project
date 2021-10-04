<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Category;
use App\Models\News;


class NewsController extends Controller {
    protected $modelName = "News";
    protected $categoryModel = "Category";

/**
 * Send data to index page.
 */
    public function index() {
        $db = new Database();

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $query = "SELECT news.id, news.image_url, news.title, 
            news.content,
            news.created_at, 
            news.category_id,
            categories.name from news 
            LEFT JOIN categories ON (news.category_id = categories.id)
             WHERE news.title LIKE '%" .$search. "%' OR news.content LIKE '%" .
              $search . "%' OR categories.name LIKE '%" . $search . "%' ORDER BY news.created_at DESC";

        } else {

        $query = "SELECT news.id, news.image_url, news.title, 
        news.content,
        news.created_at, 
        news.category_id,
        categories.name from news 
        LEFT JOIN categories ON (news.category_id = categories.id) ORDER BY news.created_at DESC";

        }
        $news = $db->read($query);
        $data['news']['news'] = $news;
        $data['page_title'] = 'Home';
       


        $this->view("news/index", $data);
    }

    /**
     * Delete post from database by targeting it's id.
     */

    public function delete($id) {
        if (!checkIsUserLoggedIn()) {
            header("Location: ../../news");
            
        } else {
            $this->loadModel($this->modelName);
            $model = new News;
            $model->delete($id);
            header("Location: ../../news");

        }



    }
    /**
     * If id is provided, function will update the existing News post.
     * Otherwise, it will create a new one.
     */

    public function insert($id = null) {
        if (!checkIsUserLoggedIn()) {
            if ($id === null) {
                header("Location: ../");
            } else {
                header("Location: ../../");

            }
               
        }
        $this->loadModel($this->categoryModel);
        $this->loadModel($this->modelName);
        $data['page_title'] = 'Add post';
        $modelNews = new News();
        
        if ($id !== null) {

            $helper = $modelNews->fetchOneById($id);
            $news = $helper[0];
            $data['page_title'] = "Edit post";
            
        }
        $catModel = new Category;
        $data['title'] = isset($news) ? $news->title : null;
        $data['content'] = isset($news) ? $news->content : null;
        $data['category_id'] = isset($news) ? $news->category_id : null;
        $data['image_url'] = isset($news) ? $news->image_url : null;

        
           

        $data['categories'] = $catModel->fetchMany();
    

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                if ($id === null) {
                    // $this->loadModel($this->modelName);
                    $data['title'] = isset($_POST['title']) ? trim($_POST['title']) : null;
                    $data['content'] = isset($_POST['content']) ? trim($_POST['content']) : null;
                    $data['category_id'] = isset($_POST['category_id']) ? trim($_POST['category_id']) : null;
                    $data['image_url'] = isset($_POST['image_url']) ? trim($_POST['image_url']) : null;

                    foreach ($_POST as $key => $value) {
                        if ($key != "image_url") {
                            if (empty(trim($value))) {
                                $data['errors'][] = "Please, fill the $key field properly";
                            }
                        }
                    
                    }
                    if (empty($data['errors'])) {
                        $modelNews->add($data);
                        header("Location: ../news/index");

                    }
                } else {
                    $data['id'] = $id;
                    $data['title'] = $_POST['title'];
                    $data['content'] = $_POST['content'];
                    $data['category_id'] =  $_POST['category_id'];
                    $data['image_url'] =  $_POST['image_url'];

                    foreach ($_POST as $key => $value) {
                        if ($key != "image_url") {
                            if (empty($value)) {
                                $data['errors'][] = "Please, fill the $key field properly";
                            }

                        }
                    }

                    if (empty($data['errors'])) {
                        $modelNews->update($data);
                        header("Location: ../index");
                    }
                }
   
            }
            
            $this->view('news/add', $data);
    }

    /**
     * Visit a single News post by targeting it's id.
     */

    public function single($id) {
        $this->loadModel($this->modelName);
        $modelNews = new News;
        $helper = $modelNews->fetchOneById($id);
        $news = $helper[0];
        $data['news'] = $news;
        $data['page_title'] = $news->title;

        $this->view('news/single', $data);

    }
    
}
