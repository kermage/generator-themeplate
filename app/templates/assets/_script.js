import $ from 'jquery';
<%_ if ( 'bootstrap' === opts.framework ) { _%>
import bootstrap from './_bootstrap';
<% } %>
$( document ).ready( function() {
	// eslint-disable-next-line no-console
	console.log( 'Everything is ready. ThemePlate!' );
} );
