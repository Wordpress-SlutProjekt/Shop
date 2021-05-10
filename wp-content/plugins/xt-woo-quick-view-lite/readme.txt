=== XT WooCommerce Quick View ===

Plugin Name: XT WooCommerce Quick View
Contributors: XplodedThemes
Author: XplodedThemes
Author URI: https://www.xplodedthemes.com
Tags: quick view, woocommerce quick view,  woocommerce quickview, quickview, woocommerce product quick view, woocommerce product slider, ajax add to cart, product lightbox, product quick view, product modal, quick view modal, woo quick view
Requires at least: 4.6
Tested up to: 5.7
Stable tag: trunk
Requires PHP: 5.4+
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

An interactive product quick view modal for WooCommerce that provides the user a quick access to main product information with smooth animation.

== Description ==

An interactive product quick view modal for WooCommerce that provides the user a quick access to main product information with smooth animation.

**Video Overview**

[youtube https://youtu.be/x35KPt_FO_A]

**Demo**

[https://demos.xplodedthemes.com/woo-quick-view/](https://demos.xplodedthemes.com/woo-quick-view/)

**Free Version**

- Unobstructive Quick View
- Fast modal loading
- Fast ajax add to cart
- Smooth Animations
- Product Variations Support
- Responsive / Mobile Support
- Support bundles & composite products

**Premium Features**

Fully customizable right from WordPress Customizer with Live Preview.

- All Free Features
- Live Preview Customizer
- Change Modal Trigger Position
	- Before Add to cart button
	- Above add to cart button
	- After add to cart button
	- Below add to cart button
	- Over product image on Hover
- Choose between 2 different types of modals (Default, Full Screen)
- Quick Product Browser Navigation
- Apply Google Fonts / Typography
- Apply Custom Icons
- Custom Colors / Backgrounds
- Custom Dimensions
- Custom Modal Overlay Color
- Modal Background / Shadow / Radius
- Product Image Slider
	- 2 Animations (Fade / Slide)
	- Autoplay feature
	- Gray Scale Transition
	- Enable Lightbox
	- Custom Arrow Icons
	- Thumbs Gallery Carousel
- Switch to Variation Image	Automatically
- Ajax Add to cart button
- Compatible With WooCommerce Additional Variation Images Plugin
- Product Variations Support
- Automated Updates & Security Patches
- Priority Email & Help Center Support

**Compatible With <a target="_blank" href="https://xplodedthemes.com/products/woo-floating-cart/">Woo Floating Cart</a>**
**Compatible With <a target="_blank" href="https://xplodedthemes.com/products/woo-variation-swatches/">Woo Variation Swatches</a>**

**Translations**

- English - default

*Note:* All our plugins are localized / translatable by default. This is very important for all users worldwide. So please contribute your language to the plugin to make it even more useful.

== Installation ==

Installing "Woo Quick View" can be done by following these steps:

1. Download the plugin from the customer area at "XplodedThemes.com" 
2. Upload the plugin ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard
3. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

#### V.1.8.2 - 20.04.2021
- **fix**: Fixed issue with product description not being displayed

#### V.1.8.1 - 17.04.2021
- **fix**: Fixed conflict with **Woo Variation Swatches**
- **fix**: Product loop order gets out of order after displaying the quick view trigger on a group or bundle product.
- **support**: Show navigation for elementor triggers as well.

#### V.1.8.0 - 12.04.2021
- **fix**: Fixed issue with shortcodes. Same product being loaded.
- **support**: Show navigation for shortcode triggers as well.
- **new**: Product info items can now be re-ordered and each item can be enabled / disabled. https://d.pr/i/d9TsYp

#### V.1.7.9 - 31.03.2021
- **support**: Multisite - Network Level License Management
- **update**: XT Framework update

#### V.1.7.8 - 23.03.2021
- **fix**: XT Framework update / fixes

#### V.1.7.8 - 22.03.2021
- **update**: XT Framework update
- **fix**: Fixed issue with Over Product Image trigger on Divi Theme Product Carousels

#### V.1.7.7 - 03.03.2021
- **update**: XT Framework update

#### V.1.7.6 - 03.03.2021
- **fix**: Minor CSS Fixes
- **update**: XT Framework update
- **support**: Better theme support for over product image quick view triggers

#### V.1.7.4 - 26.01.2021
- **fix**: Minor CSS Fixes
- **update**: XT Framework update

#### V.1.7.3 - 04.01.2021
- **support**: Fixed infinite loop issue with the Trigger Shortcode when placing the shortcode manually within the product loop template.

#### V.1.7.2 - 10.12.2020
- **support**: Added support for Loco Translate by adding a loco.xml bundle config file.
- **update**: Updated translation file

#### V.1.7.1 - 05.12.2020
- **fix**: Minor CSS Fixes
- **update**: XT Framework update

#### V.1.7.0 - 05.11.2020
- **fix**: Remove duplicated quick view trigger for variation product when Woo Variation Swatches is enabled on archives.
- **update**: XT Framework update

#### V.1.6.9 - 04.11.2020
- **new**: Added option to select slider Thumb / Image sizes. By default, **woocommerce_gallery_thumbnail** & **woocommerce_single** will be used.
- **fix**: Fixed issue with quick view modal not opening after opening the same product twice one some themes.

#### V.1.6.8 - 30.10.2020
- **fix**: Fix issue with touch events on mobile

#### V.1.6.7 - 28.10.2020
- **enhance**: Instant clicks on mobile. Replace all click events with touchstart on mobile which removes the extra 300ms delay.
- **enhance**: Cache duplicated queries.
- **support**: Support variation image switch in free version as well.
- **update**: XT Framework update

#### V.1.6.6 - 23.10.2020
- **new**: **Woo Add To Cart** : On single product pages, make the scroll up to **Added to cart notice** optional!
- **new**: **Woo Add To Cart** : Enable Disable Ajax add to cart on shop or single product pages
- **new**: **Woo Add To Cart** : Added Redirect options (to cart, to checkout, to custom page) after add to cart.

#### V.1.6.5 - 21.10.2020
- **new**: Added new **Woo Add To Cart** section. Enable Ajax Add To Cart on single product page. Added custom loading spinners and confirmation checkmarks for the Add to cart button. These settings will now be shared between the **Woo Quick View**, **Woo Floating Cart** & **Woo Variation Swatches** plugins.

#### V.1.6.4 - 07.10.2020
- **new**: XT Framework System Status will now show info about the active theme as well as XT Plugin templates that are overridden by the theme. Similar to woocommerce, it will now be easier to know which plugin templates are outdated.

#### V.1.6.3.2 - 30.09.2020
- **fix**: Minor CSS fixes

#### V.1.6.3 - 23.09.2020
- **fix**: Hide previous / next navigation arrows if no more products available to browse.
- **new**: Added an Elementor Widget "XT Woo Quick View" similar to the trigger shortcode. Add a quick view trigger anywhere on a page using Elementor.

#### V.1.6.2 - 14.08.2020
- **Update**: Update Kirki Framework to v3.1.5
- **fix**: Fixed issue with customizer fields being hidden on WP v5.5

#### V.1.6.1 - 21.07.2020
- **fix**: Fix conflict between Woo Quick View and WooCommerce Show Single Variations

#### V.1.6.0 - 16.07.2020
- **fix**: Fix infinite loop issue with composite products after selecting options.
- **new**: Morph image on variation select. Smoother than simply replacing the image to avoid flickering.
- **support*: yith quick view support

#### V.1.5.8 - 24.06.2020
- **fix**: Minor Fixes
- **fix**: Refresh cart fragments after adding to cart on free version

#### V.1.5.7.1 - 19.05.2020
- **fix**: Minor Fixes

#### V.1.5.7 - 19.05.2020
- **new**: Added option to force showing add to cart button on shop archive page. Some themes do not show it by default, ex: Divi theme.
- **fix**: Minor Fixes

#### V.1.5.6.1 - 01.05.2020
- **fix**: Minor Fixes

#### V.1.5.6 - 23.04.2020
- **new**: **Pro** Added new type option (Inline & Redirect), In inline mode, the quick view will be displayed below or above the product by automatically detecting the next row. It has the same animation options as the FullScreen type. The redirect mode is simply a redirect to the single product page.
- **fix**: Minor Fixes

#### V.1.5.5 - 09.04.2020
- **fix**: Fix issue with quantity field not being shown for variable products
- **support**: Better theme support for when the quick view trigger is positioned over product on hover
- **support**: Better compatibility with XT Woo Variation Swatches plugin

#### V.1.5.4 - 07.04.2020
- **fix**: Fixed intermittent scrolling issue on mobile
- **new**: **Pro** Better customizer options for modifying the padding & alignment of all product buttons including the quick view trigger and the add to cart button.
- **new**: **Pro** Added 2 JS API functions: xt_wooqv_is_first() and xt_wooqv_is_last()
- **support**: **Pro** Support Woo Floating Cart, the Quick View can now be triggered from within the cart suggested products.

#### V.1.5.2 - 05.04.2020
- **fix**: Fixed issue with media queries not being applied correctly in some cases
- **fix**: Minor css fixes for mobile
- **new**: **Pro** Added option to select another close icon on mobile devices
- **new**: **Pro** Added option to resize the close icon on mobile devices
- **new**: **Pro** Added positioning option to the navigation arrows
- **enhance**: On mobile, the close icon will not be fixed anymore. It will scroll with the content avoiding collision with the slider arrows.
- **enhance**: When using the default modal type, the quick view will now be fullscreen on mobile screens same as the fullscreen modal type for better performance.
- **enhance**: Added a background behind the close button on mobile. The background color will inherit the modal background. This will fix the issue of opening the LightBox Gallery by mistake when trying to close the modal.
- **update**: XT Framework update v1.1.3, better media queries handling

#### V.1.5.1 - 27.03.2020
- **fix**: Fixed issue causing product classes "first" and "last" not to be added correctly on the shop page

#### V.1.5.0 - 27.03.2020
- **fix**: **Pro** Fixed customizer issue not being able to apply a new color to the modal close button
- **fix**: **Pro** Fixed issue with navigation arrows sometimes hidden even if more products are available to be shown
- **new**: **Pro** Added new option to disable the initial Quick View open animation
- **new**: **Pro** Added new Full Screen display option with multiple animation types
- **new**: **Pro** Added new Vertical Slider option (Vertical slide animation / Vertical Thumbs Gallery).
- **new**: **Pro** Replaced old PrettyPhoto LightBox with LightGallery. (Minimal or Advanced Gallery available)
- **new**: **Pro** Added new option to change the slider image size (Cover / Contain) for each screen view (Desktop, Tablet, Mobile)
- **new**: **Pro** Added new option to change the slider image Position (Center, Top, Bottom) for each screen view (Desktop, Tablet, Mobile)
- **new**: **Pro** Added new option to change the number of visible slides at a time, for each screen view (Desktop, Tablet, Mobile)
- **new**: **Pro** Added new option to change the number of visible gallery thumbnails at a time, for each screen view (Desktop, Tablet, Mobile)
- **new**: **Pro** Added new option to set a background color behind slider image when the image size is set to "Contain".
- **new**: **Pro** By default, automatically adjust text and icon colors based on the background (Dark / Light).
- **new**: Added the option to adjust the Z-Index for the quick view modal
- **new**: Some premium features are now available within the free version
- **update**: **Pro** Removed the overlay spinner options. They are now useless since the quick view loads faster than the actual spinner.
- **enhance**: Instant quick view loading. No more ajax calls except for loading a variation. All products quick view content will now be loaded once on page load and hidden until the quick view button is triggered.

#### V.1.4.3.4 - 18.02.2020
- **update**: XT Framework update / bug fixes

#### V.1.4.3.1 - 06.02.2020
- **enhance**: Trigger the native woocommerce "added_to_cart" event on the single product page. This will make other plugins detect the event and act on it.

#### V.1.4.3 - 29.01.2020
- **fix**: Fixed issue with plugin TextDomain not being loaded properly
- **update**: Updated translation files

#### V.1.4.2 - 10.01.2019
- **update**: XT Framework update.

#### V.1.4.1 - 09.01.2019
- **fix**: Fix image slider arrows and nav thumbnails not showing.
- **enhance**: Major backend changes. All XT Plugins will now appear under "XT Plugins" menu.

#### V.1.4.0 - 22.11.2019
- **fix**: Minor Fixes

#### V.1.3.9 - 29.10.2019
- **Support**: Support WordPress v5.2.4

#### V.1.3.8 - 23.10.2019
- **Update**: **Pro** Update customizer library to v3.0.45
- **Fix**: **Pro** Fixed issue with some customizer fields hidden on Flatsome theme and others.

#### V.1.3.7 - 14.10.2019
- **Update**: Update Freemius SDK to v2.3.1

#### V.1.3.6 - 01.09.2019
- **Support**: Better support for Woocommerce Product Addons plugin. Fix issue with hidden required fields.
- **Fix**: Fixed issue with shortcode trigger
- **Fix**: Fixed issue with navigation arrows showing even if no more products available
- **Enhance**: Allow using shortcode triggers as well as regular trigger positions

#### V.1.3.5 - 19.08.2019
- **Update**: **Pro** Updated customizer library to V3.0.44

#### V.1.3.4 - 13.05.2019
- **Fix**: **Pro** Customizer: Fixed navigation arrows options not being applied.
- **Fix**: Remove deprecated jQuery functions

#### V.1.3.3 - 21.04.2019
- **Fix**: **Pro** Fixed add to cart "full width" option.
- **Fix**: **Pro** Minor customizer style output fixes
- **Fix**: Avoid duplicated triggers on some themes
- **Fix**: **Pro** Fixed customizer typography field issue with font variants.
- **Fix**: Avoid closing modal while still animating
- **Support**: **Pro** Standard fonts can now be selected or can inherit theme fonts without loading google fonts.

#### V.1.3.2 - 04.04.2019
- **fix**: **Pro** Fixed licensing issue
- **fix**: **Pro** Fix issue when validating WooCommerce Extra Product Options plugin required fields
- **fix**: Minor CSS Fixes

#### V.1.3.1 - 18.03.2019
- **Update**: **Pro** Updated Customizer Framework
- **Support**: Better WPML Support

#### V.1.3.0 - 05.03.2019
- **Fix**: Fixed conflict with WPML causing quick view not to load.

#### V.1.2.9 - 26.02.2019
- **Fix**: Fixed bug with customizer default values

#### V.1.2.8 - 26.02.2019
- **Update**: Update Freemius SDK to v2.2.4
- **Update**: **Pro** Update plugin updater to support php 7.3
- **Fix**: Fixed issue with quantity field not being able to update product quantities on mobile devices
- **Fix**: Fixed intermittent javascript error with some themes

#### V.1.2.7 - 19.02.2019
- **Enhance**: Faster Ajax Requests
- **Fix**: **Pro** Fixed issue with Customizer Link field

#### V.1.2.6 - 27.01.2019
- **Fix**: Fixed javascript error when selecting a variation
- **Fix**: **Pro** Fixed issue when trigger position is set to over image, the click event only works on the trigger icon and not on the container.
- **New**: **Pro** Added public Javascript API Functions to open / close the quick view or browse to previous / next product while open. xt_wooqv_open(), xt_wooqv_close(), xt_wooqv_previous(), xt_wooqv_next()

#### V.1.2.5 - 27.01.2019
- **New**: **Pro** Make the auto generate short description feature optional within the customizer
- **Support**: Support bundles & composite products
- **Fix**: Force user to set a quantity if manually set to 0

#### V.1.2.4 - 18.01.2019
- **Support**: **Pro** Added support for validating required fields from Product Addon plugin: https://wordpress.org/plugins/woocommerce-product-addon/
- **Fix**: Minor css fixes

#### V.1.2.3 - 17.01.2019
- **Fix**: Fixed issue with free version popup not loading product info
- **New**: **Pro** Added product info container padding option.
- **New**: **Pro** Added margin bottom options to all product info sections
- **New**: **Pro** Added option to show / hide "More Info" button
- **New**: Automatically generate product short description from main description if empty
- **Update**: Update Freemius SDK to v2.2.3

#### V.1.2.2 - 11.01.2019
- **Fix**: Fixed issue with license key migration

#### V.1.2.1 - 10.01.2019
- **Fix**: Fixed license migration issue

#### V.1.2.0 - 09.01.2019
- **Update**: Migrated Licensing / Billing System to Freemius
- **Fix**: Prefixed all plugin css classes and php function with "xt_" example: "wooqv" becomes "xt_wooqv", if you added custom css or have overridden plugin templates within your theme, make sure to add this prefix or else it will break

#### V.1.1.2 - 27.10.2018
- **Support**: Better theme support for trigger position "Over Image & Over Container"
- **Fix**: Fixed issue with some customizer color fields not showing
- **Fix**: Fixed multiple ajax requests issue with variable products
- **Fix**: Minor cart refresh fixes

#### V.1.1.1 - 18.09.2018
- **Fix**: Fix javascript error when selecting a variation

#### V.1.1.0 - 11.09.2018
- **Fix**: Remove / Replace deprecated woocommerce functions
- **Fix**: Prevent variable product from being added to cart if no option has been selected
- **Fix**: Minor Customizer Fixes

#### V.1.0.9 - 01.07.2018
- **Enhance**: More usable on ipads
- **Support**: Added new javascript event "xt_wooqv-product-loaded" on "document.body" triggered once the quick view is opened and product info loaded. Can be used by themes or plugins to perform custom actions

#### V.1.0.8 - 24.04.2018
- **New**: Added Previous / Next Navigation Arrows to quickly preview products on the page
- **New**: Added options to select navigation arrow icon / size and color
- **Fix**: Removed greyscale animation if only one image is found within the slider
- **Support**: Better variations support
- **Support**: Switch to variation image whenever a variation is selected
- **Support**: Support the WooCommerce Additional Variation Images Plugin

#### V.1.0.7 - 23.03.2018
- **New**: Added an optional Trigger Overlay Color if the trigger position is set to Over Product or Over Image
- **Fix**: Fixed some trigger options where not appearing within the customizer
- **Support**: Better compatibility with Flatsome Theme
- **Support**: Better theme compatibility

#### V.1.0.6 - 15.01.2018
- **Support**: Woo Variations Table Plugin

#### V.1.0.5 - 25.11.2017
- **Support**: Wordpress v4.9 Customizer Support

#### V.1.0.4 - 24.10.2017
- **New**: Added trigger shortcode [xt_wooqv_trigger id="PRODUCT_ID"] that can be inserted within post content editor or anywhere within a theme template
- **New**: Added new trigger position "Over Product Container" better theme compatibility compared to "Over Product Image"
- **Fix**: Fix compatibility issue with the X Theme
- **Support**: Better theme compatibility

#### V.1.0.3.1 - 07.07.2017
- **Fix**: Fix multiple domain license check bug

#### V.1.0.3 - 29.05.2017
- **Fix**: Fix issue with the More Info button on FireFox

#### V.1.0.2 - 19.05.2017
- **Fix**: Fix issues with Flatsome WordPress Theme
- **Support**: Better theme compatibility

#### V.1.0.1 - 24.04.2017
- **Fix**: Support WooCommerce 3.0.x+
- **Fix**: Minor CSS Fixes

#### V.1.0.0 - 10.03.2017
- **Initial**: Initial Version

