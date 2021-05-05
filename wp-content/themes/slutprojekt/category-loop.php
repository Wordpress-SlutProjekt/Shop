<?php
$categories_args = array(
	'taxonomy' => 'product_cat' 
);

$product_categories = get_terms( $categories_args ); // get all terms of the product category taxonomy

if ($product_categories) { // only start if there are some terms

	
   

	// now we are looping over each term
	foreach ($product_categories as $key=>$product_category) {
        
                $term_id 	= $product_category->term_id; // Term ID
                $term_name 	= $product_category->name; // Term name
                $term_desc 	= $product_category->description; // Term description
                $term_link 	= get_term_link($product_category->slug, $product_category->taxonomy); // Term link
                $thumbnail_id = get_term_meta($term_id, 'thumbnail_id', true);
                $image_cat_url = wp_get_attachment_image_src($thumbnail_id);
                $image = wp_get_attachment_url( $thumbnail_id );
                $count = $product_category->count;
                

                
        
        
        
       
        
        echo    '<div class="col-lg-3 col-md-3 col-sm-3 p-0">';
        echo    '<div class="categories__item set-bg" data-setbg="'.$image.'">';
        echo    '<div class="categories__text">';
	    
	    echo '<h4>'.$term_name.'</h4>'; 
        echo '<p>'.$count.' items</p>';
        echo '<a href="'.$term_link.'">Shop Now</a>';

	   
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
    }}
    
    echo '</div>';
    echo '</div>';
    

?>
    
        
       
   