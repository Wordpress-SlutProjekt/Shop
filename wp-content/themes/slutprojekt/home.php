<<<<<<< HEAD
<?php get_header(); ?>

<section class="blog spad">
  <div class="container">
    <div class="row">
      <?php
      while (have_posts()) {
        the_post();
      ?>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="blog__item">
            <div class="blog__item__pic large__item set-bg" data-setbg="<?= get_the_post_thumbnail_url(); ?>"></div>
            <div class="blog__item__text">
              <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
              <ul>
                <li>by <span><a href="<?php the_permalink() ?>"><?php the_author(); ?></a></span></li>
                <li><?php the_time(); ?></li>
              </ul>
            </div>
          </div>

        </div>
      <?php } ?>


    </div>
  </div>
</section>




<?php get_footer(); ?>
