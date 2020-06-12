<?php $cats = get_categories();?>

<ul class="nav">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-flip="false" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categories</a>
    <div class="dropdown-menu">
			<?php foreach($cats as $cat):?>
				<a class="dropdown-item" href="<?php echo get_category_link($cat->term_id);?>"><span><?php echo $cat->name;?></span></a>
			<?php endforeach;?>
    </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-flip="false" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Archives</a>
    <div class="dropdown-menu">
			<?php wp_get_archives(array('type'=>'monthly', 'format'=>'bootstrap')); ?>
    </div>
  </li>	
</ul>
