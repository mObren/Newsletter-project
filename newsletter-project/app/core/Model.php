<?php 


namespace App\Core;

 interface Model {


  
    public function add($param);

    public function update($id);

    public function delete($id);

    public function fetchOneById($id);
    

}