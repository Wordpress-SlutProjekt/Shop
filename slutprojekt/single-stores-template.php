<!-- 
Template Name: Store
Template Post Type: stores
-->

<?php get_header(); ?>

<section class="blog-details spad">
    <div class="container">
        <div id="primary" class="content-area"><nav class="breadcrumb__links"><a href="http://localhost:8888">Home</a>Our stores</nav>
        <div class="row">
            <?php
            while (have_posts()) {
                the_post();
            ?>
                <div class="col-lg-8 col-md-8">
                    <div class="blog__details__content">
                        <div class="blog__details__item">
                            <img class="fit-image" src=" <?php the_post_thumbnail(); ?> ">
                            <div class="blog__details__item__title">
                                <h4><?php the_title(); ?></h4>
                                <ul>
                                    <li> 
                                        <?php 
                            $openinghours = get_field( 'opening_hours' ); 
   								echo  $openinghours;
                                   ?>
                                   </li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog__details__desc">
                            <p><?php the_content() ?></p>
                            <div class="map-responsive">
                            <?php 
                            $storelocation = get_field( 'store_location' ); 
   								echo  $storelocation;
                                   ?>
                            </div>
                        </div>

                        <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__btn__item">
                                        <h6> 
                                            <?php previous_post_link() ?>
                                        </h6>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__btn__item blog__details__btn__item--next">
                                        <h6>
                                            <?php next_post_link() ?> 
                                        </h6>
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