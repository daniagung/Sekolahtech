<?php if ( ! defined( 'FW' ) ) die( 'Forbidden' );
/**
 * @var string $the_content
 */

global $post;
$options = fw_get_db_post_option($post->ID, fw()->extensions->get( 'events' )->get_event_option_id());
?>
<section class="medium-padding100">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<h2>Description of presentation</h2>
				<p>Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam
					processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera
					gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
					quarta decima.
				</p>
				<p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum putamus parum claram.</p>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="widget w-contacts w-contacts--style2 ">
					<div class="contact-item display-flex">
						<svg class="icon utouch-icon-placeholder-3"><use xlink:href="#utouch-icon-placeholder-3"></use></svg>
						<span class="info">September 25-27</span>
					</div>
					<div class="contact-item display-flex">
						<svg class="icon utouch-icon-telephone-keypad-with-ten-keys"><use xlink:href="#utouch-icon-telephone-keypad-with-ten-keys"></use></svg>
						<span class="info">795 South Park Avenue, Melbourne, Australia</span>
					</div>

					<a href="#" class="btn btn--green btn--with-shadow">
						Buy a Ticket Now!
					</a>
				</div>

			</div>
		</div>
	</div>
</section>


<?php echo ($the_content); ?>

<?php do_action('fw_ext_events_single_after_content'); ?>