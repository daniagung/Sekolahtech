<?php
/**
 * @package utouch-wp
 */

/**
 * Class Utouch_Event_Factory
 *
 * @property bool show_featured
 * @property bool show_author
 * @property bool show_meta
 * @property bool show_share
 *
 */
class Utouch_Event_Factory extends Utouch_Singleton {

	/**
	 * Class instance
	 *
	 * @var Utouch_Event_Factory
	 */
	protected static $instance;

	/**
	 * @var array $events array with all events
	 */
	protected $events = array();

	protected $categories = array();

	protected $customizer_options = null;

	protected function __construct() {

		$this->customizer_options = Utouch::options()->get_option( '', array(), Utouch_Options::SOURCE_CUSTOMIZER );

	}

	/**
	 * Get event class by event_id
	 *
	 * @param $event_id
	 *
	 * @return mixed
	 */
	public function get( $event_id ) {

		if ( array_key_exists( $event_id, $this->events ) ) {
			return $this->events[ $event_id ];
		}

		$data = $this->get_event_data( $event_id );

		$this->events[ $event_id ] = new Utouch_Event( $data );

		return $this->events[ $event_id ];
	}

	protected function get_event_data( $event_id ) {

		$options = fw_get_db_post_option( $event_id, '', array() );

		//general options
		$content_options = utouch_akg( 'event_general/yes', $options, array() );
		$custom_content  = 'yes' === utouch_akg( 'event_general/enable', $options, 'no' );

		$data_general['ID'] = $event_id;

		if ( $custom_content && 'default' !== $opt_val = utouch_akg( 'event_show_share', $content_options, 'no' ) ) {
			$data_general['show_share'] = 'yes' === $opt_val;
		} else {
			$data_general['show_share'] = 'yes' === utouch_akg( 'event_show_share', $this->customizer_options, 'no' );
		}

		if($custom_content && 'default' !== $opt_val = utouch_akg( 'event_navigation/type', $content_options, 'default' ) ) {
			$data_general['navigation_type'] = $opt_val;
			$data_general['prev_next_home'] = utouch_akg( 'event_navigation/prev_next/page_select', $content_options, '' );

			$data_general['related_title'] = utouch_akg( 'event_navigation/related/title', $content_options, esc_html__( 'You May Also Like', 'utouch' ) );
			$data_general['related_to_show'] = utouch_akg( 'event_navigation/related/post_count', $content_options, 5 );
		}else{
			$data_general['navigation_type'] = utouch_akg( 'event_navigation/type', $this->customizer_options, 'none' );
			$data_general['prev_next_home'] = utouch_akg( 'event_navigation/prev_next/page_select', $this->customizer_options, '' );

			$data_general['related_title'] = utouch_akg( 'event_navigation/related/title', $this->customizer_options, esc_html__( 'You May Also Like', 'utouch' ) );
			$data_general['related_to_show'] = utouch_akg( 'event_navigation/related/post_count', $this->customizer_options, 5 );

		}


		//content
		$data_content['workshop_title'] = utouch_akg( 'event_content_title', $options, '' );
		$data_content['workshop_desc']  = utouch_akg( 'event_content_desc', $options, '' );

		//schedule
		$data_schedule['show_schedule']  = 'yes' === utouch_akg( 'show_schedule_tab', $options, 'no' );
		$data_schedule['schedule_title'] = utouch_akg( 'event_schedule_title', $options, '' );
		$data_schedule['schedule_desc']  = utouch_akg( 'event_schedule_desc', $options, '' );
		$data_schedule['all_day_event']  = 'yes' === utouch_akg( 'event_all_day', $options, 'no' );

		$data_schedule['dates'] = array();
		foreach ( utouch_akg( 'schedule_group', $options, array() ) as $day ) {
			$data_schedule['dates'][] = array(
				'from'  => utouch_akg( 'schedule_date_range/from', $day, '' ),
				'to'    => utouch_akg( 'schedule_date_range/to', $day, '' ),
				'title' => utouch_akg( 'schedule_title', $day, '' ),
				'desc'  => utouch_akg( 'schedule_desc', $day, '' ),
			);
		}

		//speakers tab

		$data_speakers['show_speakers']  = 'yes' === utouch_akg( 'show_speakers_tab', $options, 'no' );
		$data_speakers['speakers_title'] = utouch_akg( 'event_speakers_title', $options, '' );
		$data_speakers['speakers_desc']  = utouch_akg( 'event_speakers_desc', $options, '' );
		$data_speakers['speakers']       = utouch_akg( 'event_speaker_user', $options, array() );

		//location tab

		$data_location['show_location']  = 'yes' === utouch_akg( 'show_location_tab', $options, 'no' );
		$data_location['location_title'] = utouch_akg( 'event_location_title', $options, '' );
		$data_location['location_desc']  = utouch_akg( 'event_location_desc', $options, '' );
		$data_location['gmaps_api_key']  = utouch_akg( '_gmaps_api_key', $options, '' );
		$data_location['location']       = utouch_akg( 'event_location', $options, '' );
		$data_location['contacts']       = utouch_akg( 'event_location_contacts', $options, '' );


		//get in touch tab

		$data_get_in_touch['show_get_in_touch']      = 'yes' === utouch_akg( 'show_get_in_touch_tab', $options, 'no' );
		$data_get_in_touch['get_in_touch_title']     = utouch_akg( 'event_get_in_touch_title', $options, '' );
		$data_get_in_touch['get_in_touch_desc']      = utouch_akg( 'event_get_in_touch_desc', $options, '' );
		$data_get_in_touch['get_in_touch_email']     = utouch_akg( 'get_in_touch_email', $options, '' );
		$data_get_in_touch['get_in_touch_btn_label'] = utouch_akg( 'get_in_touch_button/button_label', $options, '' );
		$data_get_in_touch['get_in_touch_btn_color'] = utouch_akg( 'get_in_touch_button/button_color', $options, '' );


		//aside block tab
		$data_aside_block['show_aside_block'] = 'yes' === utouch_akg( 'show_aside_block', $options, 'no' );
		$data_aside_block['countdown_title']  = utouch_akg( 'event_countdown_title', $options, '' );
		$data_aside_block['main_speaker']     = utouch_akg( 'event_main_speaker_user/0', $options, '' );
		$data_aside_block['button_label']     = utouch_akg( 'event_countdown_button/button', $options, '' );
		$data_aside_block['button_color']     = utouch_akg( 'event_countdown_button/button-color', $options, '' );

		$link                              = utouch_gen_link_for_shortcode( utouch_akg( 'event_countdown_button', $options, array() ) );
		$data_aside_block['button_url']    = $link['link'];
		$data_aside_block['button_target'] = $link['target'];

		if ( empty( $data_aside_block['countdown_title'] ) ) {
			$data_aside_block['countdown_title'] = esc_html__( 'Counting Down', 'utouch' );
		}
        if ( utouch_akg( 'custom-tab-labels/enable', $options, 'no' ) === 'yes' ) {
            $data_tab_labels[ 'workshop_label' ] = utouch_akg( 'custom-tab-labels/yes/workshop_label', $options, esc_html__( 'Workshop', 'utouch' ) );
            $data_tab_labels[ 'schedule_label' ] = utouch_akg( 'custom-tab-labels/yes/schedule_label', $options, esc_html__( 'Schedule', 'utouch' ) );
            $data_tab_labels[ 'speakers_label' ] = utouch_akg( 'custom-tab-labels/yes/speakers_label', $options, esc_html__( 'Speakers', 'utouch' ) );
            $data_tab_labels[ 'location_label' ] = utouch_akg( 'custom-tab-labels/yes/location_label', $options, esc_html__( 'Location', 'utouch' ) );
        } else {
            $data_tab_labels[ 'workshop_label' ] = utouch_akg( 'tab_labels/workshop_label', $this->customizer_options, esc_html__( 'Workshop', 'utouch' ) );
            $data_tab_labels[ 'schedule_label' ] = utouch_akg( 'tab_labels/schedule_label', $this->customizer_options, esc_html__( 'Schedule', 'utouch' ) );
            $data_tab_labels[ 'speakers_label' ] = utouch_akg( 'tab_labels/speakers_label', $this->customizer_options, esc_html__( 'Speakers', 'utouch' ) );
            $data_tab_labels[ 'location_label' ] = utouch_akg( 'tab_labels/location_label', $this->customizer_options, esc_html__( 'Location', 'utouch' ) );
        }

        // preview data
		$preview_data['preview_style'] = utouch_akg( 'preview_style', $options, '' );
		$preview_data['preview_size'] = utouch_akg( 'preview_style_size', $options, '' );
		$category_settings             = utouch_akg( 'category-settings', $options, 'yes' );
		$category_id = $this->get_event_category_id($event_id);
		if ( 'yes' === $category_settings ) {
			$category_opt = $this->get_category_opt( $category_id );
		} else {
			$category_opt = utouch_akg( 'custom-category', $options, array() );
		}

		$preview_data['category_id']  = $category_id;
		$preview_data['preview_accent_color'] = utouch_akg( 'accent-color', $category_opt, '#fff' );
		$preview_data['preview_overlay']      = utouch_akg( 'overlay-color', $category_opt, 'rgba(15,15,15,0.5)' );

		return array_merge( $data_general, $data_content, $data_schedule, $data_speakers, $data_location, $data_get_in_touch, $data_aside_block, $data_tab_labels, $preview_data );
	}

	/**
	 * @param $category_id
	 *
	 * @return array|null
	 */
	private function get_category_opt( $category_id ) {

		return fw_get_db_term_option( $category_id, 'fw-event-taxonomy-name','', array(
			'category_id'   => null,
			'color'         => '#fff',
			'accent-color'  => '#fff',
			'overlay-color' => 'rgba(15,15,15,0.5)',
		) );

	}

	/**
	 * @param $event_id
	 *
	 * @return null|int
	 */
	private function get_event_category_id($event_id){
		$terms = get_the_terms( $event_id, 'fw-event-taxonomy-name' );
		if(empty($terms)){
			return null;
		}
		return empty($terms) ? null : $terms[0]->term_id;
	}

}