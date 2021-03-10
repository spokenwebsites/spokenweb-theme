<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


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
          <?php if ($children->have_posts()) : while ($children->have_posts()) : $children->the_post(); ?>
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
          <label for="selectAffiliation" class="small"><strong>Affiliation</strong></label>
          <select class="form-control" id="selectAffiliation">
            <option selected>All</option>
            <option value="Co-Investigator">Co-Investigator</option>
            <option value="Collaborator">Collaborator</option>
            <option value="Postdoctoral Fellow">Postdoctoral Fellow</option>
            <option value="Student">Student</option>
            <option value="Past Members">Past Members</option>
          </select>
        </div>

        <div class="form-group">
          <label for="selectFunction" class="small"><strong>Function</strong></label>
          <select class="form-control" id="selectFunction">
            <option selected>All</option>
            <option value="Governing Board">Governing Board</option>
            <option value="Audio Signal Processing">Audio Signal Processing Task Force</option>
            <option value="Copyright">Copyright Task Force</option>
            <option value="Metadata">Metadata Task Force</option>
            <option value="Pedagogy">Pedagogy Task Force</option>
            <option value="Podcasting">Podcasting Task Force</option>
            <option value="Systems">Systems Task Force</option>
          </select>
        </div>

        <div class="form-group">
          <label for="selectInstitution" class="small"><strong>Institution</strong></label>
          <select class="form-control" id="selectInstitution">
            <option selected>All</option>
          </select>
        </div>
      </div>

      <div id="teamContainer" class="col-sm-9">

        <hr>
        <h5>Browse Team Members</h5>
        <!--
      <h5>Filter by</h5>
      <div class="row">
        <div class="col-sm-4">
          <label for="selectAffiliation" class="small"><strong>Affiliation</strong></label>
          <select class="form-control" id="selectAffiliation">
          <option selected>All</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
        </div>
        <div class="col-sm-4">
          <label for="selectFunction" class="small"><strong>Function</strong></label>
          <select class="form-control" id="selectFunction">
          <option selected>All</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
        </div>
        <div class="col-sm-4">
        <div class="form-group">
          <label for="selectInstitution" class="small"><strong>Institution</strong></label>
          <select class="form-control" id="selectInstitution">
          <option selected>All</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
        </div>
        </div>
      </div>
  -->
        <br>


        <?php
        $args = array('post_type' => 'team', 'posts_per_page' => -1, 'post_status' => array('publish'), 'order' => 'ASC', 'orderby' => 'title');
        $team_query = new WP_Query($args);
        $count = $team_query->post_count;
        ?>

        <div class="row" style="margin-bottom:40px;">

          <?php if ($team_query->have_posts()) : $i = 0;
            while ($team_query->have_posts()) : $team_query->the_post(); ?>
              <?php
              $function = "";
              $post_custom_fields = get_post_custom();
              $display_name = $post_custom_fields['display_name'][0];
              $affiliation = $post_custom_fields['affiliation'][0];
              $type = $post_custom_fields['type'][0];
              $subtype = $post_custom_fields['subtype'][0];
              $status = $post_custom_fields['status'][0];
              $task_forces = unserialize($post_custom_fields['task_forces'][0]);
              $task_force_titles = array();
              $task_forces_text = "";
              //$function = $subtype;
              $governing_board = $post_custom_fields['governing_board'][0];
              if ($governing_board == 1) $function = "Governing Board";
              if (isset($task_forces) && is_array($task_forces)) {
                foreach ($task_forces as $task_force) {
                  $task_force_titles[] = get_post($task_force)->post_title . " Task Force";
                }
                $task_forces_text = implode(", ", $task_force_titles);
                if ($function != "") {
                  $function .= ", $task_forces_text";
                } else {
                  $function = $task_forces_text;
                }
              }

              ?>
              <?php if ($status != "Past Member") : ?>
                <div class="col-3 people-container<?php if ($i % 4 == 0) echo " first"; ?>" data-i="<?php echo $i; ?>" data-status="<?php echo $status; ?>" data-affiliation="<?php echo $type; ?>" data-name="<?php echo $display_name; ?>" data-institution="<?php echo $affiliation; ?>" data-function="<?php echo $function; ?>" style="<?php if ($status == "Past Member") echo 'display:none;'; ?>">
                  <div>
                    <a href="#<?php echo $post->post_name; ?>">
                      <?php if (has_post_thumbnail()) : ?>
                        <?php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                        $img_lg = $img_lg[0]; ?>
                        <img src="<?php echo $img_lg; ?>" width="100%" class="img-thumbnail">
                      <?php else : ?>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/blank.gif" width="100%" class="img-thumbnail">
                      <?php endif; ?>
                      <h6><strong><?php echo $display_name; ?></strong></h6>
                    </a>
                    <div class="bio-content" style="display:none;">
                      <?php if (get_the_content() != "") : ?>
                        <?php the_content(); ?>
                      <?php else : ?>
                        <p>Bio coming soon.</p>
                      <?php endif; ?>
                    </div>
                    <h6 class="subtitle"><?php echo $affiliation; ?><?php// if(isset($subtype) && $subtype!="") echo ",  $subtype";?></h6>
                  </div>
                </div>
              <?php $i++;
              endif; ?>
          <?php endwhile;
          endif; ?>

          <?php if ($team_query->have_posts()) : $i = 0;
            while ($team_query->have_posts()) : $team_query->the_post(); ?>
              <?php
              $function = "";
              $post_custom_fields = get_post_custom();
              $display_name = $post_custom_fields['display_name'][0];
              $affiliation = $post_custom_fields['affiliation'][0];
              $type = $post_custom_fields['type'][0];
              $subtype = $post_custom_fields['subtype'][0];
              $status = $post_custom_fields['status'][0];
              $task_forces = unserialize($post_custom_fields['task_forces'][0]);
              $task_force_titles = array();
              $task_forces_text = "";
              //$function = $subtype;
              $governing_board = $post_custom_fields['governing_board'][0];
              if ($governing_board == 1) $function = "Governing Board";
              if (isset($task_forces) && is_array($task_forces)) {
                foreach ($task_forces as $task_force) {
                  $task_force_titles[] = get_post($task_force)->post_title . " Task Force";
                }
                $task_forces_text = implode(", ", $task_force_titles);
                if ($function != "") {
                  $function .= ", $task_forces_text";
                } else {
                  $function = $task_forces_text;
                }
              }
              ?>
              <?php if ($status == "Past Member") : ?>
                <div class="col-3 people-container<?php if ($i % 4 == 0) echo " first"; ?>" data-i="<?php echo $i; ?>" data-status="<?php echo $status; ?>" data-affiliation="<?php echo $type; ?>" data-name="<?php echo $display_name; ?>" data-institution="<?php echo $affiliation; ?>" data-function="<?php echo $function; ?>" style="<?php if ($status == "Past Member") echo 'display:none;'; ?>">
                  <div>
                    <a href="#<?php echo $post->post_name; ?>">
                      <?php if (has_post_thumbnail()) : ?>
                        <?php $img_lg = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                        $img_lg = $img_lg[0]; ?>
                        <img src="<?php echo $img_lg; ?>" width="100%" class="img-thumbnail">
                      <?php else : ?>
                        <img src="<?php bloginfo('template_directory'); ?>/_/img/blank.gif" width="100%" class="img-thumbnail">
                      <?php endif; ?>
                      <h6><strong><?php echo $display_name; ?></strong></h6>
                    </a>
                    <div class="bio-content" style="display:none;">
                      <?php if (get_the_content() != "") : ?>
                        <?php the_content(); ?>
                      <?php else : ?>
                        <p>Bio coming soon.</p>
                      <?php endif; ?>
                    </div>
                    <h6 class="subtitle"><?php echo $affiliation; ?><?php// if(isset($subtype) && $subtype!="") echo ",  $subtype";?></h6>
                  </div>
                </div>
              <?php endif; ?>
          <?php $i++;
            endwhile;
          endif; ?>

          <div id="bioContainer" class="col-sm-12" style="display:none;"></div>
        </div>

      </div>
    </div>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>