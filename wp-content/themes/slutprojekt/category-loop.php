<?php
$categories_args = array(
	'taxonomy' => 'product_cat' // the taxonomy we want to get terms of
);

$product_categories = get_terms( $categories_args ); // get all terms of the product category taxonomy

if ($product_categories) { // only start if there are some terms

	echo '<ul class="catalog">';

	// now we are looping over each term
	foreach ($product_categories as $product_category) {

		$term_id 	= $product_category->term_id; // Term ID
	    $term_name 	= $product_category->name; // Term name
	    $term_desc 	= $product_category->description; // Term description
	    $term_link 	= get_term_link($product_category->slug, $product_category->taxonomy); // Term link


	    echo '<li class="product-cat-'.$term_id.'">'; // for each term we will create one list element

	    echo '<h4 class="product-cat-title"><a href="'.$term_link.'">'.$term_name.'</a></h4>'; // display term name with link

	    echo '<p class="product-cat-description">'.$term_desc .'</p>'; // display term description
    }}
?>
    <div class="categories__item set-bg" data-setbg="wp-content/themes/slutprojekt/img/categories/category-2.jpg">
    <div class="categories__text">
        <h4>Men’s fashion</h4>
        <p>358 items</p>
        <a href="#">Shop now</a>
    </div>
</div>