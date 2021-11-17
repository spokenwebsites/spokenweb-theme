<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="p-md-5 header d-lg-flex py-4 align-content-center">
      <div class="w-100 w-sm-50 px-4 px-md-0  mt-3">
        <h1><span>Publications</span></h1>
        <h2 class="my-md-5 my-sm-4 my-3"><?php the_content(); ?></h2>
      </div>
      <div class="w-100 mr-lg-5 px-5 py-4 py-lg-2 mt-3">
        <img class="w-lg-100 w-sm-75 w-100 mx-auto" src="<?php bloginfo('template_directory'); ?>/_/img/research/publications.svg" />
      </div>
    </div>
    <section id="research-content" class="container-fluid pt-5 mt-4">
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
          <div class="filters sticky p-4 mb-5 w-100 w-sm-75 w-md-100">
            <h2>FILTER BY</h2>
            <div class="form-group mt-4">
              <label for="selectYear" class="h2 mb-0">Year</label>
              <select class="form-control" id="selectYear">
                <option selected>All</option>
              </select>
            </div>
            <div class="form-group mt-1">
              <label for="selectTeamMember" class="h2 mb-0">Team Member</label>
              <select class="form-control" id="selectTeamMember">
                <option selected>All</option>
              </select>
            </div>
            <div class="form-group mt-1 mb-4">
              <label for="selectType" class="h2 mb-0">Type</label>
              <select class="form-control" id="selectType">
                <option selected>All</option>
              </select>
            </div>
          </div>
        </div>

        <div id="teamContainer" class="col-xl-9 col-lg-8 col-md-7">
          <div class="row">
            <div class="col-xl-9 col-12 px-0 px-md-3">
              <?php
              $types = get_field_object('field_5ee6fdd7e0d11')['choices'];
              foreach ($types as $type) :
                $args = array('post_type' => 'publications', 'posts_per_page' => -1, 'post_status' => array('publish'), 'order' => 'ASC', 'orderby' => 'title', 'meta_key' => 'type', 'meta_value' => $type);
              ?>
                <?php
                $research_query = new WP_Query($args);
                $count = $research_query->post_count;
                ?>
                <div class="mb-3 publication-container">
                  <h3 class="pb-4"><span><?php echo $type; ?></span></h3>
                  <?php if ($research_query->have_posts()) : $i = 0;
                    while ($research_query->have_posts()) : $research_query->the_post(); ?>
                      <?php
                      $post_custom_fields = get_post_custom();
                      $type = $post_custom_fields['type'][0];
                      $year = $post_custom_fields['year'][0];
                      $team_member_ids = unserialize($post_custom_fields['team_member'][0]);
                      $team_members = array();
                      foreach ($team_member_ids as $team_member_id) {
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
        </div>
      </div>

  <?php endwhile;
endif; ?>

  <?php get_footer(); ?>