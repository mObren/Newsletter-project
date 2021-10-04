<?php 
namespace App\Core;

class App {


    private $controller = "App\Controllers\AdminController";
    private $method = "index";
    private $params = [];
    public function __construct()
    {
        $url = $this->splitURL();

        
        //Checking if url parameter mathces with files in controller folder

        if (file_exists("../app/controllers/" . ucfirst($url[0]) . "Controller.php")) {
            $this->controller = "App\Controllers\\" . ucfirst($url[0]) . "Controller";
         
            unset($url[0]);
        } 

        require "../app/controllers/" . str_replace("App\Controllers\\", '', $this->controller) . ".php";    
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {

                $this->method = $url[1];  
                unset($url[1]);   

            }
        }
        // print_r($this->method);
        //Run the class and method
        $this->params = array_values($url);
        call_user_func_array([$this->controller, $this->method], $this->params);
       // prettyArrayDisplay($url);

    }

    /**
     * Splits url parameters
     */
    private function splitURL() {

        $url = isset($_GET['url']) ? $_GET['url'] : "news/index";
        return explode("/", filter_var(trim($url, "/"), FILTER_SANITIZE_URL));

    }
}