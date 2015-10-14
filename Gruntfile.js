module.exports = function(grunt) {

    // 1. All configuration goes here
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        topojson: {
            world: {
                options: {

                    //idProperty: ["ID_ALPAGE","NUM_ARROND"],
                    copyProperties:null
                    //copyProperties:'undefined' // keep properties (data)
                },
                files: [
                    {
                        expand: true,
                        cwd: 'geodata',
                        src: ['*.json'],
                        dest: 'geodata/topo',
                        ext: '.topo.json'
                    }
                ]
            }
        }

    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-topojson');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['topojson']);

};