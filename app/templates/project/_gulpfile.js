var gulp = require('gulp'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	imagemin = require('gulp-imagemin'),
	rename = require('gulp-rename'),
	sass = require('gulp-sass'),
	cssnano = require('gulp-cssnano'),
	browserSync = require('browser-sync');

gulp.task('concat', function(){
	gulp.src('assets/js/*.js')
		.pipe(concat('<%= opts.projectSlug %>.js'))
		.pipe(gulp.dest('js'))
		.pipe(browserSync.stream());
});

gulp.task('uglify', function(){
	gulp.src(['js/*.js','!js/*.min.js'])
		.pipe(uglify())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('js'))
		.pipe(browserSync.stream());
});

gulp.task('imagemin', function(){
	gulp.src('assets/images/*.{gif,jpg,png}')
		.pipe(imagemin({
			optimizationLevel: 7,
			progressive: true,
			interlaced: true
		}))
		.pipe(gulp.dest('images'))
		.pipe(browserSync.stream());
});

gulp.task('sass', function(){
	gulp.src('assets/sass/*.{scss,sass}')
		.pipe(sass({
			outputStyle: 'expanded'
		}))
		.pipe(gulp.dest('css'))
		.pipe(browserSync.stream());
});

gulp.task('cssnano', function(){
	gulp.src(['css/*.css','!css/*.min.css'])
		.pipe(cssnano({
			discardComments:{removeAllButFirst:true}
		}))
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('css'))
		.pipe(browserSync.stream());
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
