<?php include APPROOT . "/views/partials/header.php" ?>




    <!-- end of header -->


    <!-- start of sidebar -->

    <div class="sidebar">
        <a href="<?= URLROOT ?>/news/insert">Create news</a>
        <a href="<?= URLROOT ?>/category/insert">Create category</a> 
        <a href="<?= URLROOT ?>/news/index">All news</a>
        <a href="<?= URLROOT ?>/category/index">All categories</a>
        <a href="<?= URLROOT ?>/subscriptions/index">List subscriptions</a>

    </div>
    <!-- end of sidebar -->
   <div class="content">
            <h2>Latest subscriptions</h2>
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

   
   
   
</body>
</html>
