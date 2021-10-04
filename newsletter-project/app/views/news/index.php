<?php include APPROOT . "/views/partials/header.php" ?>
<?php include APPROOT . "/views/partials/search_form.php" ?>




<div class="layout">
    <?php if (checkIsUserLoggedIn()) :?>
    <a class="button button_back" href="<?=URLROOT;?>/admin">Back to dashboard</a>

    <?php endif; ?>
    <div class="content">
        <div class="single_news">
        <a class="button button_nav" href="<?=URLROOT;?>/category">Go to Categories</a>

        </div>

                <?php

            if (!empty($data['news']['news'])) {
            foreach($data['news']['news'] as $data['news']) { ?>
            <div class="single_news">
 
            <?php include APPROOT . "/views/partials/single.php" ?>
             
                
               <p class="news_content"><?php limitChars($data['news']->content);?></p>

            <?php if (checkIsUserLoggedIn()) { ?>
                <a class="button button_delete" href="<?=URLROOT;?>/news/delete/<?= $data['news']->id;?>">Delete news</a>

                <a class="button" href="insert/<?= $data['news']->id;?>">Update</a>

             <?php   } ?>    

              <a class="button button_visit" href="<?=URLROOT;?>/news/single/<?= $data['news']->id;?>">View</a>
              <br>
              </div>

          <?php  } } else { ?>
            <h3>No results.</h3>
         <?php }
            ?>
        
    </div>
</div>
</body>
</html>
