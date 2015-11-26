var gulp = require('gulp'),
	browserSync = require('browser-sync'),
	plugins = require('gulp-load-plugins')({ camelize: true });

gulp.task('concat', function(){
	gulp.src('assets/js/*.js')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.concat('<%= opts.projectSlug %>.js'))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('js'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Concat task complete', onLast: true }));
});

gulp.task('uglify', function(){
	gulp.src(['js/*.js','!js/*.min.js'])
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.uglify())
		.pipe(plugins.rename({suffix: '.min'}))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('js'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Uglify task complete', onLast: true }));
});

gulp.task('imagecopy', function(){
	gulp.src('assets/images/*.{gif,jpg,png}')
		.pipe(gulp.dest('images'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Imagecopy task complete', onLast: true }));
});

gulp.task('imagemin', function(){
	gulp.src('assets/images/*.{gif,jpg,png}')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.imagemin({
			optimizationLevel: 7,
			progressive: true,
			interlaced: true
		}))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('images'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Imagemin task complete', onLast: true }));
});

gulp.task('sass', function(){
	gulp.src('assets/sass/*.{scss,sass}')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.sass({
			outputStyle: 'expanded'
		}))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('css'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Sass task complete', onLast: true }));
});

gulp.task('cssnano', function(){
	gulp.src(['css/*.css','!css/*.min.css'])
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%%= error.message %>")}))
		.pipe(plugins.cssnano({
			discardComments:{removeAllButFirst:true}
		}))
		.pipe(plugins.rename({suffix: '.min'}))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('css'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Cssnano task complete', onLast: true }));
});

gulp.task('debug-true', function(){
	gulp.src('functions.php')
		.pipe(plugins.replace(/define\( 'THEME_DEBUG',(\s+)\w+ \);/, 'define( \'THEME_DEBUG\',$1true );'))
		.pipe(gulp.dest('.'));
});

gulp.task('debug-false', function(){
	gulp.src('functions.php')
		.pipe(plugins.replace(/define\( 'THEME_DEBUG',(\s+)\w+ \);/, 'define( \'THEME_DEBUG\',$1false );'))
		.pipe(gulp.dest('.'));
});

gulp.task('browsersync', function() {
	browserSync.init({
		files: ['**/*.php'],
		proxy: "localhost:8080",
		open: false,
		notify: false
	});
});

gulp.task('watch', function() {
	gulp.watch('assets/js/**/*.js', ['concat']);
	gulp.watch('assets/images/**/*.{gif,jpg,png}', ['imagecopy']);
	gulp.watch('assets/sass/**/*.{scss,sass}', ['sass']);
});

gulp.task('build', ['sass', 'concat', 'imagecopy']);
gulp.task('dev', ['debug-true', 'build', 'browsersync', 'watch']);
gulp.task('dist', ['cssnano', 'uglify', 'imagemin']);
gulp.task('test', ['debug-false', 'dist', 'browsersync']);
gulp.task('default', ['dev']);
