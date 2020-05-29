// External jQuery
import $ from 'jquery';
<% if ( opts.bootstrap ) { %>
import './_bootstrap';
<% } %>
$( document ).ready( function() {
	// eslint-disable-next-line no-console
	console.log( 'Everything is ready. ThemePlate!' );
} );
