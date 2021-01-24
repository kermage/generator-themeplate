module.exports = context => {
	const options = context.options;
	const plugins = {};

	if ( ! options.minified ) {
<% if ( 'tailwind' === opts.framework ) { %>
		plugins.tailwindcss = {};
<% } %>
		plugins.autoprefixer = {
			remove: false,
		};

	} else {
		plugins.cssnano = {
			preset: [ 'default', {
				discardComments: {
					removeAllButFirst: true,
				},
			} ],
		};
	}

	return { plugins };
}
