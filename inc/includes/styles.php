<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
//custom styles
add_action( 'wp_enqueue_scripts', 'utouch_custom_css_styles', 99 );

//custom styles
add_action( 'wp_enqueue_scripts', '_utouch_custom_font', 99 );

function _utouch_generate_font_styles( $tag ) {
	$font        = fw_get_db_customizer_option( 'typography_' . $tag, array() );
	$font_family = utouch_akg( 'family', $font, 'Default' );
	$font_color  = utouch_akg( 'color', $font, '' );

	if ( $tag === 'logo' ) {
		$font_css = '.site-logo .logo-title{';
	} else if ( $tag === 'nav' ) {
		$font_css = '.primary-menu-menu > li > a{';
	} else if ( $tag === 'body' ) {
		$font_css = 'body, article p{';
	} else {
		$font_css = $tag . ', .' . $tag . '{';
	}
	if ( ! empty( $font_family ) && 'Default' !== $font_family ) {
		$font_css .= 'font-family:"' . $font_family . '", sans-serif;';
		$variant = utouch_akg( 'variation', $font, '' );
		if ( $variant ) {
			if ( substr_count( $variant, 'italic' ) > 0 ) {
				$font_css .= 'font-style:italic;';
				$variant = str_replace( 'italic', '', $variant );
			}
			$font_css .= 'font-weight:' . $variant . ';';
		} elseif ( false === $font['google_font'] ) {
			$font_css .= 'font-style:' . $font['style'] . ';';
			$font_css .= 'font-weight:' . $font['weight'] . ';';
		}
	}

	if ( ! empty( $font_color ) ) {
		$font_css .= 'color:' . $font_color . ';';
	}

	$letter_spacing = utouch_akg( 'letter-spacing', $font, '' );
	if ( ! empty( $letter_spacing ) ) {
		$font_css .= 'letter-spacing:' . $letter_spacing . 'px;';
	}
	$size = utouch_akg( 'size', $font, '' );
	if ( ! empty( $size ) ) {
		$font_css .= 'font-size:' . $size . 'px;';
	}
	$font_css .= '} ';

	return $font_css;
}


function _utouch_custom_font() {
	$custom_css = '';

	if ( function_exists( 'fw_get_db_settings_option' ) ) {
		$custom_css .= _utouch_generate_font_styles( 'body' );
		$custom_css .= _utouch_generate_font_styles( 'nav' );
		$custom_css .= _utouch_generate_font_styles( 'logo' );
		$custom_css .= _utouch_generate_font_styles( 'h1' );
		$custom_css .= _utouch_generate_font_styles( 'h2' );
		$custom_css .= _utouch_generate_font_styles( 'h3' );
		$custom_css .= _utouch_generate_font_styles( 'h4' );
		$custom_css .= _utouch_generate_font_styles( 'h5' );
		$custom_css .= _utouch_generate_font_styles( 'h6' );
	}
	wp_add_inline_style( 'utouch-theme-style', $custom_css );
}


function utouch_custom_css_styles() {
	if ( function_exists( 'fw_get_db_customizer_option' ) ) {
		$custom_css      = '';
		$primary_color   = fw_get_db_customizer_option( 'primary_color', '#0083ff' );
		$secondary_color = fw_get_db_customizer_option( 'secondary_color', '#9db5d4' );

		if ( ! empty( $primary_color ) && '#0083ff' !== $primary_color ) {
			$custom_css .= '.nice-select .option:hover, input:focus, textarea:focus, select:focus, .nice-select:focus, .items-with-border input:focus, .items-with-border textarea:focus, .items-with-border select:focus,
.items-with-border .nice-select:focus,
.c-primary,
.btn--primary.btn-border,
.btn-prev .utouch-icon, .btn-next .utouch-icon,
.btn-prev.btn--style:hover,
.btn-next.btn--style:hover,
.info-box--standard .utouch-icon,
.info-box--standard-hover:hover .info-box-title,
.info-box--numbers .order-number,
.crumina-testimonial-item .author-name,
.testimonial-item-quote-right .author-name:hover,
.pricing-tables--item-with-thumb:hover .pricing-title,
.crumina-teammembers-item .teammembers-item-name:hover,
.accordion-panel.active .ovh,
.post:hover .post__title,
.post-additional-info a:hover,
.tags-inline li a:hover,
.page-numbers.current,
.page-numbers.current:hover,
.event-item .author-name,
.btn-next-wrap:hover .btn-content-subtitle,
.btn-prev-wrap:hover .btn-content-subtitle,
.comments__article .comments__header .comments__author a:hover,
.list-events a,
.list-events div,
.reviews-item-name,
.curriculum-list li:hover .title,
.tgl--text-both input[type="checkbox"]:not(:checked) + span::before,
.timer,
.list--primary i, .list--primary .utouch-icon,
.list--primary a:hover,
blockquote h6 span,
.first-letter--primary span:first-of-type,
.header--dark .logo-sub-title,
.primary-menu-menu > li:hover > a,
.primary-menu-menu > li:hover,
.primary-menu-menu > li.current-menu-item > a,
.primary-menu-menu > li.current-menu-item,
.primary-menu-menu ul.sub-menu li:hover > a,
.primary-menu-menu > li.menu-item-has-mega-menu .megamenu ul > li:hover > a,
.primary-menu-menu > li:hover > a .indicator, .primary-menu-menu > li:hover .indicator,
.more-arrow:hover,
.primary-menu--dark .primary-menu-menu > li.menu-item-has-mega-menu .megamenu ul > li a:hover,
.primary-menu--dark .primary-menu-menu ul.sub-menu li a:hover,
.breadcrumbs-item a:hover,
.breadcrumbs-item.active span,
.breadcrumbs--bordered .breadcrumbs-item a,
.top-bar .nice-select,
.top-bar a:hover,
.sub-footer a:hover,
.sub-footer .sub-footer__link,
.w-info .logo-title,
.w-info .learn-more:hover,
.w-list .list li:hover a,
.w-follow .utouch-icon:hover,
.w-contacts a.info:hover,
.contact-item .utouch-icon,
.location-details a:hover,
.w-category .category-list li:hover a,
.widget_categories a:hover,
.tab-control.active a,
.widget_recent_entries li:hover > a,
.recentcomments a:hover,
.widget_pages a:hover,
.widget_nav_menu a:hover,
.widget_tag_cloud a:hover,
.breadcrumbs--bordered .breadcrumbs-item:not(.active),
.breadcrumbs--rounded .breadcrumbs-item.active,
#site-footer a:not(.btn):not(.sub-footer__link):hover,
#site-footer li:hover a:not(.btn):not(.sub-footer__link),
#site-footer a:not(.btn):hover,
#site-footer li.menu-item-has-children .menu-item:hover > a:not(.btn),
#site-footer li.menu-item-has-children .menu-item:hover > .utouch-icon,
#site-footer li:hover a:not(.btn),
.w-list .list li a:hover,
.widget_nav_menu .list li a:hover,
.w-list .list li li.menu-item-has-children .menu-item:hover > a,
.widget_nav_menu .list li li.menu-item-has-children .menu-item:hover > a,
#site-footer .sub-footer a:not(.btn),
ul.nav-add li.cart:hover .seoicon-basket {
  color: ' . esc_attr( $primary_color ) . ';
}
';

			$custom_css .= '.with-icon input:focus + .utouch-icon,
.with-icon textarea:focus + .utouch-icon,
.with-icon select:focus + .utouch-icon,
.c-primary,
.btn--primary.btn-border,
.btn-prev .utouch-icon, .btn-next .utouch-icon,
.btn-prev.btn--style:hover .utouch-icon,
.btn-next.btn--style:hover .utouch-icon,
.info-box--standard .utouch-icon,
.info-box--time-line .time-line-arrow,
.time-line-arrow,
.socials .utouch-icon:hover,
.crumina-accordion .panel-heading.active .accordion-heading i.active,
.crumina-accordion .panel-heading.active .accordion-heading .utouch-icon.active,
.list-post:hover .utouch-icon,
.course-features-list .utouch-icon,
.lection .utouch-icon,
.popup-close .utouch-icon:hover,
.typeahead__container input:focus + .typeahead__button .utouch-icon,
.search-full-screen .search-standard input[type="search"]:focus + .form-icon .utouch-icon,
.list--primary i, .list--primary .utouch-icon,
.list--primary a:hover,
.nav-add li.search:hover .utouch-icon,
.more-arrow:hover .btn-next .utouch-icon,
.top-bar-close .utouch-icon:hover,
.top-bar-link:hover .utouch-icon,
.w-follow .utouch-icon:hover,
.contact-item .utouch-icon,
#site-footer a:not(.btn):not(.sub-footer__link):hover,
#site-footer a.social__item:hover svg,
#site-footer li:hover a:not(.btn):not(.sub-footer__link),
#site-footer a.social__item:hover svg,
.w-list .list li li.menu-item-has-children .menu-item:hover > .utouch-icon,
.widget_nav_menu .list li li.menu-item-has-children .menu-item:hover > .utouch-icon {
  fill: ' . esc_attr( $primary_color ) . ';
}';

			$custom_css .= '
.alert-info,
.btn--primary,
.back-to-top,
.slides-item,
.slider-slides--vertical-line .slides-item.slide-active .round.primary,
.slider-slides--vertical-line .round.primary:before,
.btn-prev.with-bg, .btn-next.with-bg,
.btn-prev.with-bg.bg-black:hover, .btn-next.with-bg.bg-black:hover,
.swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,
.swiper-pagination.pagination-white .swiper-pagination-bullet.swiper-pagination-bullet-active,
.page-numbers:hover,
.page-links a:hover,
.comments__article .comments__body .reply:hover,
.tabs-with-line .tab-control.active a::after,
.curriculum-list li:before,
.cat-list-bg-style .cat-list__item a:hover,
.cat-list-bg-style .cat-list__item.active,
.tgl input[type="checkbox"]:not(:checked) + span,
.first-letter--squared span:first-of-type,
.bg-primary-color,
.primary-menu-menu ul.sub-menu li:hover:before,
.primary-menu-menu > li.menu-item-has-mega-menu .megamenu ul > li:hover:before,
.primary-menu--dark .primary-menu-menu ul.sub-menu li:hover:before,
.primary-menu--dark .primary-menu-menu > li.menu-item-has-mega-menu .megamenu ul > li:hover:before,
.w-category .category-list li:hover a:before,
.w-category .category-list li:hover .cat-count,
.w-tags a:hover,
.tab-control a:after,
.btn--primary,
ul.nav-add .cart-count,
.woocommerce .product-item a.added_to_cart,
.cart-main .actions .coupon .btn-medium.btn--primary,
.woocommerce .checkout_coupon.coupon input.btn--primary,
.woocommerce-checkout-review-order-table .cart_item.total {

  background-color: ' . esc_attr( $primary_color ) . ';
}';

			$custom_css .= '
.btn--primary.btn-border,
.pricing-tables--item-with-thumb:hover,
.accordion-panel.active,
.typeahead__container input:focus,
.search-full-screen .search-standard input[type="search"]:focus,
.w-tags a:hover {

  border-color: ' . esc_attr( $primary_color ) . ';
}';
			$custom_css .= '
.primary-menu-menu ul.sub-menu,
.primary-menu-menu ul.sub-menu li ul.sub-menu,
.primary-menu-menu > li > .megamenu  {
  border-top-color: ' . esc_attr( $primary_color ) . ';
}';

			$custom_css .= '
.choose-item.bg-primary-color:after {
  border-left-color: ' . esc_attr( $primary_color ) . ';
}';

			$custom_css .= '
.choose-item.bg-primary-color::after {
  border-right-color: ' . esc_attr( $primary_color ) . ';
}';

		}
		if ( ! empty( $secondary_color ) && '#9db5d4' !== $secondary_color ) {
			$custom_css .= '
input, textarea, select, .nice-select,
.c-secondary,
.counter-item-colored .counter-title,
.position-item,
.pricing-tables-item-solid:hover .rate,
.pricing-tables-item-solid:hover .period,
.crumina-case-item.bg-light .case-item-content .title,
.accordion-heading .title,
.post__date .month,
.post-additional-info a,
.post-standard-details:hover .post__title,
.tags-inline li:first-child,
.blog-details-author .author-name,
.comments__article .comments__header .comments__author,
.comments__author-review,
.comments__author-review a,
.submit-block .submit-block-text,
.skills-item-title,
.course-features-list .feature-item,
.search--white .typeahead__container input:focus,
.search--white .search-full-screen .search-standard input[type="search"]:focus,
.search--white .typeahead__list > li:hover > a,
.counting-footer .author-prof,
.search-standard input[type="search"]:focus,
.search-standard .typeahead__list > li:hover > a,
a,
.list,
.first-letter--dark span:first-of-type,
.logo-title,
.top-bar,
.w-contacts--style2 .info,
.location-details .contacts-text {
  color: ' . esc_attr( $secondary_color ) . ';
}';

			$custom_css .= '
.selection--gray::-moz-selection {
  background-color: ' . esc_attr( $secondary_color ) . ';
}';
			$custom_css .= '
.selection--gray::selection {
  background-color: ' . esc_attr( $secondary_color ) . ';
}';

			$custom_css .= '
.btn--secondary,
.bg-secondary-color  {
  background-color: ' . esc_attr( $secondary_color ) . ';
}';
			$custom_css .= '
.c-secondary {
  fill: ' . esc_attr( $secondary_color ) . ';
}';

		}
//		$custom_css .= Utouch::get_inline_css();

		if ( function_exists( 'fw_get_db_customizer_option' ) ) {

			$menu_bg_color    = fw_get_db_customizer_option( 'dropdown-style/2/bg-color', '#ecf4fc' );

		}
		if ( is_singular() && function_exists( 'fw_get_db_post_option' ) ) {
			// Header options
			$enable_customization = fw_get_db_post_option( get_the_ID(), 'custom-header/enable', 'no' );
			if ( 'yes' === $enable_customization ) {
				$menu_bg_color = fw_get_db_post_option( get_the_ID(), 'custom-header/yes/dropdown-style/2/bg-color','#ecf4fc' );
			}
		}

		if(!empty($menu_bg_color)){
			$custom_css .= '.utouch .header--menu-rounded .primary-menu-menu > li > a:hover {
			background-color: '.$menu_bg_color.';}';
		}

		// Header

		if ( null === $header_bg_color = Utouch::get_var( 'header_page_bg_color' ) ) {
			$header_bg_color = fw_get_db_customizer_option( 'header_bg_color', '' );
		}
		if ( ! empty( $header_bg_color ) ) {
			$custom_css .= '#site-header{ background:' . esc_attr( $header_bg_color ) . ' }';
		}

		$header_text_color = fw_get_db_customizer_option( 'header-text-color', '' );
		if ( is_singular() && function_exists( 'fw_get_db_post_option' ) ) {
			// Header options
			if ( 'yes' === fw_get_db_post_option( get_the_ID(), 'custom-header/enable', 'no' ) ) {
				$header_text_color = fw_get_db_post_option( get_the_ID(), 'custom-header/yes/header-text-color', '#fff' );
			}
		}
		if ( ! empty( $header_text_color ) ) {
			$custom_css .= '#site-header{ color:' . esc_attr( $header_text_color ) . ' }';
			$custom_css .= '#site-header{ fill:' . esc_attr( $header_text_color ) . ' }';
			$custom_css .= '#site-header{ border-color:' . esc_attr( $header_text_color ) . ' }';
		}

		$options              = fw_get_db_customizer_option( 'stunning-show', array() );


		$style                = '';
		$bg_color             = fw_get_db_customizer_option( 'stunning_background_color', '' );
		$bg_image             = fw_get_db_customizer_option( 'stunning_bg_image', array() );
		$bg_cover             = fw_get_db_customizer_option( 'stunning_bg_cover', false );
		$text_color           = fw_get_db_customizer_option( 'stunning_text_color', '' );
		$enable_customization = fw_get_db_post_option( get_the_ID(), 'custom-stunning/enable', 'no' );



		if ( is_category() ) {
			$enable_customization = fw_get_db_term_option( get_queried_object_id(), 'category', 'custom-stunning/enable', 'no' );
		}

		$subscribe_section    = fw_get_db_customizer_option( 'show_subscribe_section', 'yes' );
		$enable_customization = fw_get_db_post_option( get_the_ID(), 'custom-subscribe/enable', 'no' );
		if ( 'yes' === $enable_customization ) {
			$subscribe_section = fw_get_db_post_option( get_the_ID(), 'custom-subscribe/yes/subscribe-show/value', 'yes' );
		}
		if ( 'yes' === $subscribe_section ) {
			// Subscribe section styling.
			$subscribe_bg     = fw_get_db_customizer_option( 'subscribe_bg_color', '' );
			$subscribe_bg_img = fw_get_db_customizer_option( 'subscribe_bg_image', '' );

			$subscribe_bg_cover = fw_get_db_customizer_option( 'subscribe_bg_cover', false );
			$subscribe_text     = fw_get_db_customizer_option( 'subscribe_text_color', '' );

			if ( 'yes' === $enable_customization ) {
				$panel_options = fw_get_db_post_option( get_the_ID(), 'custom-subscribe/yes/subscribe-show', array() );
				// Subscribe section styling.
				$subscribe_bg     = utouch_akg( 'yes/subscribe_bg_color', $panel_options, '' );
				$subscribe_bg_img = utouch_akg( 'yes/subscribe_bg_image', $panel_options, '' );

				$subscribe_bg_cover = utouch_akg( 'yes/subscribe_bg_cover', $panel_options, '' );
				$subscribe_text     = utouch_akg( 'yes/subscribe_text_color', $panel_options, '' );
			}
			if ( ! empty( $subscribe_bg ) || ! empty( $subscribe_bg_img ) || ! empty( $subscribe_text ) ) {
				$custom_css .= '#subscribe-section{';
				if ( ! empty( $subscribe_bg ) ) {
					$custom_css .= 'background-color:' . esc_attr( $subscribe_bg ) . ';';
				}
				if ( ! empty( $subscribe_bg_img ) ) {
					$bg_img_url = utouch_akg( 'data/css/background-image', $subscribe_bg_img, '' );
					if ( ! empty( $bg_img_url ) ) {
						$custom_css .= 'background-image:' . ( $bg_img_url ) . ';';

						if ( true === $subscribe_bg_cover ) {
							$custom_css .= 'background-size:cover;';
						}
					}
				}
				if ( ! empty( $subscribe_text ) ) {
					$custom_css .= 'color:' . esc_attr( $subscribe_text ) . ';';
				}
				$custom_css .= '} ';
			}
		}
		//stunning header
		$custom_css .= '#stunning-section{ ' . Utouch_Helper_Html::attr_style( Utouch::template_stunning()->styles, false ) . '}';
		// Footer section styling.
		$footer_bg       = fw_get_db_customizer_option( 'footer_bg_color', '' );
		$footer_bg_img   = fw_get_db_customizer_option( 'footer_bg_image', '' );
		$footer_bg_cover = fw_get_db_customizer_option( 'footer_bg_cover', false );
		$footer_text     = fw_get_db_customizer_option( 'footer_text_color', '#9db5d4' );
		$footer_title    = fw_get_db_customizer_option( 'footer_title_color', '#ffffff' );

		if ( ! empty( $footer_bg ) || ! empty( $footer_bg_img ) || ! empty( $footer_text ) ) {
			$custom_css .= '#site-footer{';
			if ( ! empty( $footer_bg ) ) {
				$custom_css .= 'background-color:' . esc_attr( $footer_bg ) . ';';
			}
			if ( ! empty( $footer_bg_img ) ) {
				$bg_img_url = utouch_akg( 'data/css/background-image', $footer_bg_img, '' );
				if ( isset( $footer_bg_img ) && ! empty( $footer_bg_img ) ) {
					$custom_css .= 'background-image:' . ( $bg_img_url ) . ';';

					if ( true === $footer_bg_cover ) {
						$custom_css .= 'background-size:cover;';
					}
				}
			}
			if ( ! empty( $footer_text ) ) {
				$custom_css .= 'color:' . esc_attr( $footer_text ) . ';';
			}
			$custom_css .= '}';
		}
		if ( ! empty( $footer_title ) ) {
			$custom_css .= '#site-footer .widget .widget-title,#site-footer a:not(.btn), #site-footer a.social__item svg, #site-footer .w-list ul.list, #site-footer .widget_nav_menu ul.list{';
			$custom_css .= 'color:' . esc_attr( $footer_title ) . ';';
			$custom_css .= 'fill:' . esc_attr( $footer_title ) . ';';
			$custom_css .= '}';
		}

		// Copyright section styling.
		$copyright_bg   = fw_get_db_customizer_option( 'copyright_bg_color', '' );
		$copyright_text = fw_get_db_customizer_option( 'copyright_text_color', '' );
		if ( ! empty( $copyright_bg ) || ! empty( $copyright_text ) ) {
			if ( ! empty( $copyright_bg ) ) {
				$custom_css .= '#site-footer .sub-footer{ background-color:' . esc_attr( $copyright_bg ) . '}';
			}
			if ( ! empty( $copyright_text ) ) {
				$custom_css .= '#site-footer .site-copyright-text{ color:' . esc_attr( $copyright_text ) . '}';
			}
		}

		wp_add_inline_style( 'utouch-style', $custom_css );
	}
}


