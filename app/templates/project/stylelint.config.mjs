/** @type {import('stylelint').Config} */
export default {
	extends: ['@wordpress/stylelint-config/scss', 'genetiks/config'],

	ignoreFiles: ['node_modules/**', 'assets/css/**/*.css'],
};
