var gulp = require('gulp'),
	gutil = require('gulp-util'),
	browserSync = require('browser-sync'),
	plugins = require('gulp-load-plugins')({camelize: true});

gulp.task('concat', function() {
	return gulp.src(['assets/js/<%= opts.projectSlug %>.js','assets/js/_*.js'])
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.sourcemaps.init())
		.pipe(plugins.concat('<%= opts.projectSlug %>.js'))
		.pipe(plugins.sourcemaps.write('/'))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('js'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Concat task complete', onLast: true}));
});

gulp.task('uglify', function() {
	return gulp.src(['js/*.js','!js/*.min.js'])
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.uglify({
			output: {comments: 'uglify-save-license'}
		}))
		.pipe(plugins.rename({suffix: '.min'}))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('js'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Uglify task complete', onLast: true}));
});

gulp.task('scripts', ['concat'], function() {
    gulp.start('uglify');
});

gulp.task('scripts:lint', function() {
	return gulp.src(['assets/js/<%= opts.projectSlug %>.js','assets/js/_*.js'])
		.pipe(plugins.jshint())
		.pipe(plugins.jshint.reporter('jshint-stylish'))
});

gulp.task('images', function() {
	return gulp.src('assets/images/*.{gif,jpg,png}')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.imagemin([
			plugins.imagemin.optipng({optimizationLevel: 7}),
			plugins.imagemin.jpegtran({progressive: true}),
			plugins.imagemin.gifsicle({interlaced: true})
		]))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('images'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Imagemin task complete', onLast: true}));
});

gulp.task('sass', function() {
	return gulp.src('assets/sass/**/*.s+(a|c)ss')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.sourcemaps.init())
		.pipe(plugins.sass({
			outputStyle: 'expanded'
		}))
		.pipe(plugins.autoprefixer({
			browsers: '> 1%',
			remove: false
		}))
		.pipe(plugins.sourcemaps.write('/'))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('css'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Sass task complete', onLast: true}));
});

gulp.task('cssnano', function() {
	return gulp.src(['css/*.css','!css/*.min.css'])
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.cssnano({
			discardComments: {removeAllButFirst: true}
		}))
		.pipe(plugins.rename({suffix: '.min'}))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('css'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Cssnano task complete', onLast: true}));
});

gulp.task('styles', ['sass'], function() {
    gulp.start('cssnano');
});

gulp.task('styles:lint', function() {
	return gulp.src('assets/sass/**/*.s+(a|c)ss')
		.pipe(plugins.sassLint())
		.pipe(plugins.sassLint.format())
});

gulp.task('debug-true', function() {
	gulp.src('functions.php')
		.pipe(plugins.replace(/define\( 'THEME_DEBUG',(\s+)\w+ \);/, 'define( \'THEME_DEBUG\',$1true );'))
		.pipe(gulp.dest('.'));
});

gulp.task('debug-false', function() {
	gulp.src('functions.php')
		.pipe(plugins.replace(/define\( 'THEME_DEBUG',(\s+)\w+ \);/, 'define( \'THEME_DEBUG\',$1false );'))
		.pipe(gulp.dest('.'));
});

gulp.task('watch', function() {
	gulp.watch('assets/js/**/*.js', ['scripts']);
	gulp.watch('assets/images/**/*.{gif,jpg,png}', ['images']);
	gulp.watch('assets/sass/**/*.{scss,sass}', ['styles']);
});

gulp.task('serve', ['watch'], function() {
	browserSync.init({
		files: ['**/*.php'],
		proxy: '<%= opts.localServer %>',
		open: false,
		notify: false
	});
});

gulp.task('bump', function() {
	gulp.src(['package.json', 'style.css'])
		.pipe(plugins.bump({
			type: gutil.env.type,
			version: gutil.env.version
		}))
		.pipe(gulp.dest('.'));
	gulp.src('assets/sass/<%= opts.projectSlug %>.scss')
		.pipe(plugins.bump({
			type: gutil.env.type,
			version: gutil.env.version,
			key: '<%= opts.themeName %>'
		}))
		.pipe(gulp.dest('assets/sass'));
	gulp.src('assets/js/<%= opts.projectSlug %>.js')
		.pipe(plugins.bump({
			type: gutil.env.type,
			version: gutil.env.version,
			key: '<%= opts.themeName %>'
		}))
		.pipe(gulp.dest('assets/js'));
});

gulp.task('pot', function() {
	return gulp.src('**/*.php')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.wpPot({
			domain: 'vj',
			package: '<%= opts.themeName %>'
		}))
		.pipe(gulp.dest('languages/<%= opts.projectSlug %>.pot'));
});

gulp.task('build', ['images', 'scripts', 'styles']);
gulp.task('lint', ['scripts:lint', 'styles:lint']);
gulp.task('default', ['build'], function() {
    gulp.start('serve');
});
