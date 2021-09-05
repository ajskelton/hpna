/**
 * Purple Air Reveal
 *
 * Button that opens the full Purple Air bar for mobile
 */
function purpleAirReveal() {

	const button = document.querySelector('.aqi-mobile-see-more'),
		  sections = document.querySelectorAll('.js-aqi-see-more' );

	button.addEventListener( 'click', toggleReveal );

	function toggleReveal() {

		sections.forEach( function ( section ) {
			section.classList.toggle('aqi-reveal');
		})

		if ( button.innerHTML === 'See more' ) {
			button.innerHTML = 'See less';
		} else {
			button.innerHTML = 'See more';
		}
	}
}
purpleAirReveal();