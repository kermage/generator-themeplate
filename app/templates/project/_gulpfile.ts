/* eslint-disable @typescript-eslint/no-var-requires */

import gulp from 'gulp';
import path from 'path';
import minimist from 'minimist';
import browserSync from 'browser-sync';
import File from 'vinyl';

const plugins = require('gulp-load-plugins')({ maintainScope: false });
const rollupEach = require('gulp-rollup-each');
const argv = minimist(process.argv.slice(2));

const pkg = require('./package.json');
const banner = [
	'/*!',
	' *  <%%= pkg.title %> <%%= pkg.version %>',
	' *  Copyright (C) <%%= new Date().getFullYear() %> <%%= pkg.author.name %>',
	' *  Licensed under <%%= pkg.license %>.',
	' */',
	'',
	'',
].join('\n');

const productionMode = argv.production;
process.env.NODE_ENV = productionMode ? 'production' : 'development';

const betterLastRun = function (file: File, task: string, force = false): number {
	if (force) {
		return 0;
	}

	const lastRun = gulp.lastRun(task);
	const cTime = file.stat?.ctime.getTime() || 0;

	if (lastRun >= cTime) {
		return 0;
	}

	return lastRun;
};

gulp.task('rollup', () => rollup());
gulp.task('rollup:forced', () => rollup(true));
const rollup = (force = false): void => {
	return gulp
		.src(['src/js/**/*.+(j|t)s', '!src/js/**/_*.+(j|t)s'], {
			since: (file) => betterLastRun(file, 'rollup', force),
		})
		.pipe(
			plugins.plumber({
				errorHandler: plugins.notify.onError('Error: <%%= error.message %>'),
			})
		)
		.pipe(plugins.sourcemaps.init({ loadMaps: true }))
		.pipe(rollupEach(require('./rollup.config.js')))
		.pipe(plugins.header(banner, { pkg }))
		.pipe(
			plugins.rename(function (file: File) {
				file.basename = file.basename.replace(path.extname(file.basename), '');
				file.extname = file.extname.replace('t', 'j');
			})
		)
		.pipe(plugins.sourcemaps.write('/'))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/js'))
		.pipe(browserSync.stream());
};

gulp.task('uglify', function () {
	return gulp
		.src(['assets/js/**/*.js', '!assets/js/**/*.min.js'], {
			since: (file) => betterLastRun(file, 'uglify'),
		})
		.pipe(
			plugins.plumber({
				errorHandler: plugins.notify.onError('Error: <%%= error.message %>'),
			})
		)
		.pipe(
			plugins.uglify({
				output: { comments: /^!/ },
			})
		)
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/js'))
		.pipe(browserSync.stream());
});

if (productionMode) {
	gulp.task('build:scripts', gulp.series('rollup', 'uglify'));
} else {
	gulp.task('build:scripts', gulp.series('rollup'));
}

gulp.task('webp', function () {
	return gulp
		.src('src/images/**/*.{gif,jpg,png}', {
			since: (file) => betterLastRun(file, 'webp'),
		})
		.pipe(
			plugins.plumber({
				errorHandler: plugins.notify.onError('Error: <%%= error.message %>'),
			})
		)
		.pipe(plugins.webp({ quality: 100 }))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/images'))
		.pipe(browserSync.stream());
});

gulp.task('imagemin', function () {
	return gulp
		.src('src/images/**/*.{gif,jpg,png,svg}', {
			since: (file) => betterLastRun(file, 'imagemin'),
		})
		.pipe(
			plugins.plumber({
				errorHandler: plugins.notify.onError('Error: <%%= error.message %>'),
			})
		)
		.pipe(
			plugins.imagemin([
				plugins.imagemin.svgo({ plugins: [{ removeViewBox: true }] }),
				plugins.imagemin.optipng({ optimizationLevel: 7 }),
				plugins.imagemin.mozjpeg({ quality: 100 }),
				plugins.imagemin.gifsicle({ interlaced: true }),
			])
		)
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/images'))
		.pipe(browserSync.stream());
});

gulp.task('imagecopy', function () {
	return gulp
		.src('src/images/**/*.{gif,jpg,png,svg}', {
			since: (file) => betterLastRun(file, 'imagecopy'),
		})
		.pipe(gulp.dest('assets/images'))
		.pipe(browserSync.stream());
});

if (productionMode) {
	gulp.task('build:images', gulp.series('webp', 'imagemin'));
} else {
	gulp.task('build:images', gulp.series('webp', 'imagecopy'));
}

gulp.task('sass', () => sass());
gulp.task('sass:forced', () => sass(true));
const sass = (force = false): void => {
	return gulp
		.src('src/sass/**/*.s+(a|c)ss', {
			since: (file) => betterLastRun(file, 'sass', force),
		})
		.pipe(
			plugins.plumber({
				errorHandler: plugins.notify.onError('Error: <%%= error.message %>'),
			})
		)
		.pipe(plugins.sourcemaps.init())
		.pipe(
			plugins.sass(require('sass'))({
				outputStyle: 'expanded',
			})
		)
		.pipe(plugins.postcss({ minified: false }))
		.pipe(plugins.header(banner, { pkg }))
		.pipe(plugins.sourcemaps.write('/'))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/css'))
		.pipe(browserSync.stream());
};

gulp.task('cssnano', function () {
	return gulp
		.src(['assets/css/**/*.css', '!assets/css/**/*.min.css'], {
			since: (file) => betterLastRun(file, 'cssnano'),
		})
		.pipe(
			plugins.plumber({
				errorHandler: plugins.notify.onError('Error: <%%= error.message %>'),
			})
		)
		.pipe(plugins.postcss({ minified: true }))
		.pipe(plugins.rename({ suffix: '.min' }))
		.pipe(plugins.plumber.stop())
		.pipe(gulp.dest('assets/css'))
		.pipe(browserSync.stream());
});

if (productionMode) {
	gulp.task('build:styles', gulp.series('sass', 'cssnano'));
} else {
	gulp.task('build:styles', gulp.series('sass'));
}

gulp.task('watch', function () {
	gulp.watch('src/js/**/*.{js,ts}', gulp.series('build:scripts'));
	gulp.watch('src/images/**/*.{gif,jpg,png,svg}', gulp.series('build:images'));
	gulp.watch('src/sass/**/*.{scss,sass}', gulp.series('build:styles'));
	gulp.watch('**/*.php', gulp.parallel('rollup:forced', 'sass:forced'));
});

gulp.task('browsersync', function () {
	browserSync.init({
		proxy: '<%= opts.localServer %>',
		open: false,
		notify: false,
	});
});

gulp.task('serve', gulp.parallel('watch', 'browsersync'));

gulp.task('bump', function () {
	return gulp
		.src(['package.json', 'style.css'])
		.pipe(
			plugins.bump({
				type: argv['to-type'],
				version: argv['to-version'],
			})
		)
		.pipe(gulp.dest('.'));
});

gulp.task('pot', function () {
	return gulp
		.src('**/*.php')
		.pipe(
			plugins.plumber({
				errorHandler: plugins.notify.onError('Error: <%%= error.message %>'),
			})
		)
		.pipe(
			plugins.wpPot({
				domain: '<%= opts.projectSlug %>',
				package: '<%= opts.projectName %>',
			})
		)
		.pipe(gulp.dest('languages/<%= opts.projectSlug %>.pot'));
});

gulp.task('build', gulp.parallel('build:images', 'build:scripts', 'build:styles'));
gulp.task('default', gulp.series('build', 'serve'));
