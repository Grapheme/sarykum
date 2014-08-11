module.exports = function(grunt) {
  grunt.initConfig({
    less: {
      development: {
        options: {
          compress: false
        },
        files: {
          // target.css file: source.less file
          "css/main.css": "less/main.less"
        }
      }
    },
    watch: {
      styles: {
        files: ['less/**/*.less'], // which files to watch
        tasks: ['less'],
        options: {
          nospawn: true
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask('default', ['watch']);
};