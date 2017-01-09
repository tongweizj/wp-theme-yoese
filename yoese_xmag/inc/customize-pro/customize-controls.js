( function( api ) {

	// Extends our custom "yoese-pro" section.
	api.sectionConstructor['yoese-pro'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
