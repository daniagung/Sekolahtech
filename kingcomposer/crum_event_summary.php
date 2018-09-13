<?php
/**
 * @package utouch-wp
 */

extract( $atts );
$module_class   = utouch_module_class( 'crumina-module-event-summary', $atts );
$module_class[] = 'widget';
$module_class[] = 'w-contacts';
$module_class[] = 'w-contacts--style2';

$event = Utouch::get_event( $event_id );

?>
<div class="<?php echo implode( ' ', $module_class ) ?>">
	<div class="contact-item display-flex">
		<svg class="utouch-icon utouch-icon-calendar-2">
			<use xlink:href="#utouch-icon-calendar-2"></use>
		</svg>
		<span class="info"><?php echo esc_html($event->get_dates_range()) ?></span>
	</div>
	<div class="contact-item display-flex">
		<svg class="utouch-icon utouch-icon-placeholder-3">
			<use xlink:href="#utouch-icon-placeholder-3"></use>
		</svg>
		<span class="info"><?php echo esc_html($event->location['location']) ?></span>
	</div>

</div>

