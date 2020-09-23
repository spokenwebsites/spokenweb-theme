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

    $date = get_the_date('j F, Y');
    $current_date = date('j F, Y');

    $author = $post_custom_fields['author'][0];
    $author_index = $post_custom_fields['author_index_name'][0];
  	$author_bio = $post_custom_fields['author_bio'][0];
  	$author_image = $post_custom_fields['author_image'][0];

    $interviewee = $post_custom_fields['interviewee'][0];
    $interviewee_index = $post_custom_fields['interviewee_index_name'][0];
  	$interviewee_bio = $post_custom_fields['interviewee_bio'][0];

    $title = get_the_title();

  	$audio = $post_custom_fields['audio'][0];
  	$subtitle = $post_custom_fields['subtitle'][0];
    $audio_url = wp_get_attachment_url($audio);
    $post_url = "spokenweb.ca/$post->post_name/";
    $post_url_full = "https://spokenweb.ca/$post->post_name/";
?>


<?php if (has_category('interviews')){
  $citation_mla = "$interviewee_index. “$title.” Interview by $author. <em>SPOKENWEBLOG</em>, $date, $post_url. Accessed $current_date";
  $citation_chi = "$interviewee_index, “$title,” interview by $author, <em>SPOKENWEBLOG</em>, $date, $post_url_full.";
} else {
  $citation_mla = "$author_index. “$title.” <em>SPOKENWEBLOG</em>, $date, $post_url. Accessed $current_date.";
  $citation_chi = "$author_index, “$title,” <em>SPOKENWEBLOG</em>, $date, $post_url_full.";
}
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

        <div class="d-inline-block" style="top: -0.5rem; position: relative;">
          <span class="d-lg-inline d-none ml-3 mr-1">|</span>
          <button class="btn" data-toggle="modal" data-target="#citationModal" data-mla="<?php echo $citation_mla;?>" data-chi="<?php echo $citation_chi;?>"><span>Cite this article <i style="background:#000; color:#fff; font-size:10px;" class="ml-2 p-2 rounded-circle fas fa-quote-left"></i></span></button>
        </div>

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

<div id="citationModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mt-4 mx-4">
        <h3 class="modal-title text-uppercase">Choose your citation format</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-4 mb-2 pb-0">

        <h3 class="mt-2">MLA</h3>
        <p class="citation-mla small px-3 py-4 my-3" style="border:1px solid #ccc; border-radius: 4px;"></p>
        <button data-clipboard-text="<?php echo $citation_mla;?>" class="btn btn-outline-dark" data-toggle="tooltip" data-placement="right" data-trigger="click" title="Copied!">Copy citation</button>

        <h3 class="mt-5">Chicago</h3>
        <p class="citation-chi small px-3 py-4 my-3" style="border:1px solid #ccc; border-radius: 4px;"></p>
        <button data-clipboard-text="<?php echo $citation_chi;?>" class="btn btn-outline-dark" data-toggle="tooltip" data-placement="right" data-trigger="click" title="Copied!">Copy citation</button>

      </div>

      <div class="modal-footer mx-4 mb-3" style="border: none;">
      <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
    </div>

    </div>
  </div>
</div>

<?php endwhile;?>

</div>
