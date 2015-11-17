var gulp = require('gulp'),
	sass = require('gulp-sass');

gulp.task('sass', function(){
	gulp.src('assets/sass/*.{scss,sass}')
		.pipe(sass())
		.pipe(gulp.dest('css'));
});

gulp.task('watch', function() {
	gulp.watch('assets/sass/**/*.{scss,sass}', ['sass'])
});

gulp.task('default', ['sass', 'watch']);
