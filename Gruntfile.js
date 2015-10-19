module.exports = function(grunt) {
  require('time-grunt')(grunt);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
      
    autoprefixer: {
      options: {
        browsers: ['last 2 versions']
      },
      dist: {
        files: {
          'css/app.css' : 'css/app.css'
        },
      },
    },

    sass: {
      options: {
        sourceMap: true
      },

      dist: {
        options: {
          outputStyle: 'compressed'
        },
        files: {
          'css/app.css' : 'scss/app.scss',
          'css/slick.css' : 'node_modules/slick-carousel/slick/slick.scss'
        }
      }
    },

    copy: {
      scripts: {
        expand: true,
        cwd: 'bower_components/foundation/js/vendor/',
        src: '**',
        flatten: 'true',
        dest: 'js/vendor/'
      },
      
      slick: {
        expand: true,
        cwd: 'node_modules/slick-carousel/slick/',
        src: 'slick.min.js',
        flatten: 'true',
        dest: 'js/vendor/'
      },

      iconfonts: {
        expand: true,
        cwd: 'bower_components/fontawesome/',
        src: ['**', '!**/less/**', '!**/css/**', '!bower.json'],
        dest: 'assets/fontawesome/'
      },

    },

    'string-replace': {

      fontawesome: {
        files: {
          'assets/fontawesome/scss/_variables.scss': 'assets/fontawesome/scss/_variables.scss'
        },
        options: {
          replacements: [
            {
              pattern: '../fonts',
              replacement: '../assets/fontawesome/fonts'
            }
          ]
        }
      },
    },
      
    coffee: {
      compileBare: {
        options: {
          bare: true
        },
        files: {
          'js/custom/app.js': 'coffee/*.coffee'
        }
      },
    },

    concat: {
        options: {
          separator: ';',
        },
        dist: {
          src: [
/*
          'bower_components/foundation/js/foundation/foundation.js',

          'bower_components/foundation/js/foundation/foundation.abide.js',
          'bower_components/foundation/js/foundation/foundation.accordion.js',
          'bower_components/foundation/js/foundation/foundation.alert.js',
          'bower_components/foundation/js/foundation/foundation.clearing.js',
          'bower_components/foundation/js/foundation/foundation.dropdown.js',
          'bower_components/foundation/js/foundation/foundation.equalizer.js',
          'bower_components/foundation/js/foundation/foundation.interchange.js',
          'bower_components/foundation/js/foundation/foundation.offcanvas.js',
          'bower_components/foundation/js/foundation/foundation.reveal.js',
          'bower_components/foundation/js/foundation/foundation.slider.js',
          'bower_components/foundation/js/foundation/foundation.tab.js',
          'bower_components/foundation/js/foundation/foundation.tooltip.js',
          'bower_components/foundation/js/foundation/foundation.topbar.js',
*/

          'js/custom/app.js'

          ],
          dest: 'js/app.js',
        },
      },

    uglify: {
      options: {
        mangle: false
      },
      dist: {
        files: {
          'js/app.js': 'js/app.js'
        }
      }
    },

    watch: {
      grunt: { files: ['Gruntfile.js'] },

      css: {
        files: 'scss/**/*.scss',
        tasks: ['sass', 'autoprefixer'],
        options: {
              livereload:true,
            }
      },

      js: {
        files: 'coffee/*.coffee',
        tasks: ['coffee', 'concat', 'uglify'],
        options: {
          livereload:true,
        }
      },

       all: {
        files: '**/*.php',
        options: {
            livereload:true,
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-string-replace');

  grunt.registerTask('build', ['copy', 'string-replace:fontawesome', 'autoprefixer', 'sass', 'coffee', 'concat', 'uglify']);
  grunt.registerTask('default', ['watch']);
};