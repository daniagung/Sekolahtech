<?php

/**
 * Class Utouch_Helper_Html
 *
 * Some Helper function for theme common html parts
 */
class Utouch_Helper_Html {

	/**
	 * @param $classes array with class names
	 * @param bool $echo
	 *
	 * @return string
	 */
	public static function attr_class( $classes, $echo = true ) {
		$attribute_html = implode( ' ', $classes );
		if ( $echo ) {
			echo esc_attr( $attribute_html );
		}

		return $attribute_html;

	}

	/**
	 * @param $styles array pairs of style name and style value
	 * @param bool $echo
	 *
	 * @return string
	 */
	public static function attr_style( $styles, $echo = true ) {
		$attribute_html = '';
		if(!is_array($styles)){
			$styles = array();
		}
		foreach ( $styles as $style_name => $style_value ) {
			$attribute_html .= $style_name . ': ' . $style_value . '; ';
		}

		if ( $echo ) {
			echo esc_attr( $attribute_html );
		}

		return $attribute_html;
	}

	/**
	 * Get overlay html
	 *
	 * @param $overlay_color
	 * @param bool $echo
	 *
	 * @return string
	 */
	public static function overlay( $overlay_color, $echo = true ) {
		if ( empty( $overlay_color ) ) {
			return '';
		}
		$overlay_html = utouch_html_tag( 'div', array(
			'class' => 'overlay',
			'style' => 'background-color:' . $overlay_color
		), true );

		if ( $echo ) {
			echo( $overlay_html );
		}

		return $overlay_html;
	}

	/**
	 * Background video layer html
	 *
	 * @param $video_attr
	 * @param bool $echo whenever echo the $html
	 *
	 * @return string
	 */
	public static function bg_video_layer( $video_attr, $echo = true ) {

		$html = '<div class="bg-layer js-section-background"
			 data-background-options="' . esc_attr( $video_attr ) . '"></div>';

		if ( $echo ) {
			echo ($html);
		}

		return $html;
	}

	/**
	 * Background image tilt effect html
	 *
	 * @param string $bg_image image url
	 * @param bool $echo whenever echo the $html
	 *
	 * @return string
	 */
	public static function bg_image_tilt( $bg_image, $echo = true ) {
		$tilt_attr = utouch_htmlspecialchars( json_encode( array(
			'opacity'  => '0.8',
			'movement' => array(
				'perspective' => '1500',
				'translateX'  => '15',
				'translateY'  => '15',
				'translateZ'  => '2',
				'rotateX'     => '5',
				'rotateY'     => '5'
			)
		) ) );
		$html      = '<img src="' . esc_url( $bg_image ) . '" alt="img" class="utouch-tilt-effect"
			 data-tilt-options="' . esc_attr( $tilt_attr ) . '"/>';

		if ( $echo ) {
			echo ($html);
		}

		return $html;
	}

	public static function new_button( $btn_data ) {
		$style = utouch_akg( 'button/style', $btn_data, 'regular' );

		if ( 'app-store' === $style ) {
			static::app_store_button( utouch_gen_link_for_shortcode( $btn_data ) );
		} elseif ( 'google-play' === $style ) {
			static::google_play_button( utouch_gen_link_for_shortcode( $btn_data ) );
		} elseif ( 'regular' === $style ) {
			$btn         = utouch_akg( 'button/regular', $btn_data, array() );
			$btn['link'] = utouch_akg( 'link', $btn_data, array() );
			$btn['class'] = utouch_akg( 'class', $btn_data, array() );
			static::button( $btn );
		}
	}

	/**
	 * Display button
	 *
	 * @param array $button button options
	 */
	public static function button( $button ) {
		if ( ! empty( $button['label'] ) ) {

			$link      = utouch_gen_link_for_shortcode( $button );
			$classes   = array();
			$classes[] = 'btn'; // Base button class.
			$classes[] = 'btn-' . utouch_akg( 'size', $button, '' ); // Size class.

			$classes[] = 'on' === utouch_akg( 'shadow', $button, 'off' ) ? 'btn--with-shadow' : ''; // Shadow class
			$classes[] = 'btn--' . utouch_akg( 'color', $button, '' ); // Color class.
			if('on' === utouch_akg( 'outlined', $button, 'off' )){
				$classes[] = 'btn-border';
			}
//			$classes[] = 'btn--' . utouch_akg( 'color', $button, '' ); // Color class.
			$classes[] = utouch_akg( 'class', $button, '' );
			?>
			<a href="<?php echo esc_url( $link['link'] ) ?>"
			   target="<?php echo esc_attr( $link['target'] ) ?>"
			   class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<span class="text"><?php echo esc_html( $button['label'] ) ?></span>
				<?php if ( '_blank' === $link['target'] ) {
					echo '<i class="seoicon-right-arrow"></i>';
				} ?>
			</a>
		<?php }
	}

	public static function app_store_button( $link ) {
		?>
		<a href="<?php echo esc_url( $link['link'] ) ?>"
		   target="<?php echo esc_attr( $link['target'] ) ?>"
		   class="btn btn-market btn--with-shadow">
			<svg class="utouch-icon utouch-icon-apple-logotype-1">
				<use xlink:href="#utouch-icon-apple-logotype-1"></use>
			</svg>
			<div class="text">
				<span class="sup-title"><?php echo esc_html__( 'Download on the', 'utouch' ) ?></span>
				<span class="title"><?php echo esc_html__( 'App Store', 'utouch' ) ?></span>
			</div>
		</a>
		<?php
	}

	public static function google_play_button( $link ) {
		?>
		<a href="<?php echo esc_url( $link['link'] ) ?>"
		   target="<?php echo esc_attr( $link['target'] ) ?>"
		   class="btn btn-market btn--with-shadow">
			<img class="utouch-icon" src="<?php echo get_template_directory_uri() ?>/svg/google-play.svg"
				 alt="google">
			<div class="text">
				<span class="sup-title"><?php echo esc_html__( 'Download on the', 'utouch' ) ?></span>
				<span class="title"><?php echo esc_html__( 'Google Play', 'utouch' ) ?></span>
			</div>
		</a>
		<?php
	}

	public static function generate_crumina_form( $form_id = '', $color_btn = 'primary', $button_class = '' ) {
		$form_tags    = $submit_atts = array();
		$form_options = get_post_meta( $form_id, 'fw_options', true );
		if ( ! empty( $form_options ) ) {

			$form_html = fw()->extensions->get( 'forms' )->render_form( $form_id, $form_options['form'], 'contact-forms', '' );

			$form_html = str_replace( '<div class="header title">', '<div class="module-heading">', $form_html );


			preg_match_all( '/<input[^>]+>/i', $form_html, $result );
			$result = array_shift( $result );
			foreach ( $result as $input ) {
				preg_match_all( '/(class|value|type)=("[^"]*")/i', $input, $form_tags[ $input ] );
			}
			$submit_input = array_slice( $result, - 1, 1, true );
			$submit_input = array_shift( $submit_input );

			foreach ( $form_tags as $tag ) {
				if ( '"submit"' === $tag[2][0] ) {
					$submit_atts = $tag[2];
				}
			}
			if ( isset( $submit_atts[1] ) ) {
				$button_text = str_replace( '"', '', $submit_atts[1] );
			}
			if ( isset( $submit_atts[2] ) ) {
				$button_class = $submit_atts[2];
			}


			$button_html = '<div class="row submit-wrap"><div class="col-xs-12"><button type="submit" class="btn--with-shadow btn btn-medium btn--' . esc_attr( $color_btn . ' ' . $button_class ) . '"><span class="text">' . esc_html( $form_options['submit_button_text'] ) . '</span></button></div></div></form>';
			$form_html   = str_replace( '</form>', $button_html, $form_html );

			echo( $form_html );
		} else {
			esc_html_e( 'Please create new and select contact form.', 'utouch' );
		}
	}

}