/* eslint-env node */

const gulp = require( 'gulp' ),
	argv = require( 'minimist' )( process.argv.slice( 2 ) ),
	autoprefixer = require( 'autoprefixer' ),
	browserSync = require( 'browser-sync' ),
	cssnano = require( 'cssnano' ),
	rollup = require( '@rollup/stream' ),
	babel = require( '@rollup/plugin-babel' ).babel,
	typescript = require( '@rollup/plugin-typescript' ),
	buffer = require( 'vinyl-buffer' ),
	source = require( 'vinyl-source-stream' ),
	plugins = require( 'gulp-load-plugins' )( { camelize: true } );

const pkg = require( './package.json' );
const banner = [
	'/*!',
	' *  <%%= pkg.title %> <%%= pkg.version %>',
	' *  Copyright (C) <%%= new Date().getFullYear() %> <%%= pkg.author.name %>',
	' *  Licensed under <%%= pkg.license %>.',
	' */',
	'',
	'',
].join( '\n' );

gulp.task( 'rollup', function() {
	return rollup( {
		external: [ 'jquery' ],
		input: 'src/js/<%= opts.projectSlug %>.js',
		output: {
			globals: {
				jquery: 'jQuery',
			},
			format: 'iife',
			sourcemap: true,
		},
		plugins: [
			babel( {
				presets: [
					[ '@babel/env', { modules: false } ],
					[ '@babel/typescript', { allExtensions: true } ],
				],
			} ),
			typescript( { allowJs: true } ),
		],
	} ).pipe( source( '<%= opts.projectSlug %>.js' ) )
		.pipe( buffer() )
		.pipe( plugins.plumber( { errorHandler: plugins.notify.onError( 'Error: <%%= error.message %>' ) } ) )
		.pipe( plugins.sourcemaps.init( { loadMaps: true } ) )
		.pipe( plugins.header( banner, { pkg } ) )
		.pipe( plugins.sourcemaps.write( '/' ) )
		.pipe( plugins.plumber.stop() )
		.pipe( gulp.dest( 'assets/js' ) )
		.pipe( browserSync.stream() );
} );

gulp.task( 'uglify', function() {
	return gulp.src( [ 'assets/js/*.js', '!assets/js/*.min.js' ] )
		.pipe( plugins.plumber( { errorHandler: plugins.notify.onError( 'Error: <%%= error.message %>' ) } ) )
		.pipe( plugins.uglify( {
			output: { comments: /^!/ },
		} ) )
		.pipe( plugins.rename( { suffix: '.min' } ) )
		.pipe( plugins.plumber.stop() )
		.pipe( gulp.dest( 'assets/js' ) )
		.pipe( browserSync.stream() );
} );

gulp.task( 'build:scripts', gulp.series( 'rollup', 'uglify' ) );

gulp.task( 'webp', function() {
	return gulp.src( 'src/images/*.{gif,jpg,png}' )
		.pipe( plugins.plumber( { errorHandler: plugins.notify.onError( 'Error: <%%= error.message %>' ) } ) )
		.pipe( plugins.webp( { quality: 100 } ) )
		.pipe( plugins.plumber.stop() )
		.pipe( gulp.dest( 'assets/images' ) )
		.pipe( browserSync.stream() );
} );

gulp.task( 'imagemin', function() {
	return gulp.src( 'src/images/*.{gif,jpg,png,svg}' )
		.pipe( plugins.plumber( { errorHandler: plugins.notify.onError( 'Error: <%%= error.message %>' ) } ) )
		.pipe( plugins.imagemin( [
			plugins.imagemin.svgo( { plugins: [ { removeViewBox: true } ] } ),
			plugins.imagemin.optipng( { optimizationLevel: 7 } ),
			plugins.imagemin.mozjpeg( { quality: 100 } ),
			plugins.imagemin.gifsicle( { interlaced: true } ),
		] ) )
		.pipe( plugins.plumber.stop() )
		.pipe( gulp.dest( 'assets/images' ) )
		.pipe( browserSync.stream() );
} );

gulp.task( 'build:images', gulp.series( 'webp', 'imagemin' ) );

gulp.task( 'sass', function() {
	return gulp.src( 'src/sass/*.s+(a|c)ss' )
		.pipe( plugins.plumber( { errorHandler: plugins.notify.onError( 'Error: <%%= error.message %>' ) } ) )
		.pipe( plugins.sourcemaps.init() )
		.pipe( plugins.sass( {
			outputStyle: 'expanded',
		} ) )
		.pipe( plugins.postcss( [
			autoprefixer( {
				remove: false,
			} ),
		] ) )
		.pipe( plugins.header( banner, { pkg } ) )
		.pipe( plugins.sourcemaps.write( '/' ) )
		.pipe( plugins.plumber.stop() )
		.pipe( gulp.dest( 'assets/css' ) )
		.pipe( browserSync.stream() );
} );

gulp.task( 'cssnano', function() {
	return gulp.src( [ 'assets/css/*.css', '!assets/css/*.min.css' ] )
		.pipe( plugins.plumber( { errorHandler: plugins.notify.onError( 'Error: <%%= error.message %>' ) } ) )
		.pipe( plugins.postcss( [
			cssnano( {
				preset: [ 'default', {
					discardComments: {
						removeAllButFirst: true,
					},
				} ],
			} ),
		] ) )
		.pipe( plugins.rename( { suffix: '.min' } ) )
		.pipe( plugins.plumber.stop() )
		.pipe( gulp.dest( 'assets/css' ) )
		.pipe( browserSync.stream() );
} );

gulp.task( 'build:styles', gulp.series( 'sass', 'cssnano' ) );

gulp.task( 'lint:scripts', function() {
	return gulp.src( [ 'src/js/**/*.+(j|t)s' ] )
		.pipe( plugins.eslint() )
		.pipe( plugins.eslint.format( 'stylish' ) );
} );

gulp.task( 'lint:styles', function() {
	return gulp.src( 'src/sass/**/*.s+(a|c)ss' )
		.pipe( plugins.stylelint( {
			reporters: [ {
				formatter: 'verbose',
				console: true,
			} ],
		} ) );
} );

gulp.task( 'fix:scripts', function() {
	return gulp.src( [ 'src/js/**/*.+(j|t)s' ] )
		.pipe( plugins.eslint( {
			fix: true,
		} ) )
		.pipe( gulp.dest( 'src/js' ) );
} );

gulp.task( 'fix:styles', function() {
	return gulp.src( 'src/sass/**/*.s+(a|c)ss' )
		.pipe( plugins.stylelint( {
			fix: true,
		} ) )
		.pipe( gulp.dest( 'src/sass' ) );
} );

gulp.task( 'watch', function() {
	gulp.watch( 'src/js/**/*.{js,ts}', gulp.series( 'build:scripts' ) );
	gulp.watch( 'src/images/**/*.{gif,jpg,png}', gulp.series( 'build:images' ) );
	gulp.watch( 'src/sass/**/*.{scss,sass}', gulp.series( 'build:styles' ) );
} );

gulp.task( 'serve', gulp.parallel( 'watch', function() {
	browserSync.init( {
		files: [ '**/*.php' ],
		proxy: '<%= opts.localServer %>',
		open: false,
		notify: false,
	} );
} ) );

gulp.task( 'bump', function() {
	return gulp.src( [ 'package.json', 'style.css' ] )
		.pipe( plugins.bump( {
			type: argv[ 'to-type' ],
			version: argv[ 'to-version' ],
		} ) )
		.pipe( gulp.dest( '.' ) );
} );

gulp.task( 'pot', function() {
	return gulp.src( '**/*.php' )
		.pipe( plugins.plumber( { errorHandler: plugins.notify.onError( 'Error: <%%= error.message %>' ) } ) )
		.pipe( plugins.wpPot( {
			domain: '<%= opts.projectSlug %>',
			package: '<%= opts.projectName %>',
		} ) )
		.pipe( gulp.dest( 'languages/<%= opts.projectSlug %>.pot' ) );
} );

gulp.task( 'build', gulp.parallel( 'build:images', 'build:scripts', 'build:styles' ) );
gulp.task( 'lint', gulp.parallel( 'lint:scripts', 'lint:styles' ) );
gulp.task( 'fix', gulp.parallel( 'fix:scripts', 'fix:styles' ) );
gulp.task( 'default', gulp.series( 'build', 'serve' ) );
