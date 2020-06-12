<?php get_header(); ?>

<section class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <h1 id="slogan">Sounding<br/>Literature</h1>
    </div>
    <div id="about" class="col-sm-5">
      <p>The SSHRC-funded <strong>SpokenWeb</strong> partnership aims to develop coordinated and collaborative approaches to literary historical study, digital development, and critical and pedagogical engagement with diverse collections of literary sound recordings from across Canada and beyond.

</p>
      <a href="<?php echo get_permalink( get_page_by_path( 'about-us/spokenweb/' ) )?>"><button class="btn btn-sw">MORE ABOUT US &nbsp; <span class="oi oi-arrow-right"></span></button></a>
    </div>
  </div>
</section>


<?php
	query_posts(
		array(
			'posts_per_page'=>1,
			'post_status' => 'publish',
      'post_name' => 'spokenweb-statement-in-condemnation-of-racism-and-in-support-of-black-lives-matter'
		)
	);
?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

<section class="container-fluid blm">
  <?php
	$post_custom_fields = get_post_custom();
  //	$audio = $post_custom_fields['audio'][0];
  //	$subtitle = $post_custom_fields['subtitle'][0];
  //  $audio_url = wp_get_attachment_url($audio);
  ?>

  <div id="blm-top" class="row inner-content pt-5">
    <div class="col-md-5">
      <h2><?php the_title(); ?></h2>
      <hr>
      <h3><a href="#statement">STATEMENT</a></h3>
      <h3><a href="#fellowship">NEW PROGRAM</a></h3>
      <h3 class="pb-4"><a href="#initiatives">LINKS TO INITIATIVES</a></h3>
    </div>

    <div class="col-md-6 offset-md-1">

      <article <?php post_class('post-full') ?> id="post-<?php the_ID(); ?>">

        <div class="entry post-excerpt">
          <?php the_excerpt();?>
          <h3><a href="#fellowship">Read more...</a></h3>
          <hr>
        </div>

        <div class="entry post-content" style="display:none;">
          <?php the_content();?>
          <h3><a href="#blm-top">Back to top</a></h3>
          <hr>
        </div>

      </article>


    </div>
  </div>
</section>
<?php endwhile; endif;?>


<?php
	query_posts(
		array(
			'posts_per_page'=>1,
			'post_status' => 'publish',
			'order'=>'DESC',
      'orderby'=>'date',
      'category_name'=>'audio-of-the-week'
		)
	);

	?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
      <?php
			$post_custom_fields = get_post_custom();
			$audio = $post_custom_fields['audio'][0];
			$subtitle = $post_custom_fields['subtitle'][0];
      $audio_url = wp_get_attachment_url($audio);
      ?>

<section id="audio" class="alt container-fluid" data-audio="<?php echo $audio_url;?>">
  <div class="row">
    <div class="col-sm-12">
      <h1 class="title">Audio of the Week</h1>
    </div>
    <div class="col-sm-7">
      <h3 class="subtitle">
        <?php the_title();?><br/>
        <?php echo $subtitle;?>
      </h3>


      <div style="margin-top:30px; margin-bottom:30px;">
        <div class="container-audio">
          <div class="audio-play"><span class="oi oi-media-play"></span></div>
          <div class="container-waveform">
            <div id="waveform" class="waveform"></div>
          <div class="time-container"><span class="currentTime">00:00</span> <span class="timeslash">/</span> <span class="duration">00:00</span></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-3 offset-sm-1 col-6 offset-3 mobile audiocontainer">
      <div id="audio-img-container1" style="background: #E98E4A; display: inline-block; width:100%; position:absolute; transform: rotate(45deg); transform-origin: 50% 100%;"></div>

  		<?php  if ( has_post_thumbnail() ):?>
  		<?php $img_lg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); $img_lg = $img_lg[0];?>

      <a href="<?php the_permalink();?>" target="_blank"><div style="position:relative;"><img id="audio-img1" src="<?php echo $img_lg;?>" width="100%" style="border-radius:50%;"></div></a>
      <?php endif;?>
    </div>

    <div class="col-sm-7">

      <?php the_excerpt();?>

      <h4><a href="<?php the_permalink();?>">Read more...</a></h4>


    </div>
		<?php  if ( has_post_thumbnail() ):?>
		<?php $img_lg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); $img_lg = $img_lg[0];?>

    <div class="col-sm-3 offset-sm-1 col-6 offset-3 desktop">

        <div id="audio-img-container2" style="background: #E98E4A; display: inline-block; width:100%; position:absolute; transform: rotate(45deg); transform-origin: 50% 100%;"></div>

        <a href="<?php the_permalink();?>" target="_blank"><div style="position:relative;"><img id="audio-img2" src="<?php echo $img_lg;?>" width="100%" style="border-radius:50%;"></div></a>


    </div>
    <?php endif;?>

  </div>

</section>
<?php endwhile; endif;?>

<section class="container-fluid" style="background:#fff;">

  <div class="row">
    <div class="col-sm-12">
    <h1 class="title">Upcoming Events</h1>
    <div class="row">
  	<?php
  		query_posts(
  			array(
  				'posts_per_page'=>-1,
  				'post_type'=>'events',
  				'post_status' => 'publish',
  		    'meta_query'=> array(
  		        array(
  		            'key'=>'event_end',
  		            'value'=> date("Y/m/d"),
  		            'compare' => '>='
  		        )
  		    ),
  				'order'=>'ASC',
  				'orderby'=>'meta_value',
  				'meta_key'=> 'event_start'
  			)
  		);

  		?>


  		<?php if (have_posts()) : $events_num=0;?><?php while (have_posts()) : the_post(); ?>

  			<?php
  				$post_custom_fields = get_post_custom();
  				$event_start_orig = $post_custom_fields['event_start'][0];
  				$event_end_orig = $post_custom_fields['event_end'][0];
  				$event_time = $post_custom_fields['event_time'][0];

  				$event_start=date_create_from_format("Y/m/d",$event_start_orig);
  				$event_start_mini=date_format($event_start,"M j");
  				$event_start=date_format($event_start,"M d, Y");
  				$event_end=date_create_from_format("Y/m/d",$event_end_orig);
  				$event_end_mini=date_format($event_end,"j, Y");
  				$event_end=date_format($event_end,"M d, Y");

  				if($event_start!=$event_end) $event_date = $event_start_mini."-".$event_end_mini; else $event_date=$event_start;

  			?>

        <div class="col-lg-3 col-md-4 col-sm-6">
    				<a class="event-link" href="<?php the_permalink();?>">
    				<?php  if ( has_post_thumbnail() ):?>
    					<?php $img_lg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); $img_lg = $img_lg[0];?>
    					<div class="event-container">
                <div class="event-img filter" style="background:url('<?php echo $img_lg;?>') center center;"></div>
                <div class="event-gradient"></div>
                <div class="event-gradient2"></div>
                <div class="event-text">
                  <h5><?php the_title()?></h5>
                  <p><?php echo $event_date;?></p>
                </div>
    					</div>
    				<?php endif;?>
    				</a>
  				</div>

  		<?php $events_num++; endwhile;?>
    <?php else:?>
      <p>There are currently no upcoming events.</p>
    <?php endif; wp_reset_query(); ?>
      </div>
  	</div>
    </div>
  </div>
</div>



<?php get_footer(); ?>

<script>
  var bg = document.getElementById("bg");

  window.addEventListener("scroll", function() {
      bg.style.transform = "rotate("+window.pageYOffset/10+"deg)";
  });

  $(document).ready(function(){
    var width = $("#audio-img1").width()+30;
    var height = width / 2;
    var top = $("#audio-img1").position().top-15;
    var left = $("#audio-img1").position().left;
    $("#audio-img-container1").css({"height":height+"px", "width":width+"px", "border-radius": width + "px " + width + "px 0 0", "top":top+"px", "left":left+"px"});
    var width = $("#audio-img2").width()+30;
    var height = width / 2;
    var top = $("#audio-img2").position().top-15;
    var left = $("#audio-img2").position().left;
    $("#audio-img-container2").css({"height":height+"px", "width":width+"px", "border-radius": width + "px " + width + "px 0 0", "top":top+"px", "left":left+"px"});
  });


  $(window).on("resize", function(e){
    var width = $("#audio-img1").width()+30;
    var height = width / 2;
    var top = $("#audio-img1").position().top-15;
    var left = $("#audio-img1").position().left;
    $("#audio-img-container1").css({"height":height+"px", "width":width+"px", "border-radius": width + "px " + width + "px 0 0", "top":top+"px", "left":left+"px"});
    var width = $("#audio-img2").width()+30;
    var height = width / 2;
    var top = $("#audio-img2").position().top-15;
    var left = $("#audio-img2").position().left;
    $("#audio-img-container2").css({"height":height+"px", "width":width+"px", "border-radius": width + "px " + width + "px 0 0", "top":top+"px", "left":left+"px"});
  });


</script>
