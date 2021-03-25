var gulpfile        = require('gulp');
// var browserSync = require('browser-sync');
// var reload      = browserSync.reload;

// Require all tasks in gulp/tasks, including subfolders

// commands:
//          gulp         - to start browser-sync. Warning - css and js in wp-content - not compressed
//          gulp build   - build compressed css and js

require('require-dir')('./gulp/tasks', {recurse: true});
//
// // ==========================
//
// // browser-sync task for starting the server.
// gulpfile.task('browser-sync', function() {
//   //watch files
//   var files = [
//     './wp-content/themes/my-theme/!*',
//     './transport/!*'
//   ];
//
//   //initialize browsersync
//   browserSync.init(files, {
//     //browsersync with a php server
//     proxy: "http://perrier.loc/",
//     //notify: true
//   });
// });

// Default task to be run with `gulpfile`
// gulpfile.task('default', gulpfile.series('browser-sync'));
