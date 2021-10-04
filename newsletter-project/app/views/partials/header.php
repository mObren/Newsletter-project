<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?=APPLICATON_NAME . " | " . $data['page_title'];?> </title>
   <link rel="stylesheet" href="<?=ASSETS;?>css/style.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet"> 
    <link rel="shortcut icon" type="image/jpg" href="<?=ASSETS;?>favicon/favicon.ico"/>

</head>
<body>
   <header>
        <div class="left_area">
            <h3>Newsletter-project</h3>
        </div>


    
        
        <div class="right_area">
      
            <?php if(isset($_SESSION['admin_id'])) : ?>
            <a href="<?=URLROOT ?>/admin/logout" class="logout_btn">Logout</a>
              <?php endif ; ?>
        </div>

   </header>
