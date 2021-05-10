<?php
/**
 * Template Name: Search Page
 */

?>
<?php get_header(); ?>
<?php
$s=get_search_query();
$args = array(
                's' =>$s
            );
    
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
        _e("<h2 style='font-weight:bold;color:#000'>Search Results for: ".get_query_var('s')."</h2>");
        while ( $the_query->have_posts() ) {
           $the_query->the_post();
                 ?>
                  
                    <li>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
                  
                 <?php
        } 
    }else{
?>   
       <div class="text-center" style="height:30vh;">
        <h2  style='font-weight:bold;color:#000;margin-top:100px;'>Nothing Found</h2>
        <div class="alert alert-danger">
          <p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>
        </div>
        </div>
<?php } ?>

<?php echo paginate_links() ?>
<?php get_footer(); ?>