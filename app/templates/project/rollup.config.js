import path from 'path';
import { babel } from '@rollup/plugin-babel';
import { nodeResolve as resolve } from '@rollup/plugin-node-resolve';
import replace from '@rollup/plugin-replace';
import typescript from '@rollup/plugin-typescript';

const external = [
	// WP or CDN loaded
	'jquery',
];

const globals = {
	jquery: 'jQuery',
};

const config = {
	external,
	plugins: [
		babel({
			babelHelpers: 'bundled',
			exclude: 'node_modules/**',
		}),
		replace({
			preventAssignment: true,
			'process.env.NODE_ENV': process.env.NODE_ENV,
		}),
		resolve(),
		typescript(),
	],
	output(file) {
		const baseFile = path.basename(file.path, file.extname);
		const extension = path.extname(baseFile);

		return {
			globals,
			format: extension ? extension.replace('.', '') : 'iife',
			name: path.basename(baseFile, extension).replace(/-/g, '_'),
			sourcemap: true,
		};
	},
};

module.exports = config;
