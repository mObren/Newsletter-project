<?php
namespace App\Controllers;


use App\Core\Controller;
use App\Models\Admin;
use App\Models\Subscription;

Class AdminController extends Controller {

    protected $modelName = "Admin";
    protected $subscriptionModel = "Subscription";
    protected $newsModel = "News";
    protected $categoryModel = "Category";

    

     public function index() {
        if (!checkIsUserLoggedIn()) {
            header("Location: news/index");
            
        } else {
            $this->loadModel($this->subscriptionModel);
            $subscriptionModel = new Subscription;
            $data['subs'] = $subscriptionModel->getSubscriptionsWithNewsAndCats(8);
            $data['page_title'] = "Admin panel";
            
    
    
            $this->view("admin/index", $data);

        }


    }
    public function login() {
        $data['page_title'] = "Login";
      
        $this->loadModel($this->modelName);
        

        $model = new Admin;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
       
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            
            if (empty(trim($data['username']))) {
                $data['errors'][] = "Please provide a valid username.";
            }
            if (empty(trim($data['password']))) {
                $data['errors'][] = "Please provide a valid password.";
            }
            

            if (empty($data['errors'])) {
                $loggedUser = $model->login($data['username'], $data['password']);
                if ($loggedUser) {
                    $this->createSession($loggedUser);
                    header("Location: ../index");
                } else {
                    $data['errors'][] = "Incorrect login credentials.";
                    $this->view('../../admin/login', $data);
                }
            }
        }
        $this->view('admin/login', $data);
    }
    public function register() {
        $this->loadModel($this->modelName);
        $data['page_title'] = "Register";
        $this->view('admin/register', $data);
        $model = new Admin;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            

           $data['usernameError'] = '';
           $data['passwordError'] = '';
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            
            if (empty(trim($data['username']))) {
                $data['usernameError'] = "Please provide a valid username.";
            }
            if (empty(trim($data['password']))) {
                $data['passwordError'] = "Please provide a valid password.";
            }
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
               
                $model->register($data['username'], $data['password']);
            }
            header("Location: login");
           

    }
   
}

    protected function createSession($user) {
        $_SESSION['admin_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        header("Location: admin");

    }

    public function logout() {
        unset($_SESSION['admin_id']);
        unset($_SESSION['username']);
        header("Location: login");

    }

}
