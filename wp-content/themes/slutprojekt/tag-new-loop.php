<?php
$query = new WP_Query( array(
                'post_type' => 'product',
                'posts_per_page' => '-1', // unlimited posts
                'tax_query' => array(
                   array(
                     'taxonomy' => 'product_tag',
                     'field' => 'slug',
                     'terms' => array( 'new' ),
                   ),
                ),
            ) );
            
            
            $categories = array();
            if ($query->have_posts()){
            while ( $query->have_posts() ) : $query->the_post(); 
                        
                            
                            $product = wc_get_product( get_the_ID() );
                            $price = $product->get_price();
                            $thumb_id = get_post_thumbnail_id();
                            $thumb_url = wp_get_attachment_image_src($thumb_id,'medium', true);
                            
                            $img = get_the_post_thumbnail_url();
                            
                            
                            
                            echo    '<div class="col-lg-3 col-md-4 col-sm-6">';
                            echo    '<div class="product__item">';
                            
                            echo    '<div class="product__item__pic set-bg" data-setbg="'.$img.'">';
                            echo    '<ul class="product__hover">';
                            echo    '<li><a href="'.get_the_permalink().'" class="image-popup"><span class="arrow_expand"></span></a></li>';
                            
                            echo    '<li><a href="#"><span class="icon_heart_alt"></span></a></li>'; 
                            echo    '<li><a href="#"><span class="icon_bag_alt"></span></a></li>';
                            echo    '</ul>';
                            
                            
                            echo '</div>';
                            echo  '<div class="product__item__text">';
                            echo '<h6><a href="'.get_the_permalink().'">titel'.the_title().'</a></h6>';
                            echo '<div class="product__price">'.$price.'</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        
                            
                            
                        endwhile;
            wp_reset_postdata();
                    }else{
                        echo 'gick inte';
                    }


            
     ?>
        
        
       
        
        
  



       