<?php include APPROOT . "/views/partials/header.php" ?>

<div class="layout">
<div class="content">
    

    <form class="create_news_form" action="" method="post">
        <h2 class="title">Create news</h2>
        <label for="title">Title:</label>
        <input class="textfield" type="text" name="title" id="title" value="<?php old($data['title']) ;?>">
        <label for="image_url">Image  url:</label>
        <input class="textfield" placeholder="(optional)" type="text" name="image_url" id="image_url" value="<?php old($data['image_url']);?>">
        <label for="content">Content:</label>
        <textarea class="textfield"  name="content" id="content" ><?php old($data['content']); ?></textarea>
        <label for="category_id">Category:</label>
        <select class="textfield"  name="category_id" id="category_id">
            <option value="<?php old($data['category_id']);?>">-Select category-</option>
            <?php foreach($data['categories'] as $category) : ?>
                <option value="<?=$category->id;?>"> <?=$category->name;?></option>
                <?php endforeach; ?>


        </select>
        <input class="button" type="submit" value="Save">
        <a class="button button_delete" href="<?=URLROOT;?>/admin">Cancel</a>


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
</body>
</html>