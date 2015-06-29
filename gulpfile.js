'use strict';
 
var gulp = require('gulp');
var coffee = require('gulp-coffee');
var coffeelint = require('gulp-coffeelint');
var prefix = require('gulp-autoprefixer');
var sass = require('gulp-sass');
var gutil = require('gulp-util');
 
gulp.task('sass', function () {
  gulp.src('./sass/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(prefix('last 2 versions'))
    .pipe(gulp.dest('./'));
});
 
gulp.task('sass:watch', function () {
  gulp.watch('./sass/**/*.scss', ['sass']);
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
