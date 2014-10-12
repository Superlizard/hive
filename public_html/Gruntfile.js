module.exports = function(grunt) {
    'use strict';

    // Force use of Unix newlines
    grunt.util.linefeed = '\n';

    RegExp.quote = function(string) {
        return string.replace(/[-\\^$*+?.()|[\]{}]/g, '\\$&');
    };

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        // Task configuration.   
        banner: '/*!\n' +
            ' * Quantum v<%= pkg.version %> (<%= pkg.homepage %>)\n' +
            ' * Copyright 2014-<%= grunt.template.today("yyyy") %> <%= pkg.author %>\n' +
            ' * Licensed under <%= _.pluck(pkg.licenses, "type") %> (<%= _.pluck(pkg.licenses, "url") %>)\n' +
            ' */\n',
        usebanner: {
            taskName: {
                options: {
                    position: 'top',
                    banner: '<%= banner %>',
                    linebreak: true
                },
                files: {
                    src: ['assets/css/style.min.css']
                }
            }
        },
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all: [
                'Gruntfile.js',
                'assets/js/*.js'
            ]
        },
        less: {
            assets: {
                options: {
                    strictMath: true,
                    sourceMap: true,
                    compress: true,
                    cleancss: true,
                    outputSourceFiles: true
                },
                files: {
                    'assets/css/style.min.css': 'assets/less/style.less'
                }
            }
        },
        watch: {
            less: {
                files: [
                    'assets/less/style.less',
                    'assets/less/variables-custom.less', 
                    'assets/less/custom-css.less',
                    'assets/less/quantum.less',
                    'assets/less/vendor/*.less'
                ],
                tasks: ['less', 'usebanner']
            },
            livereload: {
                options: {
                    livereload: true
                },
                files: [
                    'assets/css/style.min.css'
                ]
            }
        },
        clean: {
            dist: [
                'assets/css/style.min.css',
                'assets/js/plugins.min.js'
            ]
        }
    });

    // Load tasks
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-banner');

    grunt.registerTask('default', [
        'clean',
        'less',
        'usebanner'
    ]);

    grunt.registerTask('dev', [
        'watch'
    ]);
};