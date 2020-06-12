<?php get_header(); ?>


	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php  if ( has_post_thumbnail() ):?>
      <?php $img_lg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); $img_lg = $img_lg[0];?>
    <?php endif;?>
  	<section id="singleEvent" class="event-container">
      <div style="background:url('<?php echo $img_lg;?>') center center; background-size:cover;" class="event-img"></div>
      <section class="event-gradient3 container-fluid row">
        <div class="col-sm-12">
          <div class="info-container">
            <button class="btn btn-sw white">PERFORMANCE</button>
      		<?php
      		$post_custom_fields = get_post_custom();
      		$event_start_orig = $post_custom_fields['event_start'][0];
      		$event_end_orig = $post_custom_fields['event_end'][0];
      		$event_time = $post_custom_fields['event_time'][0];
          
      		$event_start=date_create_from_format("Y/m/d",$event_start_orig);
      		$year=date_format($event_start,"Y");
          $event_start_mini=date_format($event_start,"M j");
      		$event_start=date_format($event_start,"M d, Y");
      		$event_end=date_create_from_format("Y/m/d",$event_end_orig);
      		$event_end_mini=date_format($event_end,"j, Y");
      		$event_end=date_format($event_end,"M d, Y");
    
      		if($event_start!=$event_end) $event_date = $event_start_mini."-".$event_end_mini; else $event_date=$event_start;

      		$city = $post_custom_fields['city'][0];
      		$venue = $post_custom_fields['venue'][0];
      		$institution = $post_custom_fields['institution'][0];

      		$city = $post_custom_fields['city'][0];
      		$venue = $post_custom_fields['venue'][0];
      		$institution = $post_custom_fields['institution'][0];

          $event_meta = array();

          if(isset($city) && $city!="") $event_meta[] = $city;
          if(isset($institution) && $institution!="") $event_meta[] = $institution;
          if(isset($venue) && $venue!="") $event_meta[] = $venue;
          ?>
    
  				<h1><?php the_title();?></h1>

        </div>
      
      </section>
      
      </div>
    </section>
    
		<article <?php post_class('post-full') ?> id="post-<?php the_ID(); ?>">
			<div class="row">

			<?php
			$post_custom_fields = get_post_custom();
			$type = $post_custom_fields['type'][0];
			$participants = $post_custom_fields['conf_participants'][0];
			$schedule = $post_custom_fields['schedule'][0];
			$participant_info_travel = $post_custom_fields['conf_participant_info_travel'][0];
			$participant_info_activity = $post_custom_fields['conf_participant_info_activity'][0];
			$notable_events = $post_custom_fields['notable_events'][0];

  		$city = $post_custom_fields['city'][0];
  		$venue = $post_custom_fields['venue'][0];
  		$institution = $post_custom_fields['institution'][0];
    
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
    
      $event_meta = array();
    
      if(isset($city) && $city!="") $event_meta[] = $city;
      if(isset($institution) && $institution!="") $event_meta[] = $institution;
      if(isset($venue) && $venue!="") $event_meta[] = $venue;
      
			?>
			
			<?php if($type=="Conference") : ?>

				<?php
				$post_custom_fields = get_post_custom();
				$type = $post_custom_fields['type'][0];
				$participants = $post_custom_fields['conf_participants'][0];
				$schedule = $post_custom_fields['schedule'][0];
				$notable_events = $post_custom_fields['notable_events'][0];
				$participant_info_travel = $post_custom_fields['conf_participant_info_travel'][0];
				$participant_info_activity = $post_custom_fields['conf_participant_info_activity'][0];
				$participant_info_accommodations = $post_custom_fields['information_for_participants_accomodations'][0];
				$call_for_papers = $post_custom_fields['call_for_papers'][0];
				$call_for_papers_url = $post_custom_fields['call_for_papers_url'][0];
				?>
				
				<aside class="col-sm-3 desktop">
					<div class="events sticky-top" style="padding-top:20px; margin-top:-20px;">
					<h4><a href="#conf-about">About the Conference</a></h4>
					<?php if(isset($notable_events) && $notable_events!=""):?>
					<h4><a href="#conf-notable-events">Notable Events</a></h4>
          <?php endif;?>          
					<?php if(isset($schedule) && $schedule!=""):?>
					<h4><a href="#conf-schedule">Conference Programme</a></h4>
					<ul id="sidebar-schedule"></ul>
					<?php endif;?>
          <?php if(isset($call_for_papers) && $call_for_papers==1):?>
          <?php if(isset($call_for_papers_url) && $call_for_papers_url!=""):?>
    			<h4><a href="<?php echo $call_for_papers_url;?>" target="_blank">Call for Papers</a></h4>
          <?php endif;?>
          <?php endif;?>
					<?php if(isset($participants) && $participants!=""):?>
					<h4><a href="#conf-participants">Participants / Abstracts</a></h4>
					<ul id="sidebar-participants"></ul>
					<?php endif;?>
					<?php if(isset($participant_info_travel) && $participant_info_travel!=""):?>
					<h4><a href="#conf-participant-info-travel">Travel</a></h4>
					<ul id="sidebar-participant-info-travel"></ul>
					<?php endif;?>
					<?php if(isset($participant_info_accommodations) && $participant_info_accommodations!=""):?>
					<h4><a href="#conf-participant-info-accomodations">Accommodations</a></h4>
					<ul id="sidebar-participant-info-accomodations"></ul>
					<?php endif;?>
					<?php if(isset($participant_info_activity) && $participant_info_activity!=""):?>
					<h4><a href="#conf-participant-info-activity">Local Activities</a></h4>
					<ul id="sidebar-participant-info-activity"></ul>
					<?php endif;?>
			
					</div>
				</aside>
				
				<div class="col-sm-9">
					<div class="entry">

						<div id="conf-about">
      				<h4><a href="<?php the_permalink(); ?>"><?php the_title();?> — <?php echo $event_date;?></a></h4>
              <div class="meta">
              	<p><?php echo implode($event_meta, " - ");?></p>
              </div>
						<?php the_content(); ?>
						</div>
            
            <div class="text-center" style="position:relative; top:10px;">
            <a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large">Tweet</a>
            <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
            <div class="fb-share-button" data-href="<?php echo $actual_link;?>" data-layout="button" data-size="large" data-mobile-iframe="true" style="position:relative; top:-8px; margin-bottom:5px;"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
            </div>
						
						<div class="mobile">
							<hr>
							<div class="events sticky-top">
							<?php if(isset($notable_events) && $notable_events!=""):?>
							<h5><a href="#conf-notable-events">Notable Events</a></h5>
              <?php endif;?>
							<?php if(isset($schedule) && $schedule!=""):?>
							<h5><a href="#conf-schedule">Conference Programme</a></h5>
							<ul id="sidebar-schedule"></ul>
							<?php endif;?>
							<?php if(isset($participants) && $participants!=""):?>
							<h5><a href="#conf-participants">Participants / Abstracts</a></h5>
							<ul id="sidebar-participants"></ul>
							<?php endif;?>
							<?php if(isset($participant_info_travel) && $participant_info_travel!=""):?>
							<h5><a href="#conf-participant-info-travel">Travel</a></h5>
							<ul id="sidebar-participant-info-travel"></ul>
							<?php endif;?>
							<?php if(isset($participant_info_accommodations) && $participant_info_accommodations!=""):?>
							<h5><a href="#conf-participant-info-accomodations">Accommodations</a></h5>
							<ul id="sidebar-participant-info-accomodations"></ul>
							<?php endif;?>
							<?php if(isset($participant_info_activity) && $participant_info_activity!=""):?>
							<h5><a href="#conf-participant-info-activity">Things to do around Montreal</a></h5>
							<ul id="sidebar-participant-info-activity"></ul>
							<?php endif;?>
							<hr>
							</div>
						</div>

						<?php if(isset($notable_events) && $notable_events!=""):?>
						<div id="conf-notable-events" style="margin-top:60px;">
							<h5>Notable Events</h5>
							<?php echo wpautop($notable_events);?>
						</div>
						<?php endif;?>

						<?php if(isset($schedule) && $schedule!=""):?>
						<div id="conf-schedule" style="margin-top:60px;">
							<h5>Schedule</h5>
							<?php echo wpautop($schedule);?>
						</div>
						<?php endif;?>

						<?php if(isset($participants) && $participants!=""):?>
						<div id="conf-participants" style="margin-top:60px;">
							<h5>Participants / Abstracts</h5>
							<?php echo wpautop($participants);?>
						</div>
						<?php endif;?>

						<?php if((isset($participant_info_travel) && $participant_info_travel!="")||(isset($participant_info_accommodations) && $participant_info_accommodations!="")):?>
						<div id="conf-participant-info-travel" style="margin-top:60px;">
							<h5>Information for Participants</h5>
							<?php if($participant_info_travel!=""):?>
								<h4>Travel</h4>
								<?php echo wpautop($participant_info_travel);?>
							<?php endif;?>
							<?php if($participant_info_accommodations!=""):?>
								<h4 id="conf-participant-info-accomodations">Accommodations</h4>
								<?php echo wpautop($participant_info_accommodations);?>
							<?php endif;?>
						</div>
						<?php endif;?>
					
						<?php if(isset($participant_info_activity) && $participant_info_activity!=""):?>
						<div id="conf-participant-info-activity" style="margin-top:60px;">
							<h4>Things to do around Montreal</h4>
							<?php echo wpautop($participant_info_activity);?>
						</div>
						<?php endif;?>
            
            
					</div>
					
				</div>
			
				<?php else : ?>
					
        <div class="col-3 col-md-3">      
    			<div class="entry blogthumb">
  				<?php  if ( has_post_thumbnail() ):?>
  				<?php $img_lg = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); $img_lg = $img_lg[0];?>
  				<a href="<?php echo $img_lg;?>" class="fancybox">
  					<?php $img_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' ); $img_thumb = $img_thumb[0];?>
  					<img src="<?php echo $img_thumb;?>" width="100%">
  				</a>
  				<?php endif;?>
          </div>
        </div>
    
        <div class="col-sm-9 col-9">

      		<article <?php post_class('post-full') ?> id="post-<?php the_ID(); ?>">
			
      			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			
            <div class="meta">
            	<p><?php echo implode($event_meta, " - ");?></p>
            </div>
			
      			<div class="entry">
      				<?php the_content(); ?>
      			</div>
			
            <p class="category"><?php if(has_category()!=0):?><?php the_category(', ');?><?php endif;?><?php if(has_tag()!=0):?><?php if(has_category()!=0):?> | <?php endif;?><?php the_tags('', ', ');?><?php endif;?></p>

            <div style="position:relative; top:10px;">
            <a class="twitter-share-button" href="https://twitter.com/intent/tweet" data-size="large">Tweet</a>
            <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
            <div class="fb-share-button" data-href="<?php echo $actual_link;?>" data-layout="button" data-size="large" data-mobile-iframe="true" style="position:relative; top:-8px; margin-bottom:5px;"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
            </div>

		
      		</article>

					</div>
				<?php endif;?>
			
			
			
			</div>
			

		
		</div>
		</article>



	<?php endwhile; endif; ?>
	
	<?php if($type=="Conference"):?>
		<script>

		$(document).ready(function(){
			$("#conf-participants h4").each(function(){
				var text = $(this).html();
		//		text = text.replace(/\s/g, '');
		//		$(this).attr("id",text);
				$("#sidebar-participants").append("<li>» " + text + "</li>");
			});
			$("#conf-schedule h4").each(function(){
				$("#sidebar-schedule").append("<li>» " + $(this).html() + "</li>");
			});
			$("#conf-participant-info-travel h4").each(function(){
				$("#sidebar-participant-info-travel").append("<li>» " + $(this).html() + "</li>");
			});
			$("#conf-participant-info-activity h4").each(function(){
				$("#sidebar-participant-info-activity").append("<li>» " + $(this).html() + "</li>");
			});
		});

		$("#sidebar-participants").hide();
		$("#sidebar-schedule").hide();
		$("#sidebar-participant-info-travel").hide();
		$("#sidebar-participant-info-activity").hide();

		//setTimeout(function(){$("#sidebar-participant-info-activity").show();}, 5000);

		</script>
	<?php endif;?>
	
<?php get_footer(); ?>