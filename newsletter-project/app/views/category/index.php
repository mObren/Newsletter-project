<?php include APPROOT . "/views/partials/header.php" ?>
<?php include APPROOT . "/views/partials/search_form.php" ?>


<div class="layout">
<?php if (checkIsUserLoggedIn()) :?>
    <a class="button button_back" href="<?=URLROOT;?>/admin">Back to dashboard</a>
   
    <?php endif; ?>
    <div class="content">
    <div class="single_news">
        <a class="button button_nav" href="<?=URLROOT;?>/news">Go to News</a>

        </div>
    <?php foreach ($data['categories'] as $category) : ?>
        <div class="single_news">
        <h3> <?=$category->name ; ?></h3>
        <br>
        
        <?php if (checkIsUserLoggedIn()) : ?>
            <a class="button button_delete" href="<?=URLROOT;?>/category/delete/<?=$category->id;?>">Delete category</a>
            <a class="button" href="<?=URLROOT;?>/category/insert/<?=$category->id;?>">Change category</a>

       <?php endif;  ?>
            <a class="button button_visit" href="<?=URLROOT;?>/category/single/<?=$category->id;?>">View category</a>
     
        </div>

        <?php endforeach; ?>


        </div>
    </div>
</body>
</html>