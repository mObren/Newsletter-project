<?php 
namespace App\Controllers;



use App\Core\Controller;
use App\Models\Category as Category;
use App\Core\Database;

Class CategoryController extends Controller {

    protected $modelName = "Category";

   
    function index() {
     
        $this->loadModel($this->modelName);
        $model = new Category;
        $data['categories'] = $model->fetchMany();
        $data['page_title'] = "Categories";
        $this->view("category/index", $data);
    }


    public function insert($id = null) {
        if (!checkIsUserLoggedIn()) {
            if ($id === null) {
                header("Location: ../");
            } else {
                header("Location: ../../");

            }
        }
  
        $this->loadModel($this->modelName);
        $catModel = new Category;
        $data['errors'] = [];
        $data['page_title'] = "Add category";

              
        if ($id !== null) {

            $helper = $catModel->fetchOneById($id);
            $category = $helper[0];
            $data['page_title'] = "Edit category";
            
        }
        $data['name'] = isset($category) ? $category->name : null;

        
  
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
       

        if ($id === null) {
                $name = trim($_POST['name']);
                foreach ($_POST as $key => $value) {
                    if (empty($value)) {
                        $data['errors'][] = "Please, fill the $key field properly";
                    }
                }
                if (empty($data['errors'])) {
                    $catModel->add($name);
                    header("Location: ../category/index");
                }
               

        } else {
            
            $data['id'] = $id;
            $data['name'] = trim($_POST['name']);
            foreach ($_POST as $key => $value) {
                if (empty($value)) {
                    $data['errors'][] = "Please, fill the $key field properly";
                }
            }
            if (empty($data['errors'])) {
                $catModel->update($data);
                header("Location: ../index");
            }
        }
        
     }
     $this->view('category/add', $data);
     
}
    
    public function delete($id) {
        if (!checkIsUserLoggedIn()) {
            header("Location: ../../");
            
        } else {
            $this->loadModel($this->modelName);
            $model = new Category;
            $model->delete($id);
            header("Location: ../index");
        }



    }
    public function single($id){
        $this->loadModel($this->modelName);
        $modelCat = new Category;
        $helper = $modelCat->fetchOneById($id);
        $category = $helper[0];
        $db = new Database;

       

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $query = "SELECT news.id, news.image_url, news.title, 
            news.content,
            news.created_at, 
            news.category_id,
            categories.name from news 
            LEFT JOIN categories ON (news.category_id = categories.id)
             WHERE news.category_id = $id AND (news.title LIKE '%" .$search. "%' OR news.content LIKE '%" . $search. "%') ORDER BY news.created_at DESC";

        } else {

        $query = "SELECT news.id, news.image_url, news.title, 
        news.content,
        news.created_at, 
        news.category_id,
        categories.name from news 
        LEFT JOIN categories ON (news.category_id = categories.id) WHERE news.category_id = $id ORDER BY news.created_at DESC";

        }


        $news = $db->read($query);

        // $categories = $modelCat->fetchMany();
        // $data['categories'] = $categories;
        $data['news']['news'] = $news;
        $data['category'] = $category;
        $data['page_title'] = $category->name;


        $this->view('category/single', $data);

    }


    

}