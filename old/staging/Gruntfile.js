/*global module:false*/
module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    // Metadata.
    pkg: grunt.file.readJSON('package.json'),
    banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' +
      '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
      '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' +
      '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' +
      ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
    // Task configuration.
    concat: {
      dist: {
        src: ['js/js/jquery-2.2.4.min.js','js/jcf.js','js/jcf.checkbox.js','js/same.height.plugin.js','js/bxslider/jquery.bxslider.min.js','js/imagesloaded.pkgd.min.js','js/isotope.pkgd.min.js','js/packery-mode.pkgd.min.js','js/crazyegg.js','js/smooth-scroll.min.js','js/jquery.validate.min.js','js/jquery.lightbox_me.js','js/webfontloader.js','js/main.js'],
        dest: 'dist/functions.js'
      }
    },
    uglify: {
      dist: {
        src: 'dist/functions.js',
        dest: 'js/functions.min.js'
      }
    },
    cssmin: {
      options: {
        shorthandCompacting: false,
        roundingPrecision: -1
      },
      target: {
        files: {
          'css/main.min.css': ['css/main.css']
        }
      }
    }
  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-cssmin');

  // Default task.
  grunt.registerTask('default', ['concat', 'uglify', 'cssmin']);

};