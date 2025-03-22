import { FlatCompat } from '@eslint/eslintrc';
import js from '@eslint/js';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const compat = new FlatCompat({
	baseDirectory: __dirname,
	recommendedConfig: js.configs.recommended,
	allConfig: js.configs.all,
});

export default [
	{
		ignores: ['node_modules/**/*', 'assets/dist/**/*.js'],
	},
	...compat.extends('plugin:@wordpress/eslint-plugin/recommended', 'plugin:@typescript-eslint/recommended'),
	{
		languageOptions: {
			globals: {
				<%= opts.functionPrefix %>_options: 'writable',
			},
		},

		rules: {
			camelcase: [
				'error',
				{
					ignoreGlobals: true,
					properties: 'never',
				},
			],
		},
	},
];
