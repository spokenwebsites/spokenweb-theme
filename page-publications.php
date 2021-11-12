<style>
.col-sm-12 jumbotron{
  background:#F0F0F0 ;
}

.publications_text{
  transform: rotate(-1deg);
   background-color: #EC8E43;
    display:inline-block
}
.col-sm-12 p{
  font-family: Futura; 
  font-style: normal;
  font-weight: bold;
  font-size: 19px;
  line-height: 27px;
  color: #312E2D; 
  
}

.col-sm-12 ul {
  border: 1px solid #000000; 
  width:180px 
}

.col-sm-6 img{
  width:586px; 
  height: 513px;
  margin-left: 150px
}

.col-sm-3 filterby {

  width: 313.23px;
  height: 380.77px;
  background: #DF7F28
}

</style>


<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


    <?php $orig = $post; ?>
    <?php if (has_parent()) : ?>

      <?php $parent_id = wp_get_post_parent_id($post->ID); ?>
      <?php $args = array('p' => $parent_id, 'post_type' => 'page'); ?>
      <?php $query = new WP_Query($args); ?>
      <?php if ($query->have_posts()) : $i = 0;
        while ($query->have_posts()) : $query->the_post(); ?>
          <!-- <div class="row">
            <div class="col-sm-3">
              <h5 class="title"><?php the_title(); ?></h5>
            </div>
          </div> -->
      <?php endwhile;
      endif; ?>

    <?php else : ?>
    <?php endif; ?>
    <div class="row inner-content">

      <!-- <aside class="col-sm-3">
        <?php if (has_children()) : ?>
          <?php $children = new WP_Query(array('post_type' => 'page', 'post_parent' => $post->ID, 'order' => 'ASC', 'orderby' => 'menu_order')); ?>
          <?php if ($children->have_posts()) : while ($children->have_posts()) : $children->the_post(); ?>
              <h4 class="<?php if ($post->ID == $orig->ID) echo 'active'; ?>"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
          <?php endwhile;
          endif; ?>
          <?php wp_reset_query(); ?>
        <?php endif; ?>


      </aside> -->

      <div class="col-sm-12 jumbotron">
				<div class="row">
					<div class="col-sm-3">
						<div class="publications_text">
							<h1>Publications</h1>
						</div>
						<p>
						<b>	<?php the_content(); ?></b>
						<ul></ul>
						
						</p>
						
					</div>
					<div class="col-sm-6">
						<img src="<?php bloginfo('template_directory'); ?>/_/img/publications_ellipse.png" />
            
					</div>
				</div>
			</div>

      <div class="col-sm-3 filterby">
        <hr>
        <b><h5>Filter by</h5></b>

        <div class="form-group" >
         <b> <label for="selectYear" class="small"><strong>Year</strong></label></b>
          <select class="form-control" id="selectYear">
            <option selected>All</option>
          </select>
        </div>

        <div class="form-group">
        <b>  <label for="selectTeamMember" class="small"><strong>Team Member</strong></label></b>
          <select class="form-control" id="selectTeamMember">
            <option selected>All</option>
          </select>
        </div>

        <div class="form-group">
         <b> <label for="selectType" class="small"><strong>Type</strong></label></b>
          <select class="form-control" id="selectType">
            <option selected>All</option>
          </select>
        </div>

      </div>

      <div id="teamContainer" class="col-sm-9">

        <hr>
        <h5>Publications</h5>
        <br>
        <div class="row" style="margin-left:-15px; margin-right:-15px;">
          <div class="col-sm-9">
            <?php
            $types = get_field_object('field_5ee6fdd7e0d11')['choices'];
            foreach ($types as $type) :
              $args = array('post_type' => 'publications', 'posts_per_page' => -1, 'post_status' => array('publish'), 'order' => 'ASC', 'orderby' => 'title', 'meta_key' => 'type', 'meta_value' => $type);
            ?>

              <?php

              $team_query = new WP_Query($args);
              $count = $team_query->post_count;
              ?>
              <div class="mb-4 publication-container">
                <h4 class="pb-2"><?php echo $type; ?></h4>
                <?php if ($team_query->have_posts()) : $i = 0;
                  while ($team_query->have_posts()) : $team_query->the_post(); ?>
                    <?php
                    $post_custom_fields = get_post_custom();
                    $type = $post_custom_fields['type'][0];
                    $year = $post_custom_fields['year'][0];
                    $team_member_ids = unserialize($post_custom_fields['team_member'][0]);
                    $team_members = array();
                    foreach ($team_member_ids as $team_member_id) {
                      //$team_member = get_post($team_member_id);
                      $team_member = get_post_meta($team_member_id, "display_name")[0];
                      $team_members[] = $team_member;
                    }
                    $team_members = implode(",", $team_members);

                    ?>
                    <div class="publication-content mb-2 pb-2" data-i="<?php echo $i; ?>" data-year="<?php echo $year; ?>" data-team-members="<?php echo $team_members; ?>" data-type="<?php echo $type; ?>">
                      <?php the_content(); ?>
                    </div>


                <?php $i++;
                  endwhile;
                endif; ?>

              </div>
            <?php endforeach; ?>

          </div>
        </div>

    <?php endwhile;
endif; ?>

    <?php get_footer(); ?>