<!-- Template Name: Privacy
-->


<?php get_header(); ?>


<section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__content">
                        <div class="contact__address">
                        <?php 
                    while(have_posts()) {
                        the_post();
                ?>

                <h5><?php the_title();?></h5>
                <?php the_content();?>
                <?php
                  } 
                ?>
                        </div>

                    </div>
                </div>
  
        </div>
    </div>
</section>

<?php get_footer();?>