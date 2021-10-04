<?php include APPROOT . "/views/partials/header.php" ?>



    <div class="layout">
        <div class="content">

        </div>
    </div>

    <form class="create_news_form" method="POST">

    <label for="name">Category name</label>
     <input class="textfield" type="text" id="name" value="<?php old($data['name']) ;?>" name="name"> <br>
  

        <input class="button" type="submit" value="Save">
        <a class="button button_delete" href="<?=URLROOT?>/admin">Cancel</a>



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
   
</body>
</html>