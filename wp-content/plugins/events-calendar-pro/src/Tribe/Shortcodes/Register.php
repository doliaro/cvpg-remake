<?php


/**
 * Registers shortcodes handlers for each of the widget wrappers.
 */
class Tribe__Events__Pro__Shortcodes__Register {

	/**
	 * Variable that holds the attributes of the shortcode being rendered by the iCal feed.
	 *
	 * @since 4.4.23
	 *
 	 * @var array
	 */
	private $ical_shortcode_attributes = array(
		'view' => 'default',
	);

	public function __construct() {
		add_shortcode( 'tribe_mini_calendar', array( $this, 'mini_calendar' ) );
		add_shortcode( 'tribe_events_list', array( $this, 'events_list' ) );
		add_shortcode( 'tribe_featured_venue', array( $this, 'featured_venue' ) );
		add_shortcode( 'tribe_event_countdown', array( $this, 'event_countdown' ) );
		add_shortcode( 'tribe_this_week', array( $this, 'this_week' ) );
		add_shortcode( 'tribe_events', array( $this, 'tribe_events' ) );
		add_shortcode( 'tribe_event_inline', array( $this, 'tribe_inline' ) );
		add_action( 'tribe_events_ical_before', array( $this, 'search_shortcodes' ) );
	}

	public function mini_calendar( $atts ) {
		$wrapper = new Tribe__Events__Pro__Shortcodes__Mini_Calendar( $atts );

		return $wrapper->output;
	}

	public function events_list( $atts ) {
		$wrapper = new Tribe__Events__Pro__Shortcodes__Events_List( $atts );

		return $wrapper->output;
	}

	public function featured_venue( $atts ) {
		$wrapper = new Tribe__Events__Pro__Shortcodes__Featured_Venue( $atts );

		return $wrapper->output;
	}

	public function event_countdown( $atts ) {
		$wrapper = new Tribe__Events__Pro__Shortcodes__Event_Countdown( $atts );

		return $wrapper->output;
	}

	/**
	 * @param $atts
	 *
	 * @return string
	 */
	public function this_week( $atts ) {
		$wrapper = new Tribe__Events__Pro__Shortcodes__This_Week( $atts );

		return $wrapper->output;
	}

	/**
	 * Handler for the [tribe_events] shortcode.
	 *
	 * Please note that the shortcode should not be used alongside a regular event archive
	 * view nor should it be used more than once in the same request - or else breakages may
	 * occur. We try to limit accidental breakages by returning an empty string if we detect
	 * any of the above scenarios.
	 *
	 * This limitation can be lifted once our CSS, JS and template classes are refactored to
	 * support multiple instances of each view in the same request.
	 *
	 * @param $atts
	 *
	 * @return string
	 */
	public function tribe_events( $atts ) {
		static $deployed = false;

		if ( tribe_is_event_query() || $deployed ) {
			return '';
		}

		$shortcode = new Tribe__Events__Pro__Shortcodes__Tribe_Events( $atts );
		$deployed  = true;

		return $shortcode->output();
	}

	/**
	 * Handler for Inline Event Content Shortcode
	 *
	 * @param $atts
	 * @param $content
	 * @param $tag
	 *
	 * @return string
	 */
	public function tribe_inline( $atts, $content, $tag ) {

		$shortcode = new Tribe__Events__Pro__Shortcodes__Tribe_Inline( $atts, $content, $tag );

		return $shortcode->output();
	}

	/**
	 * Callback called by `tribe_events_ical_before` just before the iCal process is started to give us some time
	 * to setup other filters so we can change the event list used for the feed if the link is executed in a page with
	 * a shortcode of the calendars.
	 *
	 * @since 4.4.23
	 */
	public function search_shortcodes() {
		if ( is_single() && ! is_singular( Tribe__Events__Main::POSTTYPE ) ) {
			$this->find_events_in_shortcode();
		} elseif ( is_page() ) {
			$this->find_events_in_shortcode();
		}
	}

	/**
	 * Returns a list of events based on the shortcode inserted in current post / page, this will look if there are shortcode
	 * and extract the attributes of the shortcode to return the events based on those settings.
	 *
	 * @since 4.4.23
	 *
	 * @return array
	 */
	private function find_events_in_shortcode() {
		$this->ical_shortcode_attributes = $this->get_shortcode_attributes( get_the_ID() );
		$this->ical_shortcode_attributes['view'] = tribe_get_request_var( 'tribe_event_display', $this->ical_shortcode_attributes['view'] );
		if ( 'month' === strtolower( $this->ical_shortcode_attributes['view'] ) ) {
			add_filter( 'tribe_is_month', '__return_true' );
		} else {
			add_filter( 'tribe_events_ical_events_list_args', array( $this, 'ical_events_list_args' ) );
			add_filter( 'tribe_events_ical_events_list_query', '__return_null' );
		}
	}

	/**
	 * Callback attached to the filter `tribe_events_ical_events_list_args` to change the set of arguments used to
	 * query the Objects used on the iCal feed.
	 *
	 * @return array
	 */
	public function ical_events_list_args() {
		return array(
			'eventDisplay' => $this->ical_shortcode_attributes['view'],
		);
	}

	/**
	 * Look for the attributes of the [tribe_events] shortcode inside of the current post / page by looking into
	 * the content, extract the attributes to know exactly how to render the iCal feed.
	 *
	 * @since 4.4.23
	 *
	 * @param int $id The post / page ID.
	 * @return array
	 */
	private function get_shortcode_attributes( $id = 0 ) {
		$content = get_post_field( 'post_content', $id );
		$shortcode = $this->get_shortcode( $content );
		// remove any empty value
		$attributes = array_filter( (array) shortcode_parse_atts( $shortcode ) );
		return wp_parse_args( $attributes, array(
			'view' => 'default',
		) );
	}

	/**
	 * Function to extract the $shortcode from the content, by default it will return the first match with all the attributes
	 * definition from the provided content. Removes the opening, closing and shortcode it self so it returns only the attributes
	 * of the shortcode.
	 *
	 * @since 4.4.23
	 *
	 * @param string $content The content with the shortcode (if any)
	 * @param string $shortcode The desired shortcode
	 * @return string
	 */
	private function get_shortcode( $content = '', $shortcode = 'tribe_events' ) {
		$pattern = get_shortcode_regex();
		preg_match_all( "/$pattern/s", $content, $matches );
		if ( ! empty( $matches[0] ) && is_array( $matches[0] ) ) {
			foreach ( $matches[0] as $match ) {
				// return only the first shortcode found.
				if ( false !== strpos( $match, $shortcode ) ) {
					// remove opening, closing and shortcode definition.
					return str_replace( array( '[', ']', $shortcode ), '', $match );
				}
			}
		}
		return '';
	}
}
