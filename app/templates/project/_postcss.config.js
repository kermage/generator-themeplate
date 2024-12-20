module.exports = (context) => {
	const options = context.options;
	const plugins = {};

	if (undefined === options || !options.minified) {
		plugins.tailwindcss = {};
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
