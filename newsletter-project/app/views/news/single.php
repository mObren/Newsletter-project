<?php include APPROOT . "/views/partials/header.php" ?>


<div class="layout">
    <a class="button button_back" href="<?=URLROOT;?>/news">Go to News</a>
<div class="content">
<?php include APPROOT . "/views/partials/single.php" ?>



<form action="<?=URLROOT;?>/subscriptions/insert" method="post">
<p class="news_content"><?php echo $data['news']->content ?></p>


    <div class="subscribe_form">
        <span>Enter your email here to subscribe</span><input class="textfield" type="email" name="user_email">
        <input type="hidden" value="<?=$data['news']->id;?>" name="news_id">
        <button class="button" type="submit">Subscribe</button>
    </div>
</form>
</div>
</div>
