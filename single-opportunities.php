<?php
$date_end_orig = get_field('date_end');
$event_time = get_field('event_time');
$date_end = date_create_from_format("Ymd", $date_end_orig);
$date_end_mini = date_format($date_end, "j, Y");
$date_end = date_format($date_end, "M d, Y");
$call_for_proposals_template = get_field('call_for_proposals_template');
$template = get_field('template');
$event_title = get_field('event_title');
$type_of_call = get_field('type_of_call');
$type_of_call_other = get_field('type_of_call_-_other');
$sidebar_content = get_field('sidebar_content');
$submit_url = get_field('submit_url');
if ($type_of_call == "Other") $type_of_call = $type_of_call_other;
$bilingual = get_field('bilingual');
$language = get_field('language');
$alt_language_url = get_field('alt_language_url');
$date_end_written = get_field('date_end_written');
if ($language == "French") {
  $alt_lang = "EN";
  $deadline_msg = "Date limite :";
  $call_for_msg = "APPEL <em>aux</em>";
} else {
  $alt_lang = "FR";
  $deadline_msg = "Deadline for proposals:";
  $call_for_msg = "CALL <em>for</em>";
}
?>
<?php if (isset($call_for_proposals_template) && $call_for_proposals_template == "Black Lives Matter") : ?>
  <section class="container-fluid">
    <div class="row">
      <div class="col-lg-5 cfp blm">
        <aside style="background:#262626; color:#fff;">
          <h1><?php echo $call_for_msg; ?> <?php echo $type_of_call; ?></h1>
          <img class="logo" src="<?php bloginfo('template_directory'); ?>/_/img/logo_long_white.png" width="259">
          <h3 class="pt-3"><?php echo $event_title; ?></h3>
          <?php echo wpautop($sidebar_content); ?>
          <hr>
          <h2 class="condensed"><?php echo $deadline_msg; ?></h2>
          <?php if (isset($date_end_written) && $date_end_written != "") : ?>
            <h2><?php echo $date_end_written; ?></h2>
          <?php else : ?>
            <h2><?php echo $date_end; ?></h2>
          <?php endif; ?>
        </aside>
        <?php if (isset($submit_url) && $submit_url != "") : ?>
          <div class="btn-container">
            <a href="<?php echo $submit_url; ?>" target="_blank"><button class="btn btn-sw black sticky">SUBMIT A PROPOSAL &nbsp; <span class="oi oi-arrow-right"></span></button></a>
          </div>
        <?php endif; ?>
      </div>
      <div class="col-lg-6 offset-lg-1 cfp-content">
        <?php if (isset($alt_language_url) && $alt_language_url != "") : ?>
          <button class="btn btn-outline-dark" style="position:absolute; right:1rem; top:0.5rem;"><a href="<?php echo $alt_language_url; ?>"><?php echo $alt_lang; ?></a></button>
        <?php endif; ?>
        <article <?php post_class('post-full, mt-1, mt-lg-5') ?> id="post-<?php the_ID(); ?>">
          <div class="entry">
            <?php the_content(); ?>
          </div>
        </article>
      </div>
      <div class="col-lg-12">
        <hr />
        <p class="category"><?php if (has_category() != 0) : ?><?php the_category(', '); ?><?php endif; ?><?php if (has_tag() != 0) : ?><?php if (has_category() != 0) : ?> | <?php endif; ?><?php the_tags('', ', '); ?><?php endif; ?></p>
        <hr />
        <div style="position:relative; top:10px;">
          <a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large">Tweet</a>
          <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
          <div class="fb-share-button" data-href="<?php echo $actual_link; ?>" data-layout="button" data-size="large" data-mobile-iframe="true"></div>
        </div>
      </div>
    </div>
  </section>
<?php elseif (isset($call_for_proposals_template) && $call_for_proposals_template == "Listening, Sound, Agency") : ?>
  <div class="" style="background:url('https://spokenweb.ca/wp-content/uploads/2019/10/symposiumcallforpapers2.jpg'); background-size:cover; height:257px;">
  </div>
  <section class="container-fluid">
    <div class="row">
      <div class="col-lg-5 cfp">
        <aside>
          <h1>CALL <em>for</em> <?php echo $type_of_call; ?></h1>
          <img class="logo" src="<?php bloginfo('template_directory'); ?>/_/img/logo_long_black.png" width="259">
          <h3><?php echo $event_title; ?></h3>
          <?php echo wpautop($sidebar_content); ?>
          <hr>
          <h2 class="condensed">Deadline for proposals:</h2>
          <h2><?php echo $date_end; ?></h2>
        </aside>
        <div class="btn-container">
          <a href="<?php echo $submit_url; ?>" target="_blank"><button class="btn btn-sw red sticky">SUBMIT A PROPOSAL &nbsp; <span class="oi oi-arrow-right"></span></button></a>
        </div>
      </div>
      <div class="col-lg-6 offset-lg-1 cfp-content">
        <article <?php post_class('post-full') ?> id="post-<?php the_ID(); ?>" style="margin-top:100px;">
          <div class="entry">
            <?php the_content(); ?>
          </div>
        </article>
      </div>
      <div class="col-lg-12">
        <hr />
        <p class="category"><?php if (has_category() != 0) : ?><?php the_category(', '); ?><?php endif; ?><?php if (has_tag() != 0) : ?><?php if (has_category() != 0) : ?> | <?php endif; ?><?php the_tags('', ', '); ?><?php endif; ?></p>
        <hr />
        <div style="position:relative; top:10px;">
          <a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large">Tweet</a>
          <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
          <div class="fb-share-button" data-href="<?php echo $actual_link; ?>" data-layout="button" data-size="large" data-mobile-iframe="true"></div>
        </div>
      </div>
    </div>
  </section>
<?php else : ?>
  <section class="container-fluid">
    <div class="row">
      <div class="col-lg-3">
        <h5 class="title">Opportunities</h5>
      </div>
    </div>
    <hr>
    <?php if (have_posts()) :
      while (have_posts()) : the_post(); ?>
        <div class="col-lg-12">
          <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> — <?php echo $date_end; ?></h4>
          <?php if (has_category("audio-of-the-week")) : ?>
            <div class="meta">Posted <time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('F j, Y'); ?></time> | By <?php echo $author; ?></p>
            </div>
          <?php else : include(TEMPLATEPATH . '/_/inc/meta-post.php'); ?>
          <?php endif; ?>
        </div>
        <div class="row inner-content">
          <div class="col-6 col-lg-3">
            <div class="entry blogthumb">
              <?php if (has_post_thumbnail()) : ?>
                <?php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                $img_lg = $img_lg[0]; ?>
                <a href="<?php echo $img_lg; ?>" class="fancybox">
                  <?php $img_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                  $img_thumb = $img_thumb[0]; ?>
                  <img src="<?php echo $img_thumb; ?>" width="100%">
                </a>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-lg-9">
            <article <?php post_class('post-full') ?> id="post-<?php the_ID(); ?>">
              <div class="entry">
                <?php the_content(); ?>
              </div>
              <p class="category"><?php if (has_category() != 0) : ?><?php the_category(', '); ?><?php endif; ?><?php if (has_tag() != 0) : ?><?php if (has_category() != 0) : ?> | <?php endif; ?><?php the_tags('', ', '); ?><?php endif; ?></p>
              <div style="position:relative; top:10px;">
                <a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large">Tweet</a>
                <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
                <div class="fb-share-button" data-href="<?php echo $actual_link; ?>" data-layout="button" data-size="large" data-mobile-iframe="true" style="position:relative; top:-8px; margin-bottom:5px;"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
              </div>
            </article>
            <hr />
            <nav class="nav-single">
              <span class="nav-previous"><?php previous_post_link('&larr; Previous post: %link'); ?></span>
              <span class="nav-next"><?php next_post_link('Next post: %link &rarr;'); ?></span>
              <div class="clear"></div>
            </nav>
            <hr />
          </div>
        </div>
    <?php endwhile;
    endif; ?>
  </section>
<?php endif; ?>