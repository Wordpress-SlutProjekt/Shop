<!-- Template Name: checkout
-->

<?php get_header(); ?>
<?php wp_head(); ?>

        

        <?php
  while(have_posts()){
    the_post();
    ?>
 

 <section class="checkout spad">
        <div class="container">
      <?php the_content(); ?>
    </div>


    <?php } ?>
 </section>        <!-- Checkout Section End -->

 <?php
get_footer();
?>

<?php
wp_footer();