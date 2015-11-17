var gulp = require('gulp'),
	concat = require('gulp-concat'),
	imagemin = require('gulp-imagemin'),
	sass = require('gulp-sass');

gulp.task('concat', function(){
	gulp.src('assets/js/*.js')
		.pipe(concat('<%= opts.projectSlug %>.js'))
		.pipe(gulp.dest('js'));
});

gulp.task('imagemin', function(){
	gulp.src('assets/images/*.{gif,jpg,png}')
		.pipe(imagemin({
			optimizationLevel: 7,
			progressive: true,
			interlaced: true
		}))
		.pipe(gulp.dest('images'));
});

gulp.task('sass', function(){
	gulp.src('assets/sass/*.{scss,sass}')
		.pipe(sass())
		.pipe(gulp.dest('css'));
});

gulp.task('watch', function() {
	gulp.watch('assets/js/**/*.js', ['concat'])
	gulp.watch('assets/js/**/*.{gif,jpg,png}', ['imagemin'])
	gulp.watch('assets/sass/**/*.{scss,sass}', ['sass'])
});

gulp.task('default', ['sass', 'concat', 'imagemin', 'watch']);
