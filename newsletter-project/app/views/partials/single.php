
<h2 class="title"><?=$data['news']->title ;?></h2> 
<p class="single_news_category"><?=$data['news']->name;?></p>
<img class="image" src="<?php echo $data['news']->image_url?>" alt="">
<p class="created_at">Added <?=timeago($data['news']->created_at);?></p>



