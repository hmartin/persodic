/**
 * grunt-angular-translate
 * https://github.com/firehist/grunt-angular-translate
 * 
 * Copyright (c) 2013 "firehist" Benjamin Longearet, contributors
 * Licensed under the MIT license.
 */

'use strict';

module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    jshint: {
      all: [
        'Gruntfile.js',
        'tasks/**/*.js',
        '<%= nodeunit.tests %>'
      ],
      options: {
        jshintrc: '.jshintrc'
      }
    },

    // Before generating any new files, remove any previously-created files.
    clean: {
      tests: ['web/translate']
    },

    /**
     * Increments the version number, etc.
     */
    bump: {
      options: {
        files: [
          "package.json"
        ],
        commit: true,
        commitMessage: 'chore(release): v%VERSION%',
        commitFiles: [
          "package.json"
        ],
        createTag: true,
        tagName: 'v%VERSION%',
        tagMessage: 'Version %VERSION%',
        push: true,
        pushTo: 'origin'
      }
    },

    /**
     * i18nextract build json lang files
     */
    i18nextract: {

      /*
      default_options: {
        prefix:   '',
        suffix:   '.json',
        src:      [ 'web/partials/*.html'],
        lang:     ['fr_FR'],
        dest:     'web/translate'
      },

      default_exists_i18n : {
        prefix:   'exist_',
        suffix:   '.json',
        nullEmpty: true,
          src:      [ 'web/partials/*.html'],
        lang:     ['fr_FR'],
        dest:     'web/translate',
        source:   'test/fixtures/default_exists_i18n.json' // Use to generate different output file
      },

      default_deleted_i18n : {
        prefix:   'delete_',
        suffix:   '.json',
          src:      [ 'web/partials/*.html'],
        lang:     ['fr_FR'],
        dest:     'web/translate',
        source:   'test/fixtures/default_deleted_i18n.json' // Use to generate different output file
      },
*/
      default_language: {
        prefix:   '',
        suffix:   '.json',
          src:      [ 'web/partials/*.html'],
        lang:     ['fr', 'en'],
        dest:     'web/translate',
        defaultLang: 'en_US'
      }

    }

  });

  // Actually load this plugin's task(s).
grunt.loadNpmTasks('grunt-angular-translate');


};