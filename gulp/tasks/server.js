var gulp = require('gulp');
var server = require('browser-sync').create();
var util = require('gulp-util');
var config = require('../config');


gulp.task('server', function() {
  server.init({
    files: [
      '../../**/*',
    ],
    logLevel: 'info', // 'debug', 'info', 'silent', 'warn'
    logConnections: false,
    logFileChanges: true,
    open: true,
    notify: false,
    ghostMode: false,
    online: true,
    //proxy: "http://wp-template.loc/",
    proxy: "http://secretlab/",
  });
});

module.exports = server;
