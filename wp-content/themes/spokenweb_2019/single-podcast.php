<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php $post_custom_fields = get_post_custom(); $type = strtolower(str_replace(" ", "_", $post_custom_fields['type'][0]));?>
<section class="container episode-container">
  <div class="row">
  <?php if($type == "spokenweb_podcast"):?>
    <div class="col-sm-12">
      <div class="text-center logo-container"><img src="<?php bloginfo('template_directory'); ?>/_/img/podcast_logo.png" width="108"/></div>
      <p class="return-link"><a href="<?php echo  get_permalink(get_page_by_title('SpokenWeb Podcast'));?>"><span class="return-arrow">‹</span><span class="return-text">Return to the Episodes Page</span></a></p>
      <div class="accent"><h1>SpokenWeb Podcast</h1></div>
    </div>
  <?php else:?>
    <div class="col-sm-12">
      <p class="return-link"><a href="<?php echo  get_permalink(get_page_by_title('ShortCuts'));?>"><span class="return-arrow">‹</span><span class="return-text">Return to the Episodes Page</span></a></p>
      <div class="d-sm-flex justify-content-md-between align-items-center justify-content-start flex-wrap mt-4 mt-sm-0">
        <div class="text-center text-sm-left">
          <h1 class="mb-1">SpokenWeb</h1>
          <div class="accent">
          <h1 class="py-2 mb-2">ShortCuts</h1>
          </div>
        </div>
        <div class="text-sm-left text-center logo-container pl-sm-3 pr-sm-5"><img src="<?php bloginfo('template_directory'); ?>/_/img/shortcuts_logo.png" width="150"/></div>
        <div class="subscribe-link-container text-right ml-auto"><a id="subscribe-link" href="https://the-spokenweb-podcast.simplecast.com/" target="_blank"><button class="btn btn-sw"><span class="oi oi-rss-alt"></span>SUBSCRIBE</button></a></div>
      </div>
    </div>
  <?php endif;?>

    <?php

      $obj_id = get_queried_object_id();
      $current_url = get_permalink( $obj_id );
  		$subtitle = $post_custom_fields['subtitle'][0];
  		$producer = $post_custom_fields['producer'][0];
  		$audio_embed = $post_custom_fields['audio_embed'][0];
  		$audio_download_url = $post_custom_fields['audio_download_url'][0];
  		$transcript = $post_custom_fields['transcript'][0];
  		$producer_photo = $post_custom_fields['producer_photo'][0];
      $producer_bio = $post_custom_fields['producer_bio'][0];
      $type = strtolower(str_replace(" ", "_", $post_custom_fields['type'][0]));
    ?>

  	<?php if ( has_post_thumbnail()){
      $img_lg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); $img_lg_url = $img_lg[0];
      $img_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' ); $img_thumb = $img_thumb[0];
      $img_lg_width = $img_lg[1];
      $img_lg_height = $img_lg[2];
    } else {
      $img_lg_url = "";
      $img_lg_width = "";
      $img_lg_height = "";
      $img_thumb = "";
    } ?>

    <div class="col-md-10 offset-md-1 col-sm-12 episode">
      <h5><?php echo $subtitle;?></h5>
      <h2><?php the_title();?></h2>
      <div class="row">
        <h3 class="col-sm-4 col-6"><a id="audio-embed-link" class="audio-button" href="#audio_embed"><div class="audio-play"><span class="oi oi-media-play"></span></div>LISTEN</a></h3>
        <h3 class="col-sm-4 col-6"><a class="audio-button" href="<?php echo $audio_download_url;?>" target="_blank"><div class="download-arrow"><span class="oi oi-data-transfer-download"></span></div>Download</a></h3>
      </div>
      <hr>
      <div class="row share-container">
        <div class="col-4 text-left"><h4><?php echo get_the_date();?></h4></div>
        <div class="col-4 text-center" style="margin-top:-10px;"><h4>Produced by<br/><?php echo $producer;?></h4></div>
        <div class="col-4 text-right"><h4>Share <div class="social-icons"><a href="https://twitter.com/intent/tweet?text=Have%20you%20listened%20to%20The%20SpokenWeb%20Podcast%20yet%3F%20Check%20it%20out%20here%3A%20<?php echo $current_url;?>" target="_blank"><i class="circle fab fa-twitter"></i></a> <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $current_url;?>" target="_blank"><i class="circle fab fa-facebook-f"></i></a> <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $current_url;?>&title=The%20SpokenWeb%20Podcast%20-<?php echo get_the_title();?>&summary=Have%20you%20checked%20out%20The%20SpokenWeb%20Podcast%20yet%3F%20Listen%20here%3A%20<?php echo $current_url;?>" target="_blank"><i class="circle fab fa-linkedin-in"></i></div></a></h4></div>

        <div class="col-sm-12">
          <div class="featured-episode" style="padding-right:0px; position:relative; padding-left:0px; left:0px;">
            <div class="event-img filter" style="width:100%; height:241px; background:url('<?php echo $img_lg_url;?>'); background-size:cover; background-repeat: no-repeat;"></div>
            <?php if($type == 'shortcuts'):?>
            <section class="event-orange"></section>
            <?php else:?>
            <section class="event-orange"></section>
            <?php endif;?>
          </div>

          <div class="audio-embed">
            <?php echo $audio_embed;?>
          </div>


          <div class="category-select" style="display:inline-block;">
            <a href="#summary"><button class="btn btn-sw active">SUMMARY</button></a>
            <a href="#transcript"><button class="btn btn-sw">TRANSCRIPT</button></a>
          </div>


          <div id="summary" class="text-content">
            <?php the_content();?>
          </div>

          <div id="transcript" class="text-content" style="display:none;">
            <?php if(isset($transcript) && $transcript!=""):?>
              <?php echo wpautop($transcript);?>
            <?php else:?>
              <p>Coming soon</p>
            <?php endif;?>
          </div>

          <hr>
          <div class="row producer">
            <?php $img_lg = wp_get_attachment_image_src($producer_photo, 'large' ); $img_lg_url = $img_lg[0];?>
            <div class="col-md-3 col-sm-4 col-6">
              <div style="position:relative;">
                <img class="event-img filter" style="width:100%; border-radius:100%;" src="<?php echo $img_lg_url;?>">
                <section class="event-orange" style="width:100%; height:100%; border-radius:100%;"></section>
              </div>
            </div>
            <div class="col-md-9 col-sm-8">
              <h4><?php echo $producer;?></h4>
              <?php echo wpautop($producer_bio);?>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>
</section>
<?php endwhile; endif;?>
<?php get_footer(); ?>
