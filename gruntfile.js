module.exports = function (grunt) {
	var configObject = {
		config: {
			system: {
				root: './',
				scripts: {
					src: './assets/js/src/',
					dist: './assets/js/'
				},
				styles: {
					src: './assets/scss/',
					dist: './assets/css/'
				}
			}
		},

		// styles *************************************************
		sass: {
			options: {
				style: 'expanded',
				noCache: true
			},
			system: {
				expand: true,
				cwd: '<%= config.system.styles.src %>',
				src: ['*.scss'],
				dest: '<%= config.system.styles.dist %>',
				ext: '.css'
			}
		},
		autoprefixer: {
			options: {
				browsers: ['Android >= 2.1', 'Chrome >= 21', 'iOS >= 3', 'Explorer >= 7', 'Firefox >= 17', 'Opera >= 12.1', 'Safari >= 5.0']
			},
			system: {
				expand: true,
				cwd: '<%= config.system.styles.dist %>',
				dest: '<%= config.system.styles.dist %>',
				options: {
					map: true
				},
				src: ['style.css', 'editor-style.css']
			}
		},
		cssmin: {
			options: {
				noAdvanced: true
			},
			system: {
				expand: true,
				cwd: '<%= config.system.styles.dist %>',
				dest: '<%= config.system.styles.dist %>',
				ext: '.min.css',
				src: ['*.css', '!*.min.css']
			}
		},
		lineending: {
			system: {
				expand: true,
				cwd: '<%= config.system.styles.dist %>',
				dest: '<%= config.system.styles.dist %>',
				src: ['*.css', '!*.min.css'],
				options: {
					eol: 'lf',
					overwrite: true
				}
			}
		},
		combine_mq: {
			system: {
				expand: true,
				cwd: '<%= config.system.styles.dist %>',
				dest: '<%= config.system.styles.dist %>',
				src: ['*.css', '!*.min.css']
			}
		},

		// scripts *************************************************
		browserify: {
			system: {
				options: {
					transform: [
						["babelify", { "presets": ["es2015"] }]
					]
				},
				src: '<%= config.system.scripts.src %>',
				dest: '<%= config.system.scripts.dist %>'
			}
		},
		uglify: {
			system: {
				expand: true,
				ext: '.min.js',
				cwd: '<%= config.system.scripts.dist %>',
				dest: '<%= config.system.scripts.dist %>',
				src: ['*.js', '!*.min.js', '!prism.js']
			}
		},

		// watch *************************************************
		watch: {
			files: [
				'<%= config.system.styles.src %>/*.scss',
				'<%= config.system.styles.src %>/**/*.scss',
				'<%= config.system.scripts.src %>/*.js',
				'<%= config.system.scripts.src %>/**/*.js'
			],
			tasks: ['javascript:system', 'css:system']
		}
	};

	require('load-grunt-tasks')(grunt);

	grunt.initConfig(configObject);
	grunt.loadNpmTasks('grunt-contrib-watch');
	// Register tasks
	grunt.registerTask(
		'javascript:system',
		[
			'browserify:system',
			'uglify:system'
		]
	);
	grunt.registerTask(
		'css:system',
		[
			'sass:system',
			'autoprefixer:system',
			'lineending:system',
			'combine_mq:system',
			'cssmin:system'
		]
	);

	grunt.registerTask(
		'default',
		[
			'javascript:system',
			'css:system'
		]
	);
};
