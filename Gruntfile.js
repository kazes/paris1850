module.exports = function(grunt) {

    // 1. All configuration goes here
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        topojson: {
            world: {
                options: {},
                files: {
                    'geodata/arrondissements.topo.json':['geodata/arrondissements.json'],
                    'geodata/bati_vasserot.topo.json':['geodata/bati_vasserot.json'],
                    'geodata/fortifications_de_paris_en_1900.topo.json':['geodata/fortifications_de_paris_en_1900.json'],
                    'geodata/prison_madelonettes.topo.json':['geodata/prison_madelonettes.json'],
                    'geodata/prison_mazas.topo.json':['geodata/prison_mazas.json']
                }
            }
        }

    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-topojson');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['topojson']);

};