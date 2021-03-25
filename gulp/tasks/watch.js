var gulp = require('gulp');


gulp.task('watch',
  [
    'webpack:watch',
    'sass:watch'
  ]);
