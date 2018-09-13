<?php
/**
 * @package utouch-wp
 */
$event    = Utouch::get_event( get_the_ID() );
$language = substr( get_locale(), 0, 2 );

wp_enqueue_script(
	'google-maps-api-v3',
	'https://maps.googleapis.com/maps/api/js?key=' . $event->gmaps_api_key . '&language=' . $language,
	array(),
	'3.15',
	false
);
$delta = empty( $event->contacts ) && empty( $event->location['location'] ) ? 0 : 0.04;
wp_add_inline_script(
	'google-maps-api-v3',
	"
	var map;
	var marker;
	var latlng = {
                    lat: " . esc_attr( $event->location['coordinates']['lat'] ) . ",
                    lng: " . esc_attr( $event->location['coordinates']['lng'] ) . "};
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: " . esc_attr( $event->location['coordinates']['lat'] ) . ",
                    lng: " . esc_attr( $event->location['coordinates']['lng'] + $delta ) . "},
                zoom: 12,
                scrollwheel: false
            });
             marker = new google.maps.Marker({
          position: {
                    lat: " . esc_attr( $event->location['coordinates']['lat'] ) . ",
                    lng: " . esc_attr( $event->location['coordinates']['lng'] ) . "},
          map: map
        });
        }
        jQuery(function(){
            jQuery(\"a[href='#location']\").on('shown.bs.tab', function(e) {
                initMap();
        });
    });",
	'after'
);

?>
<?php
$tab_title = '';
if ( ! empty( $event->location_title ) ) {
	echo utouch_html_tag( 'h3', array(), esc_html( $event->location_title ) );
}
if ( ! empty( $event->location_desc ) ) {
	echo utouch_html_tag( 'p', array( 'class' => 'weight-bold' ), esc_html( $event->location_desc ) );
}

?>
<!-- Google map -->

<div class="map--rounded">
	<div id="map"></div>

	<?php if ( ! empty( $event->contacts ) || ! empty( $event->location['location'] ) ) { ?>
		<div class="location-details">

			<p class="contacts-text"><?php echo esc_html( $event->location['location'] ) ?></p>
			<?php foreach ( $event->contacts as $contact ) { ?>
				<div class="contact-item">
					<?php if ( 'text' === $contact['contact_type'] ) { ?>
						<span class="info"><?php echo esc_html( $contact['contact'] ) ?></span>
					<?php } else { ?>
						<a href="<?php echo esc_html( $contact['contact_type'] ) ?>:<?php echo esc_html( $contact['contact'] ) ?>"
						   class="info"><?php echo esc_html( $contact['contact'] ) ?></a>
					<?php } ?>
				</div>
			<?php } ?>

		</div>
	<?php } ?>
</div>

<?php if ( $event->show_get_in_touch ) {

	$tab_title = '';
	if ( ! empty( $event->get_in_touch_title ) ) {
		$tab_title .= utouch_html_tag( 'h2', array(), esc_html( $event->get_in_touch_title ) );
	}
	if ( ! empty( $event->get_in_touch_desc ) ) {
		$tab_title .= utouch_html_tag( 'div', array( 'class' => 'heading-text' ), esc_html( $event->get_in_touch_desc ) );
	}

	if ( ! empty( $tab_title ) ) {
		echo utouch_html_tag( 'div', array( 'class' => 'crumina-module crumina-heading ' ), $tab_title );
	} ?>

	<form class="contact-form items-with-border" method="post"
		  action="<?php echo site_url(); ?>?action=widget_contact_form">
		<input type="hidden" name="mail_to" value="<?php echo esc_attr( $event->get_in_touch_email ) ?>"/>
		<input type="hidden" name="subject" value="<?php the_title() ?>"/>
		<input type="hidden" name="permalink" value="<?php echo esc_url(home_url()) ?>"/>
		<input type="hidden" name="request_uri" value="<?php the_permalink(); ?>"/>
		<div class="row">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<input name="name" placeholder="<?php echo esc_html__( 'Your Name', 'utouch' ) ?>" type="text">
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<input name="email" placeholder="<?php echo esc_html__( 'Email Address', 'utouch' ) ?>"
							   type="text">
					</div>
				</div>

			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<textarea name="message" class="" required=""
						  placeholder="<?php echo esc_html__( 'Your Message', 'utouch' ) ?>"
						  style="height: 160px;"></textarea>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<button type="submit"
						class="btn btn--<?php echo esc_attr( $event->get_in_touch_btn_color ) ?> btn--with-shadow">
					<?php echo esc_html( $event->get_in_touch_btn_label ) ?>
				</button>
			</div>

		</div>
	</form>
<?php } ?>
