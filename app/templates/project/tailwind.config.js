module.exports = {
	purge: {
		content: [
			'./*.php',
			'./template-parts/**/*.php',
			'./page-templates/**/*.php',
			'./src/js/**/*.js',
		],
		options: {
			fontFace: true,
			keyframes: true,
		},
	},
	darkMode: false, // or 'media' or 'class'
	theme: {
		extend: {},
	},
	variants: {
		extend: {},
	},
	plugins: [],
};
