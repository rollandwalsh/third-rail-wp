'use strict';
 
var gulp = require('gulp');
var coffee = require('gulp-coffee');
var coffeelint = require('gulp-coffeelint');
var prefix = require('gulp-autoprefixer');
var sass = require('gulp-sass');
var gutil = require('gulp-util');

var sassFiles = [
	'./sass/**/*.scss',
	'./node_modules/font-awesome/scss/*.scss',
	'./node_modules/slick-carousel/slick/slick.scss'
]
 
gulp.task('sass', function () {
  gulp.src(sassFiles)
    .pipe(sass().on('error', sass.logError))
    .pipe(prefix('last 2 versions'))
    .pipe(gulp.dest('./css/'));
});
 
gulp.task('sass:watch', function () {
  gulp.watch(sassFiles, ['sass']);
});

gulp.task('coffee', function() {
  gulp.src('./coffee/*.coffee')
  	.pipe(coffeelint())
    .pipe(coffee({bare: true}).on('error', gutil.log))
    .pipe(gulp.dest('./js/'))
});

gulp.task('coffee:watch', function () {
	gulp.watch('./coffee/**/*.coffee', ['coffee']);
});

gulp.task('default', ['sass:watch', 'coffee:watch'])
