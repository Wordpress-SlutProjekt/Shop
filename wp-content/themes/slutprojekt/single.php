<?php get_header(); ?>


<section class="blog-details spad">
        <div class="container">
            <div class="row">
            <?php
  while(have_posts()){
    the_post();
    ?>
                <div class="col-lg-8 col-md-8">
                    <div class="blog__details__content">
                        <div class="blog__details__item">
                            <img src=" <?php the_post_thumbnail();?>" alt="">
                            <div class="blog__details__item__title">
                                <h4><?php the_title(); ?></h4>
                                <ul>
                                    <li>by <span><a href="<?php the_permalink() ?>"><?php the_author();?></a></span></li>
                                    <li><?php the_time(); ?></li>
                                    <li><?php echo sprintf(__('<a href="%s">%s comment(s)</a>', 'textdomain'), get_comments_link(),get_comments_number()); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog__details__desc">
                        <p><?php the_content() ?></p>
                        </div>
    
    
                        <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__btn__item">
                                        <h6> <?php previous_post_link()?>        	  
<i class="fa fa-angle-left"></i> </h6>
                                    </div>
                                </div>
         
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__btn__item blog__details__btn__item--next">
                                        <h6><?php next_post_link() ?> <i class="fa fa-angle-right"></i></h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </section>


    <?php get_footer(); ?>