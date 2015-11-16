var gulp = require('gulp'),
	sass = require('gulp-sass');

gulp.task('sass', function(){
	gulp.src('sass/<%= opts.projectSlug %>.scss')
		.pipe(sass())
		.pipe(gulp.dest('css'));
});

gulp.task('watch', function() {
	gulp.watch('sass/**/*.{scss,sass}', ['sass'])
});

gulp.task('default', ['sass', 'watch']);
