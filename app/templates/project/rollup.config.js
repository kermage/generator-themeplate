const path = require( 'path' );
const babel = require( '@rollup/plugin-babel' ).babel;
const resolve = require( '@rollup/plugin-node-resolve' );
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
		babel( { babelHelpers: 'bundled' } ),
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
