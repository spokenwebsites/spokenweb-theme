<?php get_header(); ?>
<?php if (have_posts()) :
  while (have_posts()) : the_post(); ?>
    <?php $orig = $post; ?>
    <?php if (has_parent()) : ?>
      <?php $parent_id = wp_get_post_parent_id($post->ID); ?>
      <?php $args = array('p' => $parent_id, 'post_type' => 'page'); ?>
      <?php $query = new WP_Query($args); ?>
      <?php if ($query->have_posts()) : $i = 0;
        while ($query->have_posts()) : $query->the_post(); ?>
          <div class="row">
            <div class="col-sm-3">
              <h5 class="title"><?php the_title(); ?></h5>
            </div>
          </div>
      <?php endwhile;
      endif; ?>
    <?php else : ?>
      <div class="row">
        <div class="col-sm-3">
          <h4 class="title"><?php the_title(); ?></h4>
        </div>
      </div>
    <?php endif; ?>
    <hr>
    <div class="row inner-content">
      <aside class="col-sm-3">
        <?php if (has_children()) : ?>
          <?php $children = new WP_Query(array('post_type' => 'page', 'post_parent' => $post->ID, 'order' => 'ASC', 'orderby' => 'menu_order')); ?>
          <?php if ($children->have_posts()) :
            while ($children->have_posts()) : $children->the_post(); ?>
              <h4 class="<?php if ($post->ID == $orig->ID) echo 'active'; ?>"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
          <?php endwhile;
          endif; ?>
          <?php wp_reset_query(); ?>
        <?php endif; ?>
      </aside>
      <div class="col-sm-9">
        <?php the_content(); ?>
      </div>
      <div class="col-sm-3">
        <hr>
        <h5>Filter by</h5>
        <div class="form-group">
          <label for="selectYear" class="small"><strong>Year</strong></label>
          <select class="form-control" id="selectYear">
            <option selected>All</option>
          </select>
        </div>
        <div class="form-group">
          <label for="selectTeamMember" class="small"><strong>Team Member</strong></label>
          <select class="form-control" id="selectTeamMember">
            <option selected>All</option>
          </select>
        </div>
        <div class="form-group">
          <label for="selectType" class="small"><strong>Type</strong></label>
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
                    $type = get_field('type');
                    $year = get_field('year');
                    $team_member_ids = get_field('team_member');
                    $team_members = array();
                    foreach ($team_member_ids as $team_member_id) {
                      $team_member = get_field('display_name', $team_member_id);
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