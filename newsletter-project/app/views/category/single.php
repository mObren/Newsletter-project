<?php include APPROOT . "/views/partials/header.php" ?>
<?php include APPROOT . "/views/partials/search_form.php" ?>




<div class="layout">
<a class="button button_back" href="<?=URLROOT;?>/news">Go to News</a>

<div class="content">
<h3>Category: <?=$data['category']->name;?></h3>
<br>

    <div>
    <form class="create_news_form" action="<?=URLROOT;?>/subscriptions/insert" method="post">

        <p>Enter your email here to subscribe on category</p>
     <input class="textfield" type="email" name="user_email">
        <input type="hidden" value="<?=$data['category']->id;?>" name="category_id">
        <button class="button" type="submit">Subscribe</button>
     

        
        </form>
        
        </div>
        <br>

    <?php if (!empty ($data['news']['news'])) { foreach($data['news']['news'] as $data['news']) { ?>

<div class="single_news">  
      <?php include APPROOT . "/views/partials/single.php" ?>
     <p><?php limitChars($data['news']->content) ; ?></p>
     <br>
     <a class="button button_visit" href="<?=URLROOT;?>/news/single/<?= $data['news']->id ?>"> View</a>
</div>
<?php } }  else { ?>
    <h3>
        No results.
    </h3>
<?php } ?>
</div>
</div>





