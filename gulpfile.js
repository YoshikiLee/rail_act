var gulp = require('gulp');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minifyCSS = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var less = require('gulp-less');
var plumber = require('gulp-plumber');
var rename = require('gulp-rename');

gulp.task('front-minify-ccs', function() {
  return gulp.src([
      'resources/assets/css/import.css',
      'resources/vendor/font-awesome/css/font-awesome.css'
    ])
    .pipe(minifyCSS())
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
    .pipe(concat('front.min.css'))
    .pipe(gulp.dest('public/css'))
});

gulp.task('front-minify-js', function() {
  return gulp.src([
      'resources/vendor/jquery/jquery.js',
      'resources/assets/js/common.js',
      'resources/assets/js/modernizr.js'
    ])
    .pipe(concat('front.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('public/js'))
});

gulp.task('kanri-less', function() {
    return gulp.src('resources/assets/less/app.less')
        .pipe(plumber())
        .pipe(less())
        .pipe(gulp.dest('resources/assets/css/'))
});

gulp.task('kanri-minify-ccs', function() {
  return gulp.src([
      'resources/vendor/bootstrap/css/bootstrap.css',
      'resources/vendor/metisMenu/metisMenu.css',
      'resources/vendor/font-awesome/css/font-awesome.css',
      'resources/vendor/bootstrap3-dialog/css/bootstrap-dialog.css',
      'resources/vendor/datatables/css/dataTables.bootstrap.css',
      'resources/assets/css/app.css'
    ])
    .pipe(minifyCSS())
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9'))
    .pipe(concat('kanri.min.css'))
    .pipe(gulp.dest('public/css'))
});

gulp.task('kanri-minify-js', function() {
  return gulp.src([
      'resources/vendor/jquery/jquery.js',
      'resources/vendor/bootstrap/js/bootstrap.js',
      'resources/vendor/metisMenu/metisMenu.js',
      'resources/vendor/bootstrap3-dialog/js/bootstrap-dialog.js',
      'resources/vendor/datatables/js/jquery.dataTables.js',
      'resources/vendor/datatables-plugins/dataTables.bootstrap.js',
      'resources/vendor/datatables-responsive/dataTables.responsive.js',
      'resources/assets/js/app.js'
    ])
    .pipe(concat('kanri.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest('public/js'))
});

gulp.task('copy', function() {
    gulp.src(['bower_components/bootstrap/dist/**/*', '!**/npm.js', '!**/bootstrap-theme.*', '!**/*.map'])
        .pipe(gulp.dest('resources/vendor/bootstrap'))
    gulp.src(['bower_components/bootstrap-social/*.css', 'bower_components/bootstrap-social/*.less', 'bower_components/bootstrap-social/*.scss'])
        .pipe(gulp.dest('resources/vendor/bootstrap-social'))
    gulp.src(['bower_components/datatables/media/**/*'])
        .pipe(gulp.dest('resources/vendor/datatables'))
    gulp.src(['bower_components/datatables.net-plugins/integration/bootstrap/3/*'])
        .pipe(gulp.dest('resources/vendor/datatables-plugins'))
    gulp.src(['bower_components/datatables-responsive/css/*', 'bower_components/datatables-responsive/js/*'])
        .pipe(gulp.dest('resources/vendor/datatables-responsive'))
    gulp.src(['bower_components/flot/*.js'])
        .pipe(gulp.dest('resources/vendor/flot'))
    gulp.src(['bower_components/flot.tooltip/js/*.js'])
        .pipe(gulp.dest('resources/vendor/flot-tooltip'))
    gulp.src(['bower_components/font-awesome/**/*', '!bower_components/font-awesome/*.json', '!bower_components/font-awesome/.*'])
        .pipe(gulp.dest('resources/vendor/font-awesome'))
    gulp.src(['bower_components/jquery/dist/jquery.js', 'bower_components/jquery/dist/jquery.min.js'])
        .pipe(gulp.dest('resources/vendor/jquery'))
    gulp.src(['bower_components/metisMenu/dist/*'])
        .pipe(gulp.dest('resources/vendor/metisMenu'))
    gulp.src(['bower_components/morris.js/*.js', 'bower_components/morris.js/*.css', '!bower_components/morris.js/Gruntfile.js'])
        .pipe(gulp.dest('resources/vendor/morrisjs'))
    gulp.src(['bower_components/raphael/raphael.js', 'bower_components/raphael/raphael.min.js'])
        .pipe(gulp.dest('resources/vendor/raphael'))
    gulp.src(['bower_components/vue/dist/vue.js', 'bower_components/vue/dist/vue.min.js'])
        .pipe(gulp.dest('resources/vendor/vue'))
    gulp.src(['resources/assets/images/*'])
        .pipe(gulp.dest('public/images'))
    gulp.src(['resources/vendor/font-awesome/fonts/*'])
        .pipe(gulp.dest('public/fonts'))
    gulp.src(['resources/vendor/bootstrap/fonts/*'])
        .pipe(gulp.dest('public/fonts'))
    gulp.src(['bower_components/bootstrap3-dialog/dist/**/*'])
        .pipe(gulp.dest('resources/vendor/bootstrap3-dialog'))
});
