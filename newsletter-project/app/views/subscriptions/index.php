<?php include APPROOT . "/views/partials/header.php" ?>
<div class="layout">
<?php if (checkIsUserLoggedIn()) :?>
    <a class="button button_back" href="<?=URLROOT;?>/admin">Back to dashboard</a>
    <?php endif; ?>
<div class="content">
            <h2>Latest subscriptions</h2>
            <br>
            <p>Total subscriptions : <?=count($data['subs']) ;?></p>
            <?php if (!empty($data['subs'])) { 
                foreach($data['subs'] as $subscription) { ?>
                <div class="single_news">
                <p>User '<?php echo $subscription->user_email; ?>' subscribed on 
                <?php
                 if (isset($subscription->name)) {
                     echo "'". $subscription->name . "' category.";
                 } else {
                    echo "'". $subscription->title . "' post.";
                 }
                 ?>
                 </p>
                <span><?php echo timeago($subscription->created_at); ?></span>
                </div>

            <?php  }
         } else {
             echo "<h4> Sorry, there are not any subscriptions yet :( </h4>";
         }?>

    </div>
    </div>