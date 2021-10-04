<?php include APPROOT . "/views/partials/header.php" ?>
<div class="layout">
<div class="content">
    <form class="create_news_form" action="<?=URLROOT?>/admin/register" method="post">


    Username : <input class="textfield" type="text" name="username">
    Password : <input class="textfield" type="password" name="password">

    <input class="button" type="submit" value="register">

 
    <div class="errors">
        <?php 
        
        if (!empty($data['errors'])) {
            foreach ($data['errors'] as $message) {
               echo "<p>$message</p>"; 
                }
            }
                ?>

        
    </div>
 
    </form>

</div>
</div>
