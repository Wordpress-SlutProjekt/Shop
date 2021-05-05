<?php get_header(); ?>
<?php wp_head(); ?>

<section class="categories">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="row">
                        <?php
                           get_template_part( 'category-loop', get_post_format() );
                        ?>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
    <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>New products</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
            <nav class="header__menu">
            <?php wp_nav_menu([
                                    'container' => 'ul',
                                    'menu_class' => 'filter__controls',
                                    'theme_location' => 'category-menu',
                                    'add_li_class'  => 'your-class-name1 your-class-name-2'
                                ]) ?>
            </nav>
               
            </div>
        </div>
            
           <div class="row property__gallery">
    <?php
           get_template_part( 'tag-new-loop', get_post_format() );
    ?>
        
        
    </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Banner Section Begin -->
<section class="banner set-bg">
    <div class="container">
    <div class="section-title">
                    <h4>Fetured products</h4>
                </div>
    <?php echo do_shortcode("[wcpcsu id='201']"); ?>
    </div>
</section>
<!-- Banner Section End -->

<!-- Trend Section Begin -->


<!-- Discount Section Begin -->
<section class="discount">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 p-0">
                <div class="discount__pic">
                    <img src="img/discount.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 p-0">
                <div class="discount__text">
                    <div class="discount__text__title">
                        <span>Discount</span>
                        <h2>Summer 2019</h2>
                        <h5><span>Sale</span> 50%</h5>
                    </div>
                    <div class="discount__countdown" id="countdown-time">
                        <div class="countdown__item">
                            <span>22</span>
                            <p>Days</p>
                        </div>
                        <div class="countdown__item">
                            <span>18</span>
                            <p>Hour</p>
                        </div>
                        <div class="countdown__item">
                            <span>46</span>
                            <p>Min</p>
                        </div>
                        <div class="countdown__item">
                            <span>05</span>
                            <p>Sec</p>
                        </div>
                    </div>
                    <a href="#">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Discount Section End -->

<!-- Services Section Begin -->
<section class="services spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-car"></i>
                    <h6>Free Shipping</h6>
                    <p>For all oder over $99</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-money"></i>
                    <h6>Money Back Guarantee</h6>
                    <p>If good have Problems</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-support"></i>
                    <h6>Online Support 24/7</h6>
                    <p>Dedicated support</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="services__item">
                    <i class="fa fa-headphones"></i>
                    <h6>Payment Secure</h6>
                    <p>100% secure payment</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section End -->

<!-- Instagram Begin -->

<!-- Instagram End -->

<?php
get_footer();
?>

<?php
wp_footer();