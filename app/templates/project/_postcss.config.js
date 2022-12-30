module.exports = (context) => {
	const options = context.options;
	const plugins = {};

	if (!options.minified) {
		<%_ if ('tailwind' === opts.framework) { _%>
		plugins.tailwindcss = {};
		<%_ } _%>
		plugins.autoprefixer = {
			remove: false,
		};
	} else {
		plugins.cssnano = {
			preset: [
				'default',
				{
					discardComments: {
						removeAllButFirst: true,
					},
				},
			],
		};
	}

	return { plugins };
};
