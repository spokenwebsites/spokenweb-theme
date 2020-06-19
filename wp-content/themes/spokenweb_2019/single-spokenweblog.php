<?php
$cat_id = get_cat_ID( 'spokenweblog' );
$cat_link = get_category_link( $cat_id );
?>

<div class="d-flex pt-5" style="background:#f4f4f4; padding-bottom:150px; margin-bottom:-150px;">
<div class="container">
  <h5><a href="<?php echo $cat_link;?>">← Return to SPOKENWEBLOG</a></h5>
</div>
</div>

<div class="px-3">

<?php

  while (have_posts()) : the_post();

  	$post_custom_fields = get_post_custom();
  	$date_end_orig = $post_custom_fields['date_end'][0];
  	$event_time = $post_custom_fields['event_time'][0];

  	$date_end=date_create_from_format("Ymd",$date_end_orig);
  	$date_end_mini=date_format($date_end,"j, Y");
  	$date_end=date_format($date_end,"M d, Y");

  	$author = $post_custom_fields['author'][0];
  	$author_bio = $post_custom_fields['author_bio'][0];
  	$author_image = $post_custom_fields['author_image'][0];

    $title = get_the_title();

  	$audio = $post_custom_fields['audio'][0];
  	$subtitle = $post_custom_fields['subtitle'][0];
    $audio_url = wp_get_attachment_url($audio);

?>

<div class="container featured-article mt-3 p-4">

  <div class="row d-flex justify-content-between p-2">
    <div class="col-md-6 justify-content-center align-self-center">
      <h2 class="mb-3"><?php the_title();?><?php if(isset($subtitle) && $subtitle!="") echo " – $subtitle";?></h2>


      <div class="mb-2 d-flex justify-content-end flex-row-reverse">
        <h5 class="mb-1"><?php the_time('F j, Y'); ?></h5>
        <h5 class="mb-1 mr-5"><?php echo $author;?></h5>
      </div>

      <div class="col-md-5 col-sm-9 col-12 mb-2 justify-content-center align-self-center mx-0 px-0 d-md-none d-block">

  			<?php  if ( has_post_thumbnail() ):?>
  				<?php $img_lg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); $img_lg = $img_lg[0];?>
  				<img src="<?php echo $img_lg;?>" width="100%">
  			<?php endif;?>
      </div>

      <div class="meta py-2">
        <p class="smaller"><?php if(has_category()!=0):?><?php the_category(', ');?><?php endif;?><?php if(has_tag()!=0):?><?php if(has_category()!=0):?> | <?php endif;?><?php the_tags('', ', ');?><?php endif;?></p>
      </div>

      <div class="mt-2">
        <a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large">Tweet</a>
        <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>

        <div class="fb-share-button mt-4" data-href="<?php echo $actual_link;?>" data-layout="button" data-size="large" data-mobile-iframe="true"></div>
      </div>
    </div>
    <div class="col-md-5 justify-content-center align-self-center mx-auto d-none d-md-block">
			<?php  if ( has_post_thumbnail() ):?>
				<?php $img_lg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); $img_lg = $img_lg[0];?>
				<img src="<?php echo $img_lg;?>" width="100%">
			<?php endif;?>
    </div>
  </div>
</div>

<div class="container pt-4 pb-5 px-0 article">
  <?php the_content();?>
</div>

    <?php $img_lg = wp_get_attachment_image_src($author_image, 'thumbnail' ); $img_lg_url = $img_lg[0];?>

<div class="container py-5 mb-5 px-0 authors">
  <div class="row d-flex justify-content-between p-2 flex-row-reverse">

    <div class="col-sm-9 justify-content-center align-self-center">
      <h3 class="mb-3"><?php echo $author;?></h3>
      <div class="d-sm-none d-block w-50 mb-3">
        <img class="w-100 rounded" src="<?php echo $img_lg_url;?>">
      </div>
      <?php echo wpautop($author_bio);?>
    </div>

    <div class="col-sm-3 justify-content-center align-self-start mx-auto d-none d-sm-block">
      <img class="w-100 rounded-circle" src="<?php echo $img_lg_url;?>">
    </div>
  </div>

</div>
<?php endwhile;?>

</div>
