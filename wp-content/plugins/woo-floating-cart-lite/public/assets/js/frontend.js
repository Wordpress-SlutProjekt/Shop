(function($) {
	$.fn.mutated = function(cb, e) {
		e = e || { subtree:true, childList:true, characterData:true };
		$(this).each(function() {
			function callback(changes) { cb.call(node, changes, this); }
			var node = this;
			(new MutationObserver(callback)).observe(node, e);
		});
	};
})(jQuery);

(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 */

	$(function() {

		//jQuery Cache
		var $$ = (function() {
			var cache = {};
			return (function (selector) {
				if(selector === 'flush') {
					cache = {};
					return true;
				}
				return cache[selector] || ( cache[selector] = jQuery (selector) );
			});
		})();

		// wc_cart_fragments_params is required to continue, ensure the object exists
		if ( typeof wc_cart_fragments_params === 'undefined' ) {
			return false;
		}

		// Vars
		var $supports_html5_storage,
			cart_hash_key = (wc_cart_fragments_params.ajax_url.toString() + '-wc_cart_hash'),
			singleAddToCartBtn = 'form .single_add_to_cart_button, .variations .single_add_to_cart_button',
			wooNotices = '.woocommerce-notices-wrapper',
			cartNotice = '.xt_woofc-notice',
			cartContainer = '.xt_woofc',
			cartInner = '.xt_woofc-inner',
			cartWrapper = '.xt_woofc-wrapper',
			cartHeader = '.xt_woofc-header',
			cartBody = '.xt_woofc-body',
			cartBodyHeader = '.xt_woofc-body-header',
			cartBodyFooter = '.xt_woofc-body-footer',
			cartListWrap = '.xt_woofc-list-wrap',
			cartList = 'ul.xt_woofc-list',
			cartTrigger = '.xt_woofc-trigger',
			cartCount = '.xt_woofc-count',
			cartCheckoutButton = '.xt_woofc-checkout',
			cartMenu = '.xt_woofc-menu',
			cartMenuLink = '.xt_woofc-menu-link',
			cartMenuCountBadge = '.xt_woofc-menu-count.xt_woofc-badge',
			cartShortcodeLink = '.xt_woofc-shortcode-link',
			couponToggle = '.xt_woofc-coupon',
			couponRemoveBtn = '.xt_woofc-remove-coupon',
			couponApplyBtn = '.xt_woofc-coupon-apply',
			couponForm = '.xt_woofc-coupon-form',
			paymentButtons = '.xt_woofc-payment-btns',
			cartNoticeTimeoutId,
			undoTimeoutId,
			lastRemovedKey,
			suggestedProductsSlider,
			winWidth,
			cartWidth,
			cartActive = false,
			cartIsEmpty = true,
			cartTransitioning = false,
			cartRefreshing = false,
			isReady = false,
			viewMode = 'desktop',
			totalsEnabled = $$(cartContainer).hasClass('xt_woofc-enable-totals'),
			couponsEnabled = $$(cartContainer).hasClass('xt_woofc-enable-coupon'),
			couponsListEnabled = $$(cartContainer).hasClass('xt_woofc-enable-coupon-list'),
			paymentButtonsEnabled = $$(cartContainer).hasClass('xt_woofc-custom-payments'),
			paymentButtonsObserver,
			modalMode = $$(cartContainer).hasClass('xt_woofc-modal'),
			ajaxInit = $$(cartContainer).attr('data-ajax-init') === '1',
			animationType = $$(cartContainer).attr('data-animation'),
			expressCheckout = $$(cartContainer).attr('data-express-checkout') === '1',
			triggerEvent = $$(cartContainer).attr('data-trigger-event'),
			hoverdelay = $$(cartContainer).attr('data-hoverdelay') ? $$(cartContainer).attr('data-hoverdelay') : 0,
			clickSelector = 'vclick',
			cartTriggers = [cartTrigger];

		function init() {

			if( !$$(cartContainer).length ) {
				return false;
			}

			initStorage();
			setTriggers();
			removeUnwantedAjaxRequests();
			initEvents();
			resizeCart();
			setTriggerDefaultText();
			refreshCartCountSize();
			removeUnwantedElements();
			refreshCartVisibility();
			initMutationObserver();
			initScrollObserver();

			if(ajaxInit || paymentButtonsEnabled) {

				refreshCart(function () {

					cartReady();
				});

			}else{

				cartReady();
			}
		}

		function flushCache() {

			$$('flush');

			totalsEnabled = $$(cartContainer).hasClass('xt_woofc-enable-totals');
			couponsEnabled = $$(cartContainer).hasClass('xt_woofc-enable-coupon');
			paymentButtonsEnabled = $$(cartContainer).hasClass('xt_woofc-custom-payments');
			animationType = $$(cartContainer).attr('data-animation');
			expressCheckout = $$(cartContainer).attr('data-express-checkout') === '1';
			triggerEvent = $$(cartContainer).attr('data-trigger-event');
			hoverdelay = $$(cartContainer).attr('data-hoverdelay') ? $$(cartContainer).attr('data-hoverdelay') : 0;
		}

		function initStorage() {

			try {
				$supports_html5_storage = ( 'sessionStorage' in window && window.sessionStorage !== null );
				window.sessionStorage.setItem( 'wc', 'test' );
				window.sessionStorage.removeItem( 'wc' );
				window.localStorage.setItem( 'wc', 'test' );
				window.localStorage.removeItem( 'wc' );
			} catch( err ) {
				$supports_html5_storage = false;
			}
		}

		function setTriggers() {

			if(XT_WOOFC.trigger_selectors.length) {
				XT_WOOFC.trigger_selectors.forEach(function(item) {

					if(item.selector !== '') {
						cartTriggers.push(item.selector);
					}
				});
			}
		}

		function removeUnwantedAjaxRequests() {

			// Remove unwanted ajax request (cart form submit) coming from native cart script.
			if(totalsEnabled || expressCheckout) {

				$.ajaxPrefilter(function (options, originalOptions, jqXHR) {
					if (originalOptions.url === '#woocommerce-cart-form') {
						jqXHR.abort();
					}
				});
			}

		}

		function initEvents() {

			// Make sure to burst the cache and refresh the cart after a browser back button event
			$(window).on('pageshow', function() {

				if(!isReady && !cartRefreshing) {
					refreshCart(function () {

						cartReady();
					});
				}
			});

			$(window).on('resize', function(){

				window.requestAnimationFrame(resizeCart);
			});

			$(document.body).on('xt_atc_adding_to_cart', function(){
				maybeShowCartNotice();
			});

			$(document.body).on('xt_atc_added_to_cart', function(evt, data, trigger){

				onRequestDone(data, 'add', function() {
					onAddedToCart(trigger);
				});
			});

			// Remove alerts on click
			$(document.body).on(clickSelector, '.xt_woofc .woocommerce-error, .xt_woofc .woocommerce-message', function() {

				$(this).slideUp("fast", function() {
					$(this).remove();
				});
			});

			$(document.body).on(clickSelector, cartNotice, function() {

				if($(this).find('a').length === 0) {
					hideCartNotice();
				}
			});

			// Update Cart List Obj
			$(document.body).on('wc_fragments_refreshed wc_fragments_loaded', function() {

				onFragmentsRefreshed();
			});

			//open/close cart

			cartTriggers.forEach(function(trigger) {

				$(document).on(clickSelector, trigger, function(evt){
					evt.preventDefault();
					toggleCart();
				});

				if($(trigger).hasClass('xt_woofc-trigger') && triggerEvent === 'mouseenter' && !XT.isTouchDevice()) {

					var mouseEnterTimer;
					$(trigger).on('mouseenter', function(evt){

						mouseEnterTimer = setTimeout(function () {

							if(!cartActive) {
								evt.preventDefault();
								toggleCart();
							}

						}, hoverdelay);

					}).on('mouseleave', function() {

						clearTimeout(mouseEnterTimer);
					});

				}
			});

			//close cart when clicking on the .xt_woofc::before (bg layer)
			$$(cartContainer).on(clickSelector, function(evt){
				if( $(evt.target).is($(this)) ) {
					toggleCart(false);
				}
			});

			//close cart when clicking on the header close icon
			$$(cartHeader).find('.xt_woofc-header-close').on(clickSelector, function(evt) {
				if( $(evt.target).is($(this)) ) {
					toggleCart(false);
				}
			});

			//delete an item from the cart
			$$(cartBody).on(clickSelector, '.xt_woofc-delete-item', function(evt){
				evt.preventDefault();

				var key = $(evt.target).parents('.xt_woofc-product').data('key');
				removeProduct(key);
			});

			//update item quantity

			$( document ).on('keyup', '.xt_woofc-quantity-row input', function(evt) {

				var $target = $(evt.currentTarget);
				updateQuantityInputWidth($target);
			});

			$( document ).on('change', '.xt_woofc-quantity-row input', function(evt) {

				evt.preventDefault();

				var $target = $(evt.currentTarget);

				var $parent = $target.parent();
				var min = parseFloat( $target.attr( 'min' ) );
				var max	= parseFloat( $target.attr( 'max' ) );

				if ( min && min > 0 && parseFloat( $target.val() ) < min ) {

					$target.val( min );
					setCartNotice(XT_WOOFC.lang.min_qty_required, 'error', $parent);
					return;

				}else if ( max && max > 0 && parseFloat( $target.val() ) > max ) {

					$target.val( max );
					setCartNotice(XT_WOOFC.lang.max_stock_reached, 'error', $parent);
					return;

				}

				var product = $target.closest('.xt_woofc-product');
				var qty = $target.val();
				var key = product.data('key');

				updateQuantityInputWidth($target);
				updateProduct(key, qty);
			});

			var quantityChangeTimeout;
			$( document ).on( clickSelector, '.xt_woofc-quantity-col-minus, .xt_woofc-quantity-col-plus', function(evt) {

				evt.preventDefault();

				if(quantityChangeTimeout) {
					clearTimeout(quantityChangeTimeout);
				}

				var $target = $(evt.currentTarget);

				// Get values

				var $parent 	= $target.closest( '.xt_woofc-quantity-row' ),
					$qty_input	= $parent.find( 'input' ),
					currentVal	= parseFloat( $qty_input.val() ),
					max			= parseFloat( $qty_input.attr( 'max' ) ),
					min			= parseFloat( $qty_input.attr( 'min' ) ),
					step		= $qty_input.attr( 'step' ),
					newQty		= currentVal;

				// Format values
				if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) {
					currentVal = 0;
				}
				if ( max === '' || max === 'NaN' ) {
					max = '';
				}
				if ( min === '' || min === 'NaN' ) {
					min = 0;
				}
				if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) {
					step = 1;
				}

				// Change the value
				if ( $target.is( '.xt_woofc-quantity-col-plus' ) ) {

					if ( max && ( max === currentVal || currentVal > max ) ) {
						setCartNotice(XT_WOOFC.lang.max_stock_reached, 'error', $parent);
						return;
					} else {
						newQty = ( currentVal + parseFloat( step ) );
					}

				} else {

					if ( min && ( min === currentVal || currentVal < min ) ) {
						setCartNotice(XT_WOOFC.lang.min_qty_required, 'error', $parent);
						return;
					} else if ( currentVal > 0 ) {
						newQty = ( currentVal - parseFloat( step ) );
					}

				}

				// Trigger change event

				var product = $qty_input.closest('.xt_woofc-product');
				var key = product.data('key');

				if(currentVal !== newQty) {

					$qty_input.val(newQty);

					// throttle update
					quantityChangeTimeout = setTimeout(function() {

						// Update product quantity
						updateProduct(key, newQty);

					}, 500);
				}
			});


			//reinsert item deleted from the cart
			$(document.body).on(clickSelector, '.xt_woofc-undo', function(evt){

				if(undoTimeoutId) {
					clearInterval(undoTimeoutId);
				}
				evt.preventDefault();

				hideCartNotice(null, true);
				showLoading(true);

				var timeout = 0;
				var key = lastRemovedKey;

				var product = $$(cartList).find('.xt_woofc-deleted');
				var lastProduct = product.last();

				var onAnimationEnd = function(el) {

					el.removeClass('xt_woofc-deleted xt_woofc-undo-deleted').removeAttr('style');
					refreshCartVisibility();
				};

				var onLastAnimationEnd = function() {

					setCartHeight();

					undoProductRemove(key, function() {
						$( document.body ).trigger( 'xt_woofc_undo_product_remove', [ key ] );
					});
				};

				$$(cartContainer).removeClass('xt_woofc-empty');

				animationEnd(lastProduct, true, onLastAnimationEnd);

				product.each(function(i) {

					var $this = $(this);

					animationEnd($this, true, onAnimationEnd);

					setTimeout(function() {

						$this.addClass('xt_woofc-undo-deleted');

					}, timeout);

					timeout = timeout + 270;

				});

				$$(cartList).find('.xt_woofc-deleting-last').removeClass('xt_woofc-deleting-last');

			});

			$(document).on('wc_update_cart', function (e) {

				refreshCart();
			});

			if(XT_WOOFC.can_use_premium_code) {

				$( document.body ).on('updated_cart_totals', function(e) {

					if($('form.woocommerce-shipping-calculator').length) {
						$('form.woocommerce-shipping-calculator').slideUp();
					}
				});

				if(expressCheckout || totalsEnabled) {

					$(document).on('updated_wc_div', function (e) {

						setTimeout(function() {
							hideLoading();
						}, 800)
					});

					$( document ).ajaxComplete(function( event, xhr, settings ) {

						if ( settings.url.search('/?wc-ajax=checkout') !== -1) {

							resetCheckoutButtonLabel();
						}
					});

					$(document).on('select2:open', '.xt_woofc-body .woocommerce-shipping-calculator #calc_shipping_country', function (e) {

						var $form = $(e.target).closest('form');

						$form.find('input:text, textarea').val('');
						$form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
					});

					$(document).on('select2:open', '.xt_woofc-body .select2-hidden-accessible', function (e) {

						$$(cartBody).css('overflow', 'hidden');
					});

					$(document).on('select2:select', '.xt_woofc-body .select2-hidden-accessible', function (e) {

						$$(cartBody).css('overflow', '');
						$$(cartBody).off('scroll.select2-' + e.target.id);
					});

					$(document).on('select2:close', '.xt_woofc-body .select2-hidden-accessible', function (e) {

						$$(cartBody).css('overflow', '');
						$$(cartBody).off('scroll.select2-' + e.target.id);
					});
				}

				$(document).on(clickSelector, cartCheckoutButton, function (e) {

					showProcessingCheckoutButtonLabel();
				});

				if(expressCheckout) {

					$(document.body).on('xt_atc_added_to_cart wc_fragments_refreshed', function(){
						$(document.body ).trigger('update_checkout');
					});

					$(document.body).on('update_checkout', function(){

						removeAllBodyNotices();
						showLoading();
					});

					$(document.body).on('checkout_error updated_checkout', function(){

						hideLoading();
						removeUnwantedElements();
						if(typeof(window.wc_securesubmit_params) === 'undefined') {
							scrollToAlert();
						}
					});

					$(document.body).on(clickSelector, 'a.showlogin', function(e) {

						var $this = $(e.target);

						setTimeout(function() {

							var $div = $$(cartBody).find('.woocommerce-form-login').first();

							if($div.length && $div.is(':visible')) {
								$$(cartBody).animate({scrollTop: ($$(cartBody).scrollTop() + $this.position().top) - 10}, 500);
							}
						}, 500);
					});

					if(XT_WOOFC.can_checkout) {

						$(document).on(clickSelector, cartCheckoutButton, function (e) {

							var checkoutForm = $$('.xt_woofc-checkout-form');

							if(checkoutForm.length) {

								showLoading();

								if(typeof(window.wc_securesubmit_params) !== 'undefined') {
									if(!window.wc_securesubmit_params.handler()) {
										setTimeout(function() {
											hideLoading();
											scrollToAlert();
											resetCheckoutButtonLabel();
										}, 500);
									}
								}else {
									checkoutForm.submit();
								}

								e.preventDefault();
							}
						});

					}
				}

				if(XT_WOOFC.cart_menu_enabled === "1" && XT_WOOFC.cart_menu_click_action === 'toggle') {
					$(document).on(clickSelector, cartMenuLink, function (event) {
						event.preventDefault();
						toggleCart();
					});
				}

				if(XT_WOOFC.cart_shortcode_enabled === "1" && XT_WOOFC.cart_shortcode_click_action === 'toggle') {
					$(document).on(clickSelector, cartShortcodeLink, function (event) {
						event.preventDefault();
						toggleCart();
					});
				}
			}

			$(document.body).on('xtfw_customizer_xt_woofc_changed', function(e, setting_id, setting_value) {

				var requireVarUpdate = {
					cart_autoheight_enabled: "cart_autoheight"
				};

				if(requireVarUpdate.hasOwnProperty(setting_id)) {

					var key = requireVarUpdate[setting_id];

					XT_WOOFC[key] = setting_value;
				}

				refreshCartVisibility();
				setCartHeight();
				resizeCart();
			});

			$(document.body).on('xtfw_customizer_saved', function() {
				cartRefreshing = false;
				refreshCart();
			});
		}

		function showLoading(hideContent) {

			hideContent = typeof(hideContent) !== 'undefined' ? hideContent : false;

			$$('html').addClass('xt_woofc-loading');
			if(hideContent) {
				$$('html').addClass('xt_woofc-loading-hide-content');
			}
		}

		function hideLoading() {
			$$('html').removeClass('xt_woofc-loading xt_woofc-loading-hide-content');
		}

		function enableBodyScroll($el) {

			bodyScrollLock.enableBodyScroll($el.get(0));
		}

		function disableBodyScroll($el) {

			bodyScrollLock.disableBodyScroll($el.get(0));
		}

		function digitsCount(n) {

			var count = 0;
			if (n >= 1) ++count;

			while (n / 10 >= 1) {
				n /= 10;
				++count;
			}
			return count;
		}

		function updateQuantityInputWidth(input) {

			var qty = $(input).val();
			var width = 25 * (digitsCount(qty) / 2) + 'px';
			$( input ).css('width', width);
		}

		function setCartHeight() {

			if(XT_WOOFC.can_use_premium_code === "1" && XT_WOOFC.cart_autoheight === "1") {

				if (cartActive && !cartTransitioning) {

					var listHeight = 0;

					$$(cartList).children().each(function () {
						if (!$(this).hasClass('xt_woofc-deleted')) {
							listHeight += $(this).outerHeight();
						}
					});

					$$(cartList).css({'min-height': listHeight + 'px'});

					var autoHeight = 0;

					autoHeight += $$(cartHeader).outerHeight(true);
					autoHeight += $$(cartBodyHeader).outerHeight(true);
					$$(cartListWrap).children().each(function () {
						autoHeight += $(this).outerHeight(true);
					});
					autoHeight += $$(cartBodyFooter).outerHeight(true);
					autoHeight += $$(cartCheckoutButton).outerHeight(true);
					autoHeight += getPaymentButtonsHeight();

					$$(cartInner).css('height', autoHeight + 'px');

				} else {

					$$(cartList).css('min-height', '');
				}

			}else{

				$$(cartInner).css('height', '');
			}
		}

		function getPaymentButtonsHeight() {

			var buttonsHeight = 0;

			if(paymentButtonsEnabled && !cartIsEmpty && $(paymentButtons).length && !$(paymentButtons).is(':empty') && cartActive && !cartTransitioning) {

				var padding = (parseInt($(':root').css('--xt-woofc-payment-btns-padding')) * 2);

				$(paymentButtons).find('.xt_woofc-payment-btn').each(function () {
					var $iframe = $(this).find('iframe');
					if ($iframe.length) {
						buttonsHeight += $iframe.height();
					}
				});

				buttonsHeight = buttonsHeight + padding;
			}

			return buttonsHeight;
		}

		function onAddedToCart(trigger) {

			var single = trigger.hasClass('single_add_to_cart_button');
			var single_variation = trigger.closest('.variations').length;

			if ($$(cartContainer).attr('data-flytocart') === '1' && !cartActive) {

				animateAddToCart(trigger, single);

			} else if (!single_variation) {

				animateCartShake();
			}
		}

		function resizeCart() {

			winWidth = $(window).width();
			cartWidth = $$(cartInner).width();

			if(winWidth <= XT_WOOFC.layouts.S) {

				$$(cartContainer).removeClass('xt_woofc-is-desktop xt_woofc-is-tablet');
				$$(cartContainer).addClass('xt_woofc-is-mobile');
				viewMode = 'mobile';

				if(XT_WOOFC.cart_menu_enabled === "1" && $$(cartMenu).length) {

					$$(cartMenu).removeClass('xt_woofc-is-desktop xt_woofc-is-tablet');
					$$(cartMenu).addClass('xt_woofc-is-mobile');
				}

			}else if(winWidth <= XT_WOOFC.layouts.M) {

				$$(cartContainer).removeClass('xt_woofc-is-desktop xt_woofc-is-mobile');
				$$(cartContainer).addClass('xt_woofc-is-tablet');
				viewMode = 'tablet';

				if(XT_WOOFC.cart_menu_enabled === "1"  && $$(cartMenu).length) {

					$$(cartMenu).removeClass('xt_woofc-is-desktop xt_woofc-is-mobile');
					$$(cartMenu).addClass('xt_woofc-is-tablet');
				}

			}else{

				$$(cartContainer).removeClass('xt_woofc-is-mobile xt_woofc-is-tablet');
				$$(cartContainer).addClass('xt_woofc-is-desktop');
				viewMode = 'desktop';

				if(XT_WOOFC.cart_menu_enabled === "1" && $$(cartMenu).length) {

					$$(cartMenu).removeClass('xt_woofc-is-mobile xt_woofc-is-tablet');
					$$(cartMenu).addClass('xt_woofc-is-desktop');
				}
			}

			if(cartWidth <= XT_WOOFC.layouts.XS) {

				$$(cartContainer).addClass('xt_woofc-narrow-cart xt-framework-notice-narrow');

			} else {

				$$(cartContainer).removeClass('xt_woofc-narrow-cart xt-framework-notice-narrow');
			}

			if(XT_WOOFC.can_use_premium_code && XT_WOOFC.sp_slider_enabled) {

				refreshSuggestedProductsSlider();
			}

			if(paymentButtonsEnabled) {
				initPaymentButtonsObserver();
			}

			setTimeout(function() {
				refreshCartVisibility(true);
			}, 10)
		}

		function initMutationObserver() {

			if(isReady) {
				return false;
			}

			$('body').mutated(function(changes, observer) {

				if(isReady) {
					return false;
				}

				changes.some(function(change) {

					return Array.prototype.slice.call(change.addedNodes).some(function(item) {

						if($(item).hasClass('add_to_cart_button') || $(item).hasClass('single_add_to_cart_button')) {

							flushCache();
							setTriggerDefaultText();

							return true;
						}

					});
				});
			});
		}

		function initScrollObserver() {

			var resize_observer = new ResizeObserver(function() {
				setCartHeight();
			});

			$$(cartBody).children().each(function(index, child) {
				resize_observer.observe(child);
			});
		}
		
		function initPaymentButtonsObserver() {

			if(cartIsEmpty || !cartActive) {
				return;
			}

			clearPaymentButtonsObserver();

			var height = 0;
			var previous_height = 0;
			var same_height_counter = 0;

			paymentButtonsObserver = setInterval(function() {

				if(same_height_counter > 10) {
					clearPaymentButtonsObserver();

					// + 2px from body height
					$$(cartWrapper).animate({paddingBottom: (height + 2)});

				}else {

					height = getPaymentButtonsHeight();

					if (height > 0 && height === previous_height) {
						same_height_counter++;
					} else {
						previous_height = height;
					}
				}

			}, 20);
		}

		function clearPaymentButtonsObserver() {

			if(paymentButtonsObserver) {
				clearInterval(paymentButtonsObserver);
			}
		}

		function setTriggerDefaultText() {

			if($$(singleAddToCartBtn).length > 0) {

				$$(singleAddToCartBtn).each(function() {

					$(this).data('defaultText', $(this).html().trim());

					if($(this).data('defaultText') !== '') {
						$(this).html(XT_WOOFC.lang.wait);
					}

					$(this).data('loading', true).addClass('loading');

				});
			}
		}

		function resetTriggerDefaultText() {

			$$(singleAddToCartBtn).each(function() {

				$(this).removeData('loading').removeClass('loading');

				if($(this).data('defaultText') !== '') {
					$(this).html($(this).data('defaultText'));
				}

			});
		}

		function transitionEnd(el, once, callback) {

			var events = 'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend';

			if(once) {

				el.one(events, function(evt) {

					$(this).off(events);

					evt.stopPropagation();
					callback($(this));
				});

			}else{

				el.on(events, function(evt) {

					evt.stopPropagation();
					callback($(this));
				});
			}
		}

		function animationEnd(el, once, callback) {

			var events = 'webkitAnimationEnd oanimationend oAnimationEnd msAnimationEnd animationend';

			if(once) {

				el.one(events, function(evt) {

					$(this).off(events);

					evt.stopPropagation();
					callback($(this));
				});

			}else{

				el.on(events, function(evt) {

					evt.stopPropagation();
					callback($(this));
				});
			}
		}

		function toggleCart(flag) {

			if(cartTransitioning) {
				return false;
			}

			var action;
			if( typeof (flag) !== 'undefined' ) {
				action = flag ? 'open' : 'close';
			}else{
				action = cartActive ? 'close' : 'open';
			}

			var $transitionElement = animationType === 'morph' ? $$(cartContainer) : $$(cartWrapper);

			transitionEnd($transitionElement, true, function () {

				cartTransitioning = false;

				if (cartActive) {

					$$(cartContainer).addClass('xt_woofc-cart-opened');
					$$(cartContainer).removeClass('xt_woofc-cart-closed');

					// needed for custom payment buttons
					$(document.body).trigger('wc_fragments_loaded');

					if(paymentButtonsEnabled) {
						initPaymentButtonsObserver();
					}


				} else {
					if(modalMode) {
						$$(cartWrapper).css('transition', 'none');
					}
					$$(cartContainer).removeClass('xt_woofc-cart-opened');
					$$(cartContainer).addClass('xt_woofc-cart-closed');
					if(modalMode) {
						setTimeout(function() {
							$$(cartWrapper).css('transition', '');
						}, 100)
					}

					if(paymentButtonsEnabled) {
						clearPaymentButtonsObserver();
					}
				}
				refreshCartVisibility();
				setCartHeight();

			});

			if( action === 'close' && cartActive) {

				cartTransitioning = true;
				cartActive = false;

				$$(cartContainer).removeClass('xt_woofc-cart-open');
				$$(cartContainer).addClass('xt_woofc-cart-close');

				if(XT_WOOFC.can_use_premium_code && XT_WOOFC.body_lock_scroll) {
					enableBodyScroll($$(cartBody));
				}

				resetUndo();
				resetCouponForm();
				hideCartNotice();

				setTimeout(function(){
					$$(cartBody).scrollTop(0);
					//check if cart empty to hide it
					refreshCartVisibility();

					if(XT_WOOFC.can_use_premium_code && XT_WOOFC.sp_slider_enabled) {
						destroySuggestedProductsSlider();
					}

				}, 500);

			} else if( action === 'open' && !cartActive) {

				cartTransitioning = true;
				cartActive = true;

				$$(cartContainer).removeClass('xt_woofc-cart-close');
				$$(cartContainer).addClass('xt_woofc-cart-open');

				if(XT_WOOFC.can_use_premium_code) {

					if(XT_WOOFC.body_lock_scroll) {
						disableBodyScroll($$(cartBody));
					}

					if(XT_WOOFC.sp_slider_enabled) {

						initSuggestedProductsSlider();
					}
				}

				setCartHeight();
				hideCartNotice();

			}

		}

		function getCartPosition(viewMode) {

			var position_key = viewMode !== 'desktop' ? 'data-'+viewMode+'-position' : 'data-position';

			return $$(cartContainer).attr(position_key);
		}

		function animateAddToCart(trigger, single) {

			var productsContainer = $('body');
			var position = getCartPosition(viewMode);

            var findImageFunction = single ? findSingleImage : findLoopImage;

			findImageFunction(trigger, function(item) {

                if(!item || item.length === 0) {

                    return;
                }

                var itemPosition = item.offset();
                var triggerPosition = $$(cartTrigger).offset();

                if(itemPosition.top === 0 && itemPosition.left === 0) {

                    var products = trigger.closest('.products');
                    var product = trigger.closest('.product');
                    var single_main_product = single && products.length === 0;

                    if(single_main_product && product.length) {
                        itemPosition = product.offset();
                    }else{
                        itemPosition = trigger.offset();
                        itemPosition.top = itemPosition.top - item.height();

                        if(single_main_product) {
                            itemPosition.left = itemPosition.left - item.width();
                        }
                    }
                }

                var defaultState = {
                    opacity: 1,
                    top: itemPosition.top,
                    left: itemPosition.left,
                    width: item.width(),
                    height: item.height(),
                    transform: 'scale(1)'
                };

                var top_dir = 0;
                var left_dir = 0;

                if(position === 'bottom-right') {

                    top_dir = -1;
                    left_dir = -1;

                }else if(position === 'bottom-left') {

                    top_dir = -1;
                    left_dir = 1;

                }else if(position === 'top-right') {

                    top_dir = 1;
                    left_dir = -1;

                }else if(position === 'top-left') {

                    top_dir = 1;
                    left_dir = 1;
                }

                var animationState = {
                    top: triggerPosition.top + ($$(cartTrigger).height() / 2) - (defaultState.height / 2) + (trigger.height() * top_dir),
                    left: triggerPosition.left + ($$(cartTrigger).width() / 2) - (defaultState.width / 2) + (trigger.width() * left_dir),
                    opacity: 0.9,
                    transform: 'scale(0.3)'
                };

                var inCartState = {
                    top: triggerPosition.top + ($$(cartTrigger).height() / 2) - (defaultState.height / 2),
                    left: triggerPosition.left + ($$(cartTrigger).width() / 2) - (defaultState.width / 2),
                    opacity: 0,
                    transform: 'scale(0)'
                };

                var duplicatedItem = item.clone();
                duplicatedItem.find('.add_to_cart_button').remove();
                duplicatedItem.css(defaultState);
                duplicatedItem.addClass('xt_woofc-fly-to-cart');

                duplicatedItem.appendTo(productsContainer);

                var flyAnimationDuration = $$(cartContainer).attr('data-flyduration') ? $$(cartContainer).attr('data-flyduration') : 650;
                flyAnimationDuration = (parseInt(flyAnimationDuration) / 1000);

				xt_gsap.to(duplicatedItem, flyAnimationDuration, { css: animationState, ease: Power3.easeOut, onComplete:function() {

                    animateCartShake();

					xt_gsap.to(duplicatedItem, (flyAnimationDuration * 0.8), { css: inCartState, ease: Power3.easeOut, onComplete: function() {

                        $(duplicatedItem).remove();
                    }});
                }});
			});
		}

		function animateCartShake() {

            if($$(cartContainer).attr('data-opencart-onadd') === '1') {

                toggleCart(true);

            }else{

                var shakeClass = $$(cartContainer).attr('data-shaketrigger');

                if(shakeClass !== '') {
                    $$(cartInner).addClass('xt_woofc-shake-'+shakeClass);

                    animationEnd($$(cartInner), true, function(_trigger) {

                        $$(cartInner).removeClass('xt_woofc-shake-'+shakeClass);
                    });
                }
			}
		}

		function findLoopImage(trigger, callback) {

			if(trigger.data('product_image_src')) {

				var imageData = {
					src: trigger.data('product_image_src'),
					width: trigger.data('product_image_width'),
					height: trigger.data('product_image_height')
				};

				createFlyToCartImage(imageData, function(img) {

                    callback(img);
                });

			}else{

			    callback(null);
			}
		}

		function findSingleImage(trigger, callback) {

			var imageData;
			var form = trigger.closest('form');
			var is_variable = form.hasClass('variations_form');

			if(is_variable) {

				var variation_id = parseInt(form.find('input[name=variation_id]').val());
				var variations = form.data('product_variations');
				var variation = variations ? variations.find(function(item) {
					return item.variation_id === variation_id;
				}) : null;

				if(variation && variation.image && variation.image.src !== '') {

					imageData = {
						src: variation.image.src,
						width: variation.image.src_w,
						height: variation.image.src_h
					};
				}
			}

			if(!imageData) {

				var fromElem = form.find('.xt_woofc-product-image');

				if (fromElem.data('product_image_src')) {

					imageData = {
						src: fromElem.data('product_image_src'),
						width: fromElem.data('product_image_width'),
						height: fromElem.data('product_image_height')
					};
				}
			}

			if(imageData) {

				createFlyToCartImage(imageData, function(img) {

                    callback(img);
				});

			}else{

                callback(null);
            }
		}

		function createFlyToCartImage(imageData, callback) {

			var item = $('<img>');
			item.attr('src', imageData.src);
			item.attr('width', imageData.width);
			item.attr('height', imageData.height);

			item.css({
				width: imageData.width + 'px',
				height: imageData.height + 'px'
			});

			item.on('load', function() {
                callback($(this));
			});

			item.on('error', function() {
                callback(null);
            });

		}

		function request(type, args, callback) {

			removeAllBodyNotices();
			resetCouponForm();
			showLoading();

			if(type !== 'remove' && type !== 'restore') {
				lastRemovedKey = null;
				hideCartNotice();
			}

			if(type === 'refresh' || type === 'totals') {

				refreshFragments(type, callback);
				return false;
			}

			args = $.extend(args, {type: type});

			$.XT_Ajax_Queue({

				url: get_url('xt_woofc_'+type),
				data: args,
				type: 'post'

			}).done(function(data) {

				if(type === 'restore') {
					$('.xt_woofc-notice').replaceWith(data.fragments['.xt_woofc-notice']);
					refreshFragments('totals', callback);
				}else{
					onRequestDone(data, type, callback);
				}
			});
		}

		function refreshFragments(type, callback) {

			$.XT_Ajax_Queue({
				url: get_url('get_refreshed_fragments'),
				data: {
					type: type
				},
				type: 'post'

			}).done(function(data) {

				onRequestDone(data, type, callback);
			});
		}

		function onRequestDone(data, type, callback) {

			$.each( data.fragments, function( key, value ) {

				$(key).replaceWith(value);
			});

			if ( $supports_html5_storage ) {

				sessionStorage.setItem(wc_cart_fragments_params.fragment_name, JSON.stringify(data.fragments));
				set_cart_hash(data.cart_hash);

				if (data.cart_hash) {
					set_cart_creation_timestamp();
				}
			}

			if (type !== 'add') {

				$(document.body).trigger('wc_fragments_refreshed');

			} else {

				onFragmentsRefreshed();
			}

			var loadingTimout = $$(cartContainer).attr('data-loadingtimeout') ? parseInt($$(cartContainer).attr('data-loadingtimeout')) : 0;

			setTimeout(function() {
				$('html').addClass('xt_woofc-stoploading');
				setTimeout(function() {
					hideLoading();
					$('html').removeClass('xt_woofc-stoploading');

					if(typeof(callback) !== 'undefined') {
						callback(data);
					}

				}, cartActive ? loadingTimout : 0);
			}, cartActive ? 100 : 0);

		}

		function onFragmentsRefreshed() {

			flushCache();
			removeUnwantedElements();
			resetCheckoutButtonLabel();
			refreshCartCountSize();
			maybeShowCartNotice();
			refreshCartVisibility();

			setTimeout(function() {
				setCartHeight();
			}, 100);


			if(XT_WOOFC.can_use_premium_code && XT_WOOFC.sp_slider_enabled) {

				initSuggestedProductsSlider();
			}
		}

		function updateProduct(key, qty, callback) {

			if(qty > 0) {

				request('update', {

					cart_item_key: key,
					cart_item_qty: qty

				}, function(data) {

					$( document.body ).trigger( 'xt_woofc_product_update', [ key, qty ] );

					if(typeof(callback) !== 'undefined') {
						callback(data);
					}

				});

			}else{
				removeProduct(key, callback);
			}
		}

		function removeProduct(key, callback) {

			showLoading(true);
			lastRemovedKey = key;

			request('remove', {

				cart_item_key: key

			}, function() {

				resetUndo();
				resetCouponForm();

				var timeout = 0;
				var product = $$(cartList).find('li[data-key="'+key+'"]');
				var isBundle = product.hasClass('xt_woofc-bundle');
				var isComposite = product.hasClass('xt_woofc-composite');
				var toRemove = [];
				var $prev;
				var $next;

				toRemove.push(product);

				if(isBundle || isComposite) {

					var selector = '';
					var group_id = product.data('key');

					if(isBundle) {
						selector = '.xt_woofc-bundled-item[data-group="'+group_id+'"]';
					}else{
						selector = '.xt_woofc-composite-item[data-group="'+group_id+'"]';
					}

					var groupedProducts = $($$(cartList).find(selector).get().reverse());

					groupedProducts.each(function() {
						toRemove.push($(this));
					});
				}

				toRemove.reverse().forEach(function($item) {

					setTimeout(function() {

						$prev = $item.prev();
						if($prev.length && $item.is(':last-of-type')) {
							$prev.addClass('xt_woofc-deleting-last');
						}

						$next = $item.next();
						if($next.length) {
							$next.css('--xt-woofc-list-prev-item-height', $item.outerHeight(true) + 'px');
						}

						$item.addClass('xt_woofc-deleted');

					}, timeout);

					timeout = timeout + 270;

				});

				setTimeout(function() {

					refreshCartVisibility();
					setCartHeight();

					$( document.body ).trigger( 'xt_woofc_product_removed', [ key ] );

					//wait 8sec before completely remove the item
					undoTimeoutId = setTimeout(function(){

						resetUndo();
						resetCouponForm();
						hideCartNotice();
						$$(cartList).find('.xt_woofc-deleting-last').removeClass('xt_woofc-deleting-last');

						if(typeof(callback) !== 'undefined') {
							callback();
						}

					}, 8000);

				}, timeout);
			});

		}

		function hideCartNotice(elemToShake, hideCouponToggle) {

			elemToShake = typeof(elemToShake) !== 'undefined' ? elemToShake : null;
			hideCouponToggle = typeof(hideCouponToggle) !== 'undefined' ? hideCouponToggle : false;

			if(couponsEnabled && !hideCouponToggle) {
				$$(couponToggle).addClass('xt_woofc-visible');
			}

			if(cartNoticeTimeoutId) {
				clearTimeout(cartNoticeTimeoutId);
			}

			if(elemToShake) {
				elemToShake.removeClass('xt_woofc-shake');
			}

			$$(cartNotice).removeClass('xt_woofc-visible xt_woofc-shake');

			transitionEnd($$(cartNotice), true, function() {
				$$(cartNotice).empty();
			});
		}

		function showCartNotice(elemToShake) {

			elemToShake = typeof(elemToShake) !== 'undefined' ? elemToShake : null;

			var timeout = elemToShake ? 100 : 0;

			if(couponsEnabled) {
				$$(couponToggle).removeClass('xt_woofc-visible');
			}

			$$(cartNotice).removeClass('xt_woofc-visible xt_woofc-shake');

			if(elemToShake) {

				elemToShake.addClass('xt_woofc-shake');
			}

			setTimeout(function() {

				$$(cartNotice).addClass('xt_woofc-visible');

				if(cartNoticeHasError()) {

					$$(cartNotice).addClass('xt_woofc-shake');

					if(elemToShake) {

						elemToShake.addClass('xt_woofc-shake');
					}
				}

				if(cartNoticeTimeoutId) {
					clearTimeout(cartNoticeTimeoutId);
				}

				if($$(cartNotice).find('a').length === 0) {
					cartNoticeTimeoutId = setTimeout(function () {
						hideCartNotice();
					}, 6000);
				}

			}, timeout);
		}

		function maybeShowCartNotice() {

			if($$(cartNotice).html().trim() !== '') {
				showCartNotice();
			}
		}

		function cartNoticeHasError() {

			return $$(cartNotice).data('type') === 'error';
		}

		function setCartNotice(notice, type, elemToShake) {

			type = typeof(type) !== 'undefined' && type ? type : 'success';
			elemToShake = typeof(elemToShake) !== 'undefined' ? elemToShake : null;

			$$(cartNotice).removeClass (function (index, className) {
				return (className.match (/(^|\s)xt_woofc-notice-\S+/g) || []).join(' ');
			});

			$$(cartNotice).data('type', type).addClass('xt_woofc-notice-'+type).html(notice);

			showCartNotice(elemToShake);
		}

		function resetCouponForm() {

			if(couponsEnabled) {
				wc_checkout_coupons.close_coupon_form();
			}
		}

		function resetUndo() {

			if(undoTimeoutId) {
				clearInterval(undoTimeoutId);
			}

			$$(cartList).find('.xt_woofc-deleted').remove();
		}

		function undoProductRemove(key, callback) {

			request('restore', {

				cart_item_key: key,

			}, callback);
		}

		function refreshCart(callback) {

			if(!cartRefreshing) {

				cartRefreshing = true;
				request('refresh', {}, function() {

					cartRefreshing = false;

					if(typeof(callback) !== 'undefined') {
						callback();
					}
				});
			}
		}

		function refreshCartVisibility(noAnimations) {

			noAnimations = typeof(noAnimations) !== 'undefined' ? noAnimations : false;

			if( $$(cartList).find('li:not(.xt_woofc-deleted):not(.xt_woofc-no-product)').length === 0) {
				$$(cartContainer).addClass('xt_woofc-empty');
				cartIsEmpty = true;
			}else{
				$$(cartContainer).removeClass('xt_woofc-empty');
				cartIsEmpty = false;
			}

			if(XT_WOOFC.cart_menu_enabled === "1" && $$(cartMenu).length) {

				if(cartIsEmpty) {
					$$(cartMenu).addClass('xt_woofc-menu-empty');
				}else{
					$$(cartMenu).removeClass('xt_woofc-menu-empty');
				}
			}

		}

		function refreshCartCountSize() {

			var quantity = Number($$(cartCount).find('li').eq(0).text());

			if(quantity > 999) {

				$$(cartCount).removeClass('xt_woofc-count-big');
				$$(cartCount).addClass('xt_woofc-count-bigger');

				if($$(cartMenuCountBadge).length) {
					$$(cartMenuLink).removeClass('xt_woofc-count-big');
					$$(cartMenuLink).addClass('xt_woofc-count-bigger');
				}

			}else if(quantity > 99) {

				$$(cartCount).removeClass('xt_woofc-count-bigger');
				$$(cartCount).addClass('xt_woofc-count-big');

				if($$(cartMenuCountBadge).length) {
					$$(cartMenuLink).removeClass('xt_woofc-count-bigger');
					$$(cartMenuLink).addClass('xt_woofc-count-big');
				}

			}else{
				$$(cartCount).removeClass('xt_woofc-count-big');
				$$(cartCount).removeClass('xt_woofc-count-bigger');

				if($$(cartMenuCountBadge).length) {
					$$(cartMenuLink).removeClass('xt_woofc-count-big');
					$$(cartMenuLink).removeClass('xt_woofc-count-bigger');
				}
			}
		}

		/* Cart session creation time to base expiration on */
		function set_cart_creation_timestamp() {
			if ( $supports_html5_storage ) {
				sessionStorage.setItem( 'wc_cart_created', ( new Date() ).getTime() );
			}
		}

		/** Set the cart hash in both session and local storage */
		function set_cart_hash( cart_hash ) {
			if ( $supports_html5_storage ) {
				localStorage.setItem( cart_hash_key, cart_hash );
				sessionStorage.setItem( cart_hash_key, cart_hash );
			}
		}

		function removeUnwantedElements() {

			if($$(cartBody).find('.woocommerce-cart-form').length > 1) {
				$$(cartBody).find('.woocommerce-cart-form').each(function(i) {
					if(i > 0) {
						$(this).remove();
					}
				});
				$$(cartBody).find('.woocommerce-cart-form').empty();
			}

			if($$(cartBody).find('.woocommerce-notices-wrapper').length) {
				$$(cartBody).find('.woocommerce-notices-wrapper').remove();
			}

			if($$(cartBody).find('.woocommerce-form-coupon,.woocommerce-form-coupon-toggle').length) {
				$$(cartBody).find('.woocommerce-form-coupon,.woocommerce-form-coupon-toggle').remove();
			}

			if(totalsEnabled && !expressCheckout && $$(cartBody).find('.angelleye-proceed-to-checkout-button-separator').length) {

				setTimeout(function() {
					$$(cartBody).find('.angelleye-proceed-to-checkout-button-separator').insertAfter($$(cartBody).find('.angelleye_smart_button_bottom'));
				},100);
			}
		}

		function initSuggestedProductsSlider(){

			destroySuggestedProductsSlider();

			suggestedProductsSlider = $('.xt_woofc-sp-products').lightSlider({
				item: 1,
				enableDrag: false,
				adaptiveHeight: true,
				controls: (XT_WOOFC.sp_slider_enabled === "1"),
				prevHtml: '<span class="xt_woofc-sp-arrow-icon '+XT_WOOFC.sp_slider_arrow+'"></span>',
				nextHtml: '<span class="xt_woofc-sp-arrow-icon '+XT_WOOFC.sp_slider_arrow+'"></span>',
				onSliderLoad: function() {

					setTimeout(function() {
						$(window).trigger('resize');
						setTimeout(function() {
							$('.xt_woofc-sp').css('opacity', 1);
						}, 300);
					}, 200);
				}
			});
		}

		function destroySuggestedProductsSlider() {

			if(suggestedProductsSlider && typeof(suggestedProductsSlider.destroy) !== 'undefined') {
				$('.xt_woofc-sp').css('opacity', 0);
				suggestedProductsSlider.destroy();
			}
		}

		function refreshSuggestedProductsSlider() {

			if(suggestedProductsSlider && typeof(suggestedProductsSlider.refresh) !== 'undefined') {
				suggestedProductsSlider.refresh();
			}
		}

		function scrollToAlert() {

			setTimeout(function() {

				var $alert = $$(cartBodyFooter).find('.woocommerce-error, .woocommerce-message').first();

				if($alert.length) {
					$$(cartBody).scrollTop(0);
					var top = ($alert.offset().top - $$(cartBody).offset().top) - 10;
					$$(cartBody).animate({scrollTop: top}, 500);
				}

			},500)
		}

		function scrollToBottom() {

			setTimeout(function() {
				$$(cartBody).animate({scrollTop: $$(cartBody).get(0).scrollHeight}, 500);
			}, 100)
		}

		function removeAllBodyNotices() {

			var $notices = $$(cartBodyFooter).find('.woocommerce-error, .woocommerce-message');
			if($notices.length) {
				$notices.each(function() {
					$(this).slideUp("fast", function() {
						$(this).remove();
					});
				});
			}
		}

		function showProcessingCheckoutButtonLabel() {

			if($$(cartCheckoutButton).hasClass('xt_woofc-processing')) {
				return false;
			}

			$$(cartCheckoutButton).addClass('xt_woofc-processing');

			var processing_text = $$(cartCheckoutButton).data('processing-text');
			$$(cartCheckoutButton).find('.xt_woofc-footer-label').text(processing_text);
		}

		function resetCheckoutButtonLabel() {

			var text = $$(cartCheckoutButton).data('text');
			$$(cartCheckoutButton).find('.xt_woofc-footer-label').text(text);

			$$(cartCheckoutButton).removeClass('xt_woofc-processing');
		}

		function cartReady() {

			resetTriggerDefaultText();
			resetCheckoutButtonLabel();

			$('body').addClass('xt_woofc-ready');

			$(window).trigger('resize');
			$(document).trigger('xt_woofc_ready');

			isReady = true;
		}

		function get_url( endpoint ) {
			return XT_WOOFC.wc_ajax_url.toString().replace(
				'%%endpoint%%',
				endpoint
			);
		}

		function updateCartTitle(title) {

			$$('.xt_woofc-title').fadeOut("fast", function() {
				$(this).html(title).fadeIn("fast");
			});
		}

		if(XT_WOOFC.can_use_premium_code && couponsEnabled) {

			var wc_checkout_coupons = {
				init: function () {

					$(document.body).on(clickSelector, couponToggle+', .xt_woofc-close-coupon-form', this.show_coupon_form);
					$(document.body).on(clickSelector, couponRemoveBtn, this.remove_coupon);
					$(document.body).on(clickSelector, couponApplyBtn, this.apply_coupon);

					this.close_coupon_form(true);

					$$(couponForm).on('submit', this.submit);
				},
				show_coupon_form: function (e) {
					e.preventDefault();

					$$(cartBody).animate({
						scrollTop: 0
					}, 'fast');

					if( $$(couponForm).is(':visible')) {
						wc_checkout_coupons.close_coupon_form();
					}else {

						if(couponsListEnabled) {

							disableBodyScroll($$(couponForm));

							$$(cartWrapper).addClass('xt_woofc-coupons-visible');
							var svg = '<a href="#" class="xt_woofc-close-coupon-form"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve" style="display: inline-block;transform: rotate(180deg);margin-right: 8px;height: 40px;vertical-align: top;width: 20px;"><line fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="3" y1="12" x2="21" y2="12"></line><polyline fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="15,6 21,12 15,18 "></polyline></svg></a>';
							updateCartTitle(svg + XT_WOOFC.lang.coupons);
						}

						$$(couponForm).slideDown(350, function () {
							$$(couponForm).find(':input:eq(0)').focus();
						});
					}
				},
				close_coupon_form: function (fast) {

					if( $$(couponForm).is(':visible')) {

						fast = typeof(fast) !== 'undefined' ? true : false;
						if(fast) {
							$$(couponForm).hide();
						}else {
							$$(couponForm).slideUp();
						}

						hideCartNotice();

						if($$(couponForm).find('.xt_woofc-coupon-error').length) {
							$$(couponForm).find('.xt_woofc-coupon-error').empty().removeClass('xt_woofc-shake');
						}

						if(couponsListEnabled) {

							enableBodyScroll($$(couponForm));

							$$(cartWrapper).removeClass('xt_woofc-coupons-visible');
							updateCartTitle(XT_WOOFC.lang.title);
						}
					}
				},
				submit: function (e) {

					e.preventDefault();

					var $form = $(this);

					if ($form.is('.processing')) {
						return false;
					}

					$form.addClass( 'processing' );

					showLoading();

					var data = {
						coupon_code: $form.find('input[name="coupon_code"]').val()
					};

					$.XT_Ajax_Queue({
						url: get_url('xt_woofc_apply_coupon'),
						data: data,
						type: 'post'

					}).done(function(response) {

						$form.removeClass( 'processing' );

						setTimeout(function () {

							onRequestDone(response, 'apply_coupon');
							hideLoading();

							if(!cartNoticeHasError()) {

								$(document.body).trigger('coupon_applied');
							}

						}, 5);

					});

					return false;
				},
				apply_coupon: function(e) {

					e.preventDefault();

					var coupon = $(this).data('coupon');

					$$(couponForm).find('input[name="coupon_code"]').val(coupon);
					$(couponForm).trigger('submit');
				},
				remove_coupon: function (e) {

					e.preventDefault();

					var coupon = $(this).data('coupon');
					var container = $(this).closest('.xt_woofc-cart-totals');

					if (container.is('.processing')) {
						return false;
					}

					container.addClass( 'processing' );

					showLoading();

					var data = {
						coupon: coupon
					};

					$.XT_Ajax_Queue({
						url: get_url('xt_woofc_remove_coupon'),
						data: data,
						type: 'post'

					}).done(function(response) {

						container.removeClass( 'processing' );

						onRequestDone(response, 'remove_coupon');
						$(document.body).trigger('coupon_removed');

						// Remove coupon code from coupon field
						$('form.xt_woofc-coupon-form').find('input[name="coupon_code"]').val('');

						hideLoading();

					});

				}
			};

			wc_checkout_coupons.init();

		}

		if(XT_WOOFC.can_use_premium_code && (totalsEnabled || expressCheckout)) {

			/**
			 * Object to handle AJAX calls for cart shipping changes.
			 */
			var cart_shipping = {

				/**
				 * Initialize event handlers and UI state.
				 */
				init: function (cart) {
					this.cart = cart;
					this.toggle_shipping = this.toggle_shipping.bind(this);
					this.shipping_method_selected = this.shipping_method_selected.bind(this);
					this.shipping_calculator_submit = this.shipping_calculator_submit.bind(this);

					$(document).off(clickSelector, '.shipping-calculator-button');
					$(document).on(clickSelector,'.xt_woofc .shipping-calculator-button', this.toggle_shipping);

					$(document).off(clickSelector, 'select.shipping_method, :input[name^=shipping_method]');
					$(document).on('change', '.xt_woofc select.shipping_method, .xt_woofc :input[name^=shipping_method]', this.shipping_method_selected);

					$(document).off('submit', 'form.woocommerce-shipping-calculator');
					$(document).on('submit', '.xt_woofc form.woocommerce-shipping-calculator', this.shipping_calculator_submit);

					$$(cartBody).find('.shipping-calculator-form').hide();
				},

				/**
				 * Toggle Shipping Calculator panel
				 */
				toggle_shipping: function () {

					if(expressCheckout) {

						var use_shipping_address = $$(cartBody).find('#ship-to-different-address-checkbox').is(':checked');
						var $div = use_shipping_address ? $$(cartBody).find('.woocommerce-shipping-fields').first() : $$(cartBody).find('.woocommerce-billing-fields').first();

						if ($div.length) {
							$$(cartBody).animate({scrollTop: ($$(cartBody).scrollTop() + $div.position().top) - 10}, 500);
						}

					}else {

						$$(cartBody).find('.shipping-calculator-form').slideToggle('medium', function () {
							scrollToBottom();
						});
					}

					$(document.body).trigger('country_to_state_changed'); // Trigger select2 to load.
				},

				/**
				 * Handles when a shipping method is selected.
				 */
				shipping_method_selected: function () {

					var self = this;
					var shipping_methods = {};

					$$(cartBody).find('select.shipping_method, :input[name^=shipping_method][type=radio]:checked, :input[name^=shipping_method][type=hidden]').each(function () {
						shipping_methods[$(this).data('index')] = $(this).val();
					});

					showLoading();

					var data = {
						shipping_method: shipping_methods
					};

					$.ajax({
						type: 'post',
						url: get_url('xt_woofc_update_shipping_method'),
						data: data,
						dataType: 'json'
					}).done(function (response) {
						self.update_cart_totals_div(response);
						onRequestDone(response, 'update_shipping_method');
					}).always(function () {
						hideLoading();
						$(document.body).trigger('updated_shipping_method');
					});
				},

				/**
				 * Handles a shipping calculator form submit.
				 *
				 * @param {Object} evt The JQuery event.
				 */
				shipping_calculator_submit: function (evt) {
					evt.preventDefault();

					var self = this;
					var $form = $(evt.currentTarget);

					showLoading();

					// Provide the submit button value because wc-form-handler expects it.
					$('<input />').attr('type', 'hidden')
						.attr('name', 'calc_shipping')
						.attr('value', 'x')
						.appendTo($form);

					// Make call to actual form post URL.
					$.ajax({
						type: $form.attr('method'),
						url: $form.attr('action'),
						data: $form.serialize(),
						dataType: 'html'
					}).done(function(response) {
						if(self.update_wc_div(response)) {
							self.toggle_shipping();
							scrollToBottom();
						}
					}).always(function() {
						hideLoading();
					});
				},

				/**
				 * Update the .woocommerce div with a string of html.
				 *
				 * @param {String} html_str The HTML string with which to replace the div.
				 * @param {bool} preserve_notices Should notices be kept? False by default.
				 */
				update_wc_div: function( html_str, preserve_notices ) {

					var $html       = $.parseHTML( html_str );
					var $notices = $( '.woocommerce-error', $html);
					$notices = $.merge($notices, $( '.woocommerce-message, .woocommerce-info', $html));
					var $firstNotice = $notices.first();
					var firstNoticeType = $firstNotice && $firstNotice.hasClass('woocommerce-error') ? 'error' : null;

					// Remove errors
					if (!preserve_notices) {
						$('.woocommerce-error, .woocommerce-message, .woocommerce-info').remove();
					}

					// Display errors
					if ($notices.length > 0 && $$(wooNotices).length) {
						$$(wooNotices).prepend($notices);
						setCartNotice($firstNotice.text(), firstNoticeType);
					}

					if(firstNoticeType !== 'error') {

						showLoading();

						// If the checkout is also displayed on this page, trigger update event.
						if ($('.woocommerce-checkout').length) {
							$(document.body).trigger('update_checkout');
						}

						$( document.body ).trigger( 'updated_wc_div' );

						return true;
					}

					return false;
				},

				/**
				 * Update the .cart_totals div with a string of html.
				 *
				 * @param {String} html_str The HTML string with which to replace the div.
				 */
				update_cart_totals_div: function( html_str ) {
					$( '.cart_totals' ).replaceWith( html_str );
					$( document.body ).trigger( 'updated_cart_totals' );
				}

			};

			cart_shipping.init();
		}

		$(function() {

			init();
		});

		window.xt_woofc_refresh_cart = refreshCart;
		window.xt_woofc_toggle_cart = toggleCart;
		window.xt_woofc_open_cart = function() {
			toggleCart(true);
		};
		window.xt_woofc_close_cart = function() {
			toggleCart(false);
		};
		window.xt_woofc_is_cart_open = function() {
			return cartActive;
		};
		window.xt_woofc_is_cart_empty = function() {
			return cartIsEmpty;
		};
		window.xt_woofc_refresh_visibility = refreshCartVisibility;
	});

})( jQuery, window );
