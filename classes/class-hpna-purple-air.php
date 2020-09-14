<?php
/**
 * Purple Air Widget
 *
 * @package HPNA
 */

if ( ! class_exists( 'HPNA_Purple_Air' ) ) {
	/**
	 * HPNA Purple Air
	 * Retrieves current air quality from Hollywood Park NE Sensor
	 */
	class HPNA_Purple_Air {
		
		protected $feed;
		protected $key = 'ALX7WIYHAGN9ST7D';
		protected $sensor_id = '55501';
		
		public function __construct() {
			$this->feed = $this->get_feed();
		}
		
		protected function get_feed() {
			
			$feed_transient = get_transient( 'hpna_purple_air_feed' );
			
			if ( $feed_transient ) {
				return $feed_transient;
			}
			
			$url = "https://www.purpleair.com/json?key={$this->key}&show={$this->sensor_id}";
			
			$feed = wp_safe_remote_get( $url );
			
			set_transient( 'hpna_purple_air_feed', $feed, MINUTE_IN_SECONDS * 10 );
			
			return $feed;
		}
		
		public function render_info_bar() {
			
			if ( empty( $this->feed ) || is_wp_error( $this->feed ) ) {
				return '';
			}
			
			$results = $this->get_results();
			
			if ( empty( $results ) ) {
				// Print Error Message
				return '';
			}
			
			$data = $this->get_data( $results );
			
			ob_start();
			?>
            <div class="purple-air-bar">
	            <?php $main_description = $this->get_description_class( $data['aqi_description'] ) ?>
                <button class="aqi-mobile-see-more <?php echo esc_attr( $this->get_text_color( $main_description ) ) ?>">See more</button>
                <div class="bg-<?php echo esc_attr( $main_description ); ?> <?php echo esc_attr( $this->get_text_color( $main_description ) ) ?>">
                    <div class="grid grid-cols-4 lg:grid-cols-10 gap-4 max-w-screen-xl mx-auto">
                        <div class="aqi-current col-span-4 md:col-span-1 flex justify-center items-center">
                            <p class="text-4xl font-bold  m-0"><?php echo esc_html( $data['aqi_now'] ); ?></p>
                        </div>
                        <div class="aqi-info col-span-4 md:col-span-3 self-center justify-center">
                            <p class="mb-0 text-base text-center md:text-left"><?php _e( 'Current AQI for', 'hpna'); ?> <?php echo esc_html( $data['sensor_label'] ); ?></p>
                            <p class="mb-0 text-base text-center md:text-left"><?php _e( 'Last Updated: ', 'hpna' ); ?> <?php echo esc_html( $data['timestamp'] ); ?></p>
                        </div>
                        <div class="aqi-upcoming-boxes flex col-span-4 js-aqi-see-more aqi-hide">
                            <?php foreach ( $data['aqi_future'] as $item ) : ?>
                                <?php $item_background = $this->get_description_class( $this->get_aqi_description( $item['aqi'] ) ); ?>
                                <div class="box bg-<?php echo esc_attr( $item_background ); ?> <?php echo esc_attr( $this->get_text_color( $item_background ) ) ?> flex flex-col w-1/4 text-center justify-center align-center p-2 md:p-4">
                                    <p class="mb-0 text-xl font-bold"><?php echo esc_html( $item['aqi'] ); ?></p>
                                    <p class="mb-0 text-base"><?php echo esc_html( $item['label'] ) ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="aqi-link flex items-center justify-center col-span-4 lg:col-span-2 js-aqi-see-more aqi-hide">
                            <p class="lg:mb-0">
                                <a class="<?php echo esc_attr( $this->get_text_color( $main_description ) ) ?> hover:<?php echo esc_attr( $this->get_text_color( $main_description ) ) ?> underline" href="https://www.purpleair.com/map?opt=1/mAQI/a10/cC0&key=ALX7WIYHAGN9ST7D&select=55501#14/38.53291/-121.48399"
                                   target="_blank"><?php _e( 'See full sensor data', 'hpna' ); ?></a></p>
                        </div>
                    </div>
                </div>
            </div>
			
			
			<?php
			return ob_get_clean();
		}
		
		
		public function get_results() {
			$body = json_decode( $this->feed['body'] );
			
			return $body->results[0] ?? array();
		}
		
		public function get_data( $results ): array {
			
			$stats = json_decode( $results->Stats );
			
			return array(
				'temp'            => $results->temp_f ?? '',
				'timestamp'       => $this->get_timestamp( $results->LastSeen ),
				'sensor_label'    => $results->Label,
				'aqi_now'         => $this->get_aqi_from( $stats->v ),
				'aqi_message'     => $this->get_aqi_message( $this->get_aqi_from( $stats->v ) ),
				'aqi_description' => $this->get_aqi_description( $this->get_aqi_from( $stats->v ) ),
				'aqi_future'      => array(
					'aqi_10'  => array(
						'aqi'   => $this->get_aqi_from( $stats->v1 ),
						'label' => __( 'in 10 min', 'hpna' ),
					),
					'aqi_30'  => array(
						'aqi'   => $this->get_aqi_from( $stats->v2 ),
						'label' => __( 'in 30 min', 'hpna' ),
					),
					'aqi_60'  => array(
						'aqi'   => $this->get_aqi_from( $stats->v3 ),
						'label' => __( 'in 60 min', 'hpna' ),
					),
					'aqi_360' => array(
						'aqi'   => $this->get_aqi_from( $stats->v4 ),
						'label' => __( 'in 6 hr', 'hpna' ),
					)
				),
			);
		}
		
		protected function get_timestamp( $unix_timecode ): string {
			
			$timestamp = DateTime::createFromFormat( 'U', $unix_timecode );
			$timestamp->setTimeZone( new DateTimeZone( 'America/Los_Angeles' ) );
			
			return $timestamp->format( 'M jS g:i a' );
		}
		
		protected function get_aqi_from( $pm ) {
			
			if ( ! isset( $pm ) ) {
				return "-";
			}
			
			if ( is_nan( $pm ) ) {
				return "-";
			}
			
			if ( $pm < 0 ) {
				return $pm;
			}
			
			if ( $pm > 1000 ) {
				return "-";
			}
			
			/**
			 * @Good                                      0 - 50              0.0 - 15.0       0.0 – 12.0
			 * @Moderate                                  51 - 100          > 15.0 - 40        12.1 – 35.4
			 * @UnhealthyForSensitiveGroups               101 – 150         > 40 – 65          35.5 – 55.4
			 * @Unhealthy                                 151 – 200         > 65 – 150         55.5 – 150.4
			 * @VeryUnhealthy                             201 – 300         > 150 – 250        150.5 – 250.4
			 * @Hazardous                                 301 – 400         > 250 – 350        250.5 – 350.4
			 * @Hazardous                                 401 – 500         > 350 – 500        350.5 – 500
			 */
			if ( $pm > 350.5 ) {
				return $this->calculate_aqi( $pm, 500, 401, 500, 350.5 );
			}
			
			if ( $pm > 250.5 ) {
				return $this->calculate_aqi( $pm, 400, 301, 350.4, 250.5 );
			}
			
			if ( $pm > 150.5 ) {
				return $this->calculate_aqi( $pm, 300, 201, 250.4, 150.5 );
			}
			
			if ( $pm > 55.5 ) {
				return $this->calculate_aqi( $pm, 200, 151, 150.4, 55.5 );
			}
			
			if ( $pm > 35.5 ) {
				return $this->calculate_aqi( $pm, 150, 101, 55.4, 35.5 );
			}
			
			if ( $pm > 12.1 ) {
				return $this->calculate_aqi( $pm, 100, 51, 35.4, 12.1 );
			}
			
			if ( $pm >= 0 ) {
				return $this->calculate_aqi( $pm, 50, 0, 12, 0 );
			}
			
			return '-';
		}
		
		protected function bpl_from_pm( $pm ) {
			
			if ( ! isset( $pm ) ) {
				return 0;
			}
			
			if ( is_nan( $pm ) ) {
				return 0;
			}
			
			if ( $pm < 0 ) {
				return 0;
			}
			
			/**
			 * @Good                                      0 - 50              0.0 - 15.0     0.0 – 12.0
			 * @Moderate                                  51 - 100          > 15.0 - 40      12.1 – 35.4
			 * @UnhealthyForSensitiveGroups               101 – 150         > 40 – 65        35.5 – 55.4
			 * @Unhealthy                                 151 – 200         > 65 – 150       55.5 – 150.4
			 * @VeryUnhealthy                             201 – 300         > 150 – 250      150.5 – 250.4
			 * @Hazardous                                 301 – 400         > 250 – 350      250.5 – 350.4
			 * @Hazardous                                 401 – 500         > 350 – 500      350.5 – 500
			 */
			if ( $pm > 350.5 ) {
				return 401;
			}
			
			if ( $pm > 250.5 ) {
				return 301;
			}
			
			if ( $pm > 150.5 ) {
				return 201;
			}
			
			if ( $pm > 55.5 ) {
				return 151;
			}
			
			if ( $pm > 35.5 ) {
				return 101;
			}
			
			if ( $pm > 12.1 ) {
				return 51;
			}
			
			if ( $pm >= 0 ) {
				return 0;
			}
			
			return 0;
			
		}
		
		protected function bph_from_pm( $pm ) {
			
			if ( ! isset( $pm ) ) {
				return 0;
			}
			
			if ( is_nan( $pm ) ) {
				return 0;
			}
			
			if ( $pm < 0 ) {
				return 0;
			}
			/**
			 * @Good                                      0 - 50              0.0 - 15.0        0.0 – 12.0
			 * @Moderate                                  51 - 100          > 15.0 - 40        12.1 – 35.4
			 * @UnhealthyForSensitiveGroups               101 – 150         > 40 – 65          35.5 – 55.4
			 * @Unhealthy                                 151 – 200         > 65 – 150         55.5 – 150.4
			 * @VeryUnhealthy                             201 – 300         > 150 – 250       150.5 – 250.4
			 * @Hazardous                                 301 – 400         > 250 – 350       250.5 – 350.4
			 * @Hazardous                                 401 – 500         > 350 – 500       350.5 – 500
			 */
			if ( $pm > 350.5 ) {
				return 500;
			}
			
			
			if ( $pm > 250.5 ) {
				return 500;
			}
			
			if ( $pm > 150.5 ) {
				return 300;
			}
			
			if ( $pm > 55.5 ) {
				return 200;
			}
			
			if ( $pm > 35.5 ) {
				return 150;
			}
			
			if ( $pm > 12.1 ) {
				return 100;
			}
			
			if ( $pm >= 0 ) {
				return 50;
			}
			
			return 0;
			
		}
		
		protected function calculate_aqi( $Cp, $Ih, $Il, $BPh, $BPl ): float {
			$a = ( $Ih - $Il );
			$b = ( $BPh - $BPl );
			$c = ( $Cp - $BPl );
			
			return round( ( $a / $b ) * $c + $Il );
		}
		
		protected function get_description_class( $string ): string {
			return str_replace( ' ', '-', strtolower( $string ) );
		}
		
		protected function get_text_color( $description ): string {
		    $light_on_dark = array('unhealthy', 'very-unhealthy', 'hazardous');
		    
		    return in_array( $description, $light_on_dark, true ) ? 'text-white' : 'text-black';
		}
		
		protected function get_aqi_description( $aqi ): string {
			if ( $aqi >= 401 ) {
				return 'Hazardous';
			}
			
			if ( $aqi >= 301 ) {
				return 'Hazardous';
			}
			
			if ( $aqi >= 201 ) {
				return 'Very Unhealthy';
			}
			
			if ( $aqi >= 151 ) {
				return 'Unhealthy';
			}
			
			if ( $aqi >= 101 ) {
				return 'Unhealthy for Sensitive Groups';
			}
			
			if ( $aqi >= 51 ) {
				return 'Moderate';
			}
			
			if ( $aqi >= 0 ) {
				return 'Good';
			}
			
			return '';
		}
		
		protected function get_aqi_message( $aqi ): string {
			if ( $aqi >= 401 ) {
				return '>401: Health alert: everyone may experience more serious health effects';
			}
			
			if ( $aqi >= 301 ) {
				return '301-400: Health alert: everyone may experience more serious health effects';
			}
			
			if ( $aqi >= 201 ) {
				return '201-300: Health warnings of emergency conditions. The entire population is more likely to be affected. ';
			}
			
			if ( $aqi >= 151 ) {
				return '151-200: Everyone may begin to experience health effects; members of sensitive groups may experience more serious health effects.';
			}
			
			if ( $aqi >= 101 ) {
				return '101-150: Members of sensitive groups may experience health effects. The general public is not likely to be affected.';
			}
			
			if ( $aqi >= 51 ) {
				return '51-100: Air quality is acceptable; however, for some pollutants there may be a moderate health concern for a very small number of people who are unusually sensitive to air pollution.';
			}
			
			if ( $aqi >= 0 ) {
				return '0-50: Air quality is considered satisfactory, and air pollution poses little or no risk';
			}
			
			return '';
		}
	}
}