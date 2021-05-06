<?php get_header();?>

<section class="section-cart">
    <div class="container">
        <div class="row">
    <div class="section-title">
                    <h4>Cart</h4>
                </div>

                <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
            <!-- <div class="col-xs-12 col-md-8 col-md-offset-2"> -->
                <?php 
                    while(have_posts()) {
                        the_post();
                ?>
                    <br><br>
                <h1><?php //the_title();?></h1>
                
                <?php the_content();?>
                <?php
                  } 
                ?>
            
            <!-- </div> -->
                            </tbody>
                        </table>
        </div>
        </div>
</div>
</section>

<?php get_footer() ?>
