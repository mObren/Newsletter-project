<?php
namespace App\Controllers;


use App\Core\Controller;
use App\Models\Subscription;

class SubscriptionsController extends Controller {
    protected $modelName = "Subscription";

    public function index() {
        if (!checkIsUserLoggedIn()) {
            header("Location: ../../news");
            
        } else {
        $this->loadModel($this->modelName);
        $subscriptionModel = new Subscription;
        $data['subs'] = $subscriptionModel->getSubscriptionsWithNewsAndCats();
        $data['page_title'] = "Subscriptions";
        $this->view("subscriptions/index", $data);
        }
    }


    public function insert() {

        $this->save();

    }

    public function save() {
        $this->loadModel($this->modelName);
        $subscription = new Subscription;

        $data['errors'] = [];
        
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['category_id'] = isset($_POST['category_id']) ? $_POST['category_id'] : null;
            $data['news_id'] = isset($_POST['news_id']) ? $_POST['news_id'] : null;            
            $data['user_email'] = isset($_POST['user_email']) ? trim($_POST['user_email']) : null;

            if (empty($_POST['user_email'])) {
                $data['errors'] = "Please, fill the email field properly.";
            }
            if (!checkEmail($_POST['user_email'])) {
                $data['errors'] = "Please, enter a valid email address.";
            } 
            if (empty($data['category_id']) && empty($data['news_id'])) {
                $data['errors'] = "Please, chose category or news to subscribe on.";

            }
            $data['success'] = "Thank you for subscription!";
       
            if (empty($data['errors'])) {
                $subscription->insert($data);
                header("Location: ../news/index");
                

            }
        }

    }   
}