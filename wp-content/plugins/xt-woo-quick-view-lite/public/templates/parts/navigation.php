<?php
/**
 * The template for displaying quick view navigation
 *
 * This template can be overridden by copying it to yourtheme/xt-woo-quick-view/parts/navigation.php.
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
?>

<?php if(xt_woo_quick_view()->access_manager()->can_use_premium_code__premium_only() && xt_wooqv_option('modal_nav_enabled', false)): ?>
    <div class="xt_wooqv-nav">
        <a class="xt_wooqv-prev"><span class="<?php echo xt_wooqv_nav_icon_class();?>"></span></a>
        <a class="xt_wooqv-next"><span class="<?php echo xt_wooqv_nav_icon_class();?>"></span></a>
    </div>
<?php endif; ?>
