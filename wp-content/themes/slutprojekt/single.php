<?php 
get_header();
?>
<section class="product-details spad">
        <div class="container">
            <div class="row">
            <?php if (have_posts()) : ?>
        <?php if (($wp_query->post_count) > 1) : ?>
        <?php while (have_posts()) : the_post(); ?>
       <?php endwhile; ?>
       <?php else : ?>

     <?php while (have_posts()) : the_post(); ?>
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                        <?php the_post_thumbnail();?> 
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3><?php the_title(); ?></h3>
     
                      

                        <?php the_content(); ?>

                        </div>
                  
                    </div>
                </div>
          
            </div>
         
        </div>
    </section>
    <?php endwhile; ?>

<?php endif; ?>

<?php else : ?>

<?php endif; ?>