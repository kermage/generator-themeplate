/* eslint-env node */

var gulp = require('gulp'),
	argv = require('minimist')(process.argv.slice(2)),
	autoprefixer = require('autoprefixer'),
	browserSync = require('browser-sync'),
	cssnano = require('cssnano'),
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
	return gulp.src(['src/js/*.js'])
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError('Error: <%%= error.message %>')}))
		.pipe(plugins.sourcemaps.init())
		.pipe(plugins.babel({
			presets: ['@babel/preset-env']
		}))
		.pipe(plugins.concat('<%= opts.projectSlug %>.js'))
		.pipe(plugins.header(banner, { pkg : pkg } ))
		.pipe(plugins.sourcemaps.write('/'))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/js'))
		.pipe(browserSync.stream());
});

gulp.task('uglify', function() {
	return gulp.src(['assets/js/*.js','!assets/js/*.min.js'])
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError('Error: <%%= error.message %>')}))
		.pipe(plugins.uglify({
			output: {comments: /^!/}
		}))
		.pipe(plugins.rename({suffix: '.min'}))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/js'))
		.pipe(browserSync.stream());
});

gulp.task('images', function() {
	return gulp.src('src/images/*.{gif,jpg,png,svg}')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError('Error: <%%= error.message %>')}))
		.pipe(plugins.imagemin([
			plugins.imagemin.svgo({plugins: [{removeViewBox: true}]}),
			plugins.imagemin.optipng({optimizationLevel: 7}),
			plugins.imagemin.mozjpeg({quality: 100}),
			plugins.imagemin.gifsicle({interlaced: true})
		]))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/images'))
		.pipe(browserSync.stream());
});

gulp.task('sass', function() {
	return gulp.src('src/sass/*.s+(a|c)ss')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError('Error: <%%= error.message %>')}))
		.pipe(plugins.sourcemaps.init())
		.pipe(plugins.sass({
			outputStyle: 'expanded'
		}))
		.pipe(plugins.postcss([
			autoprefixer({
				remove: false
			})
		]))
		.pipe(plugins.header(banner, { pkg : pkg } ))
		.pipe(plugins.sourcemaps.write('/'))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/css'))
		.pipe(browserSync.stream());
});

gulp.task('cssnano', function() {
	return gulp.src(['assets/css/*.css','!assets/css/*.min.css'])
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError('Error: <%%= error.message %>')}))
		.pipe(plugins.postcss([
			cssnano({
				preset: ['default', {
					discardComments: {
						removeAllButFirst: true,
					},
				}]
			})
		]))
		.pipe(plugins.rename({suffix: '.min'}))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/css'))
		.pipe(browserSync.stream());
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

gulp.task('lint:scripts', function() {
	return gulp.src(['src/js/**/*.js'])
		.pipe(plugins.eslint())
		.pipe(plugins.eslint.format('stylish'));
});

gulp.task('lint:styles', function() {
	return gulp.src('src/sass/**/*.s+(a|c)ss')
		.pipe(plugins.stylelint({
			reporters: [{
				formatter: 'verbose',
				console: true,
			}],
		}));
});

gulp.task('fix:scripts', function() {
	return gulp.src(['src/js/**/*.js'])
		.pipe(plugins.eslint({
			fix: true
		}))
		.pipe(gulp.dest('src/js'));
});

gulp.task('fix:styles', function() {
	return gulp.src('src/sass/**/*.s+(a|c)ss')
		.pipe(plugins.stylelint({
			fix: true,
		}))
		.pipe(gulp.dest('src/sass'));
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

gulp.task('bump', function() {
	return gulp.src(['package.json', 'style.css'])
		.pipe(plugins.bump({
			type: argv['to-type'],
			version: argv['to-version']
		}))
		.pipe(gulp.dest('.'));
});

gulp.task('pot', function() {
	return gulp.src('**/*.php')
		.pipe(plugins.plumber({errorHandler: plugins.notify.onError('Error: <%%= error.message %>')}))
		.pipe(plugins.wpPot({
			domain: '<%= opts.projectSlug %>',
			package: '<%= opts.themeName %>'
		}))
		.pipe(gulp.dest('languages/<%= opts.projectSlug %>.pot'));
});

gulp.task('build:scripts', gulp.series('concat', 'uglify'));
gulp.task('build:styles', gulp.series('sass', 'cssnano'));
gulp.task('build', gulp.parallel('images', 'build:scripts', 'build:styles'));
gulp.task('lint', gulp.parallel('lint:scripts', 'lint:styles'));
gulp.task('fix', gulp.parallel('fix:scripts', 'fix:styles'));
gulp.task('default', gulp.series('build', 'serve'));
