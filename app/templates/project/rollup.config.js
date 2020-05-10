const path = require( 'path' );
const babel = require( '@rollup/plugin-babel' ).babel;
const typescript = require( '@rollup/plugin-typescript' );

const config = {
	external: [ 'jquery' ],
	plugins: [
		babel( { babelHelpers: 'bundled' } ),
		typescript(),
	],
	output( file ) {
		const baseFile = path.basename( file.path, file.extname );
		const extension = path.extname( baseFile );

		return {
			globals: {
				jquery: 'jQuery',
			},
			format: extension ? extension.replace( '.', '' ) : 'iife',
			name: path.basename( baseFile, extension ),
			sourcemap: true,
		};
	}
};

module.exports = config;
