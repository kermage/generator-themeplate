/* eslint-disable @typescript-eslint/no-var-requires */

const path = require( 'path' );
const babel = require( '@rollup/plugin-babel' ).babel;
const resolve = require( '@rollup/plugin-node-resolve' ).nodeResolve;
const replace = require( '@rollup/plugin-replace' );
const typescript = require( '@rollup/plugin-typescript' );

const external = [
	'jquery',
];

const globals = {
	jquery: 'jQuery',
};

const config = {
	external,
	plugins: [
		babel( {
			babelHelpers: 'bundled',
			exclude: 'node_modules/**',
		} ),
		replace( {
			preventAssignment: true,
			'process.env.NODE_ENV': process.env.NODE_ENV,
		} ),
		resolve(),
		typescript(),
	],
	output( file ) {
		const baseFile = path.basename( file.path, file.extname );
		const extension = path.extname( baseFile );

		return {
			globals,
			format: extension ? extension.replace( '.', '' ) : 'iife',
			name: path.basename( baseFile, extension ).replace( /-/g, '_' ),
			sourcemap: true,
		};
	},
};

module.exports = config;
