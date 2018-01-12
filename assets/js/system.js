( function( $ ) {

	'use strict';

	var baseURL     = OgiveAjaxObj.site_url;
	var sites       = OgiveAjaxObj.sites;
	var dataTypes   = OgiveAjaxObj.data_types;
	var div         = '.ogive-stats';

	/**
	 * When the DOM is ready.
	 */
	$( function() {
		rendering_data();
		window.setInterval(function() {
			// this will execute on every 5 seconds
			$( div ).empty();
			rendering_data();
		}, 60000);
	} );

	/**
	 * This function is responsible
	 * for rendering JSON data
	 */
	var rendering_data = function() {
		$.each( sites, function( index, value ) {
			$(div).append(
				'<div class="ogive-site-domain"><p>'
				+ baseURL
				+ value
				+ '</p></div>'
			);
			$.each(dataTypes, ( function( index ) {
				return function( key, value ) {
					ajaxWrapper( get_url( key, index ), value );
				}
			} )( index ) );
		})
	};

	/**
	 * Generating dynamic JSON URL.
	 *
	 * @param endpoint
	 * @param index
	 * @returns {string}
	 */
	var get_url = function( endpoint, index ) {
		return baseURL
			+ sites[index]
			+ 'wp-json/ogive/v1/'
			+ endpoint;
	};

	/**
	 * Ajax wrapper function.
	 *
	 * @param url
	 * @param type
	 */
	var ajaxWrapper = function( url, type ) {
		$.ajax({
			url: url,
			dataType: 'json',
			async: false,
			success: ( function( type ) {
				return function( data ) {
					$(div).append(
						'<p class="ogive-type">'
						+ type
						+ ': '
						+ data
						+ '</p>'
					);
				}
			} )( type )
		});
	};

} )( jQuery );