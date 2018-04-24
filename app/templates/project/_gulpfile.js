var gulp = require('gulp'),
	gutil = require('gulp-util'),
	browserSync = require('browser-sync'),
	plugins = require('gulp-load-plugins')({camelize: true});

var pkg = require('./package.json');
var banner = [
'/*!',
' *  <%%= pkg.title %> <%%= pkg.version %>',
' *  Copyright (C) <%%= new Date().getFullYear() %> <%%= pkg.author.name %>',
' *  Licensed under <%%= pkg.license %>.',
' */',
'',
''
].join('\n');

gulp.task('concat', function() {
	return gulp.src(['src/js/<%= opts.projectSlug %>.js','src/js/_*.js'])
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.sourcemaps.init())
		.pipe(plugins.babel({
			presets: [
				['env', {
					targets: {
						browsers: '> 1%'
					}
				}]
			]
		}))
		.pipe(plugins.concat('<%= opts.projectSlug %>.js'))
		.pipe(plugins.header(banner, { pkg : pkg } ))
		.pipe(plugins.sourcemaps.write('/'))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/js'))
		.pipe(browserSync.stream())
		// .pipe(plugins.notify({message: 'Concat task complete', onLast: true}));
});

gulp.task('uglify', function() {
	return gulp.src(['assets/js/*.js','!assets/js/*.min.js'])
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.uglify({
			output: {comments: 'uglify-save-license'}
		}))
		.pipe(plugins.rename({suffix: '.min'}))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/js'))
		.pipe(browserSync.stream())
		// .pipe(plugins.notify({message: 'Uglify task complete', onLast: true}));
});

gulp.task('scripts:lint', function() {
	return gulp.src(['src/js/<%= opts.projectSlug %>.js','src/js/_*.js'])
		.pipe(plugins.jshint())
		.pipe(plugins.jshint.reporter('jshint-stylish'))
});

gulp.task('images', function() {
	return gulp.src('src/images/*.{gif,jpg,png,svg}')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.imagemin([
			plugins.imagemin.svgo({plugins: [{removeViewBox: true}]}),
			plugins.imagemin.optipng({optimizationLevel: 7}),
			plugins.imagemin.jpegtran({progressive: true}),
			plugins.imagemin.gifsicle({interlaced: true})
		]))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/images'))
		.pipe(browserSync.stream())
		// .pipe(plugins.notify({message: 'Imagemin task complete', onLast: true}));
});

gulp.task('sass', function() {
	return gulp.src('src/sass/**/*.s+(a|c)ss')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.sourcemaps.init())
		.pipe(plugins.sass({
			outputStyle: 'expanded'
		}))
		.pipe(plugins.autoprefixer({
			browsers: '> 1%',
			remove: false
		}))
		.pipe(plugins.header(banner, { pkg : pkg } ))
		.pipe(plugins.sourcemaps.write('/'))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/css'))
		.pipe(browserSync.stream())
		// .pipe(plugins.notify({message: 'Sass task complete', onLast: true}));
});

gulp.task('cssnano', function() {
	return gulp.src(['assets/css/*.css','!assets/css/*.min.css'])
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.cssnano({
			discardComments: {removeAllButFirst: true}
		}))
		.pipe(plugins.rename({suffix: '.min'}))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/css'))
		.pipe(browserSync.stream())
		// .pipe(plugins.notify({message: 'Cssnano task complete', onLast: true}));
});

gulp.task('styles:lint', function() {
	return gulp.src('src/sass/**/*.s+(a|c)ss')
		.pipe(plugins.sassLint())
		.pipe(plugins.sassLint.format())
});

gulp.task('debug:true', function() {
	return gulp.src('functions.php')
		.pipe(plugins.replace(/define\( 'THEME_DEBUG',(\s+)\w+ \);/, 'define( \'THEME_DEBUG\',$1true );'))
		.pipe(gulp.dest('.'));
});

gulp.task('debug:false', function() {
	return gulp.src('functions.php')
		.pipe(plugins.replace(/define\( 'THEME_DEBUG',(\s+)\w+ \);/, 'define( \'THEME_DEBUG\',$1false );'))
		.pipe(gulp.dest('.'));
});

gulp.task('watch', function() {
	gulp.watch('src/js/**/*.js', gulp.series('concat', 'uglify'));
	gulp.watch('src/images/**/*.{gif,jpg,png}', gulp.series('images'));
	gulp.watch('src/sass/**/*.{scss,sass}', gulp.series('sass', 'cssnano'));
});

gulp.task('serve', gulp.parallel('watch', function() {
	browserSync.init({
		files: ['**/*.php'],
		proxy: '<%= opts.localServer %>',
		open: false,
		notify: false
	});
}));

gulp.task('bump', function(done) {
	return gulp.src(['package.json', 'style.css'])
		.pipe(plugins.bump({
			type: gutil.env.type,
			version: gutil.env.version
		}))
		.pipe(gulp.dest('.'));
});

gulp.task('pot', function() {
	return gulp.src('**/*.php')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.wpPot({
			domain: '<%= opts.projectSlug %>',
			package: '<%= opts.themeName %>'
		}))
		.pipe(gulp.dest('languages/<%= opts.projectSlug %>.pot'));
});

gulp.task('build:scripts', gulp.series('concat', 'uglify'));
gulp.task('build:styles', gulp.series('sass', 'cssnano'));
gulp.task('build', gulp.parallel('images', 'build:scripts', 'build:styles'));
gulp.task('lint', gulp.parallel('scripts:lint', 'styles:lint'));
gulp.task('default', gulp.series('build', 'serve'));
