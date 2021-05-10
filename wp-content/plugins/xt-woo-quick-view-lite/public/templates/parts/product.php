<?php
/**
 * This file is used to markup the quick view modal.
 *
 * This template can be overridden by copying it to yourtheme/xt-woo-quick-view/parts/product.php.
 *
 * HOWEVER, on occasion we will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see         https://docs.xplodedthemes.com/article/127-template-structure
 * @author 		XplodedThemes
 * @package     XT_Woo_Quick_View/Templates
 * @version     1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$variation_id = !empty($variation_id) ? $variation_id : null;
?>

<div id="xt_wooqv-product-<?php the_ID(); ?>" <?php post_class('product xt_wooqv-product'); ?>>

    <span class="<?php echo xt_wooqv_modal_close_icon_class();?>"></span>
    <span class="<?php echo xt_wooqv_modal_close_icon_class(true);?>"></span>
	<?php xt_woo_quick_view()->get_template('parts/product-slider', array('variation_id' => $variation_id)); ?>
	<?php xt_woo_quick_view()->get_template('parts/product-info'); ?>

</div>

