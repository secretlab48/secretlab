var util = require('gulp-util');

var production = util.env.production || util.env.prod || false;
var sourcePath = 'site-origin-sources';
var destPath = 'assets';

var config = {
  env: 'development',
  production: production,

  src: {
    root: sourcePath,
    sass: sourcePath + '/sass',
    js: sourcePath + '/js',
  },
  dest: {
    root: destPath,
    css: destPath + '/css',
    js: destPath + '/js',
  },

  setEnv: function(env) {
    if (typeof env !== 'string') return;
    this.env = env;
    this.production = env === 'production';
    process.env.NODE_ENV = env;
  },

  logEnv: function() {
    util.log(
      'Environment:',
      util.colors.white.bgRed(' ' + process.env.NODE_ENV + ' ')
    );
  },

  errorHandler: require('./util/handle-errors')
};

config.setEnv(production ? 'production' : 'development');

module.exports = config;