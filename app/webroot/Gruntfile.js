module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
      },
      build: {
        
        files: {
            'js/admin.js': ['js/handlebars.js',
            'js/underscore-min.js','js/ckeditor/ckeditor.js',
            'js/chosen/chosen.jquery.min.js','js/backbone-min.js'],
            /*'./frontend.js': ['js/underscore-min.js']*/
        }
      
      }
      /*build: {
        src: 'js/<%= pkg.name %>.js',
        dest: 'build/<%= pkg.name %>.min.js'
      }*/
    }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');

  // Default task(s).
  grunt.registerTask('default', ['uglify']);

};