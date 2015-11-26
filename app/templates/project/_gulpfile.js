var gulp = require('gulp'),
	browserSync = require('browser-sync'),
	plugins = require('gulp-load-plugins')({ camelize: true });

gulp.task('concat', function(){
	gulp.src('assets/js/*.js')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%= error.message %>")}))
		.pipe(plugins.concat('<%= opts.projectSlug %>.js'))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('js'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Concat task complete', onLast: true }));
});

gulp.task('uglify', function(){
	gulp.src(['js/*.js','!js/*.min.js'])
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%= error.message %>")}))
		.pipe(plugins.uglify())
		.pipe(plugins.rename({suffix: '.min'}))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('js'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Uglify task complete', onLast: true }));
});

gulp.task('imagemin', function(){
	gulp.src('assets/images/*.{gif,jpg,png}')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%= error.message %>")}))
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
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%= error.message %>")}))
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
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError("Error: <%= error.message %>")}))
		.pipe(plugins.cssnano({
			discardComments:{removeAllButFirst:true}
		}))
		.pipe(plugins.rename({suffix: '.min'}))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('css'))
		.pipe(browserSync.stream())
		.pipe(plugins.notify({message: 'Cssnano task complete', onLast: true }));
});

gulp.task('watch', function() {
	browserSync.init({
		files: ['**/*.php'],
		proxy: "localhost:8080",
		open: false,
		notify: false
	});
	gulp.watch('assets/js/**/*.js', ['concat'])
	gulp.watch('assets/js/**/*.{gif,jpg,png}', ['imagemin'])
	gulp.watch('assets/sass/**/*.{scss,sass}', ['sass'])
});

gulp.task('dev', ['sass', 'concat']);
gulp.task('build', ['uglify', 'cssnano', 'imagemin']);
gulp.task('default', ['dev', 'watch']);
