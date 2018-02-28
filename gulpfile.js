var gulp = require('gulp');
var concat = require('gulp-concat');
var minifyCSS = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');

gulp.task('front-minify-ccs', function() {
  return gulp.src('resources/assets/css/import.css')
    .pipe(minifyCSS())
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
    .pipe(concat('front.min.css'))
    .pipe(gulp.dest('public/css'))
});
