var gulp = require('gulp'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	imagemin = require('gulp-imagemin'),
	rename = require('gulp-rename'),
	sass = require('gulp-sass'),
	cssnano = require('gulp-cssnano'),
	browserSync = require('browser-sync'),
	notify = require('gulp-notify'),
	plumber = require('gulp-plumber');

gulp.task('concat', function(){
	gulp.src('assets/js/*.js')
		.pipe(plumber())
		.pipe(concat('<%= opts.projectSlug %>.js'))
		.pipe(plumber.stop())
		.pipe(gulp.dest('js'))
		.pipe(browserSync.stream())
		.pipe(notify({message: 'Concat task complete', onLast: true }));
});

gulp.task('uglify', function(){
	gulp.src(['js/*.js','!js/*.min.js'])
		.pipe(plumber())
		.pipe(uglify())
		.pipe(rename({suffix: '.min'}))
		.pipe(plumber.stop())
		.pipe(gulp.dest('js'))
		.pipe(browserSync.stream())
		.pipe(notify({message: 'Uglify task complete', onLast: true }));
});

gulp.task('imagemin', function(){
	gulp.src('assets/images/*.{gif,jpg,png}')
		.pipe(plumber())
		.pipe(imagemin({
			optimizationLevel: 7,
			progressive: true,
			interlaced: true
		}))
		.pipe(plumber.stop())
		.pipe(gulp.dest('images'))
		.pipe(browserSync.stream())
		.pipe(notify({message: 'Imagemin task complete', onLast: true }));
});

gulp.task('sass', function(){
	gulp.src('assets/sass/*.{scss,sass}')
		.pipe(plumber())
		.pipe(sass({
			outputStyle: 'expanded'
		}))
		.pipe(plumber.stop())
		.pipe(gulp.dest('css'))
		.pipe(browserSync.stream())
		.pipe(notify({message: 'Sass task complete', onLast: true }));
});

gulp.task('cssnano', function(){
	gulp.src(['css/*.css','!css/*.min.css'])
		.pipe(plumber())
		.pipe(cssnano({
			discardComments:{removeAllButFirst:true}
		}))
		.pipe(rename({suffix: '.min'}))
		.pipe(plumber.stop())
		.pipe(gulp.dest('css'))
		.pipe(browserSync.stream())
		.pipe(notify({message: 'Cssnano task complete', onLast: true }));
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
