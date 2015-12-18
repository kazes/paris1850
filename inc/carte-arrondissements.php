<!-- styles-->
<style type="text/css">
    #map-container {
        position: relative;
    }
    #map {
        height: 700px;
        margin-top: 40px;
        margin-bottom: 40px;
    }

    /* MENU */
    #menu {
        background: #fff;
        position: absolute;
        z-index: 1;
        top: 10px;
        right: 10px;
        border-radius: 3px;
        width: 200px;
        border: 1px solid rgba(0,0,0,0.4);
        font-family: 'Open Sans', sans-serif;
    }

    #menu a {
        font-size: 13px;
        color: #404040;
        display: block;
        margin: 0;
        padding: 0;
        padding: 10px;
        text-decoration: none;
        border-bottom: 1px solid rgba(0,0,0,0.25);
        text-align: center;
    }

    #menu a:last-child {
        border: none;
    }

    #menu a:hover {
        background-color: #f8f8f8;
        color: #404040;
    }

    #menu a.active {
        background-color: #3887be;
        color: #ffffff;
    }

    #menu a.active:hover {
        background: #3074a4;
    }
</style>

<!-- THE MAP -->
<div id="map-container">
    <div id="map"></div>
    <nav id="menu"></nav>
</div>


<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoia2F6ZXMiLCJhIjoiMjBiMDc0M2UzYTdkY2NjZDZjZDVhZDdjYWMxMWU4NGMifQ.UbQyYB-QiEQklqy7AXI4XA';

    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/kazes/cihqcntjf004rbnm3br7uogd4',
        center: [2.338027954103012, 48.85906816414709],
        zoom: 12, // starting zoom
        minZoom: 11,
        maxZoom:18
    });

    var colors = ['#b7bbf9', '#dcc36a', '#dcc3f2', '#cafaf8', '#fbfad1', '#fbb9b6', '#cbb9c9', '#cbd6c9', '#facaf7', '#facac9', '#c3fbc5', '#faf1ef'];

    map.on('style.load', function(){
        map.addSource('quartiers', {
            type: 'vector',
            url: 'mapbox://kazes.4tfb706y' // https://www.mapbox.com/studio/data/kazes.4tfb706y/
        });


        // draw each arrondissement as a layer
        for (var p = 0; p < 12; p++) {
            // fill arrondissements with different colors
            map.addLayer({
                id: 'arrond-' + p,
                type: 'fill',
                source: 'quartiers',
                'source-layer': 'quartiers',
                paint: {
                    'fill-color': colors[p],
                    'fill-opacity':  0.5
                },
                filter: [ 'all',
                    [ '==', 'ARROND', p + 1 ]
                ]
            });

            // stroke quartiers
            map.addLayer({
                id: 'quartiers-arrond-' + p,
                type: 'line',
                source: 'quartiers',
                'source-layer': 'quartiers',
                interactive:true,
                paint: {
                    'line-color':'#000000',//colors[p],
                    'line-width':2,
                    'line-opacity':0.1
                },
                filter: [ 'all',
                    [ '==', 'ARROND', p + 1 ]
                ]
            })
        }
    });


    function addButtonLayer(name, id) {
        var link = document.createElement('a');
        link.href = '#';
        link.className = 'active';
        link.textContent = name;

        link.onclick = function (e) {
            e.preventDefault();
            e.stopPropagation();


            var visibility;
            if(id == 'quartiers'){
                for (var i = 0; i < 12; i++) {
                    var id_arrond = 'arrond-' + i;
                    var id_quartiers = 'quartiers-arrond-' + i;
                    visibility = map.getLayoutProperty(id_arrond, 'visibility');
                    map.setLayoutProperty(id_arrond, 'visibility', (visibility === 'visible') ? 'none' : 'visible');
                    map.setLayoutProperty(id_quartiers, 'visibility', (visibility === 'visible') ? 'none' : 'visible');
                }
            }
            else {
                visibility = map.getLayoutProperty(id, 'visibility');
                map.setLayoutProperty(id, 'visibility', (visibility === 'visible') ? 'none' : 'visible');
            }
            this.className = (visibility === 'visible') ? '' : 'active';
        };

        var layers = document.getElementById('menu');
        layers.appendChild(link);
    }

    addButtonLayer('quartiers', 'quartiers');
    addButtonLayer('bati actuel restant','apurbatimentsactuelsdejapresents');

    var quartierInfos = function(e){
        var feat = null;

        map.featuresAt(e.point, {}, function(err, features) {
            if (features && features.length > 0) {
                for (var i = 0; i < features.length; i++) {
                    if(features[i].layer.id.indexOf("quartier") > -1 )
                        feat = features[i];
                }
                var quartier_name = feat.properties['QUARTIER'];
                var arrondissement_num = feat.properties['ARROND'];

                var infos = '<strong>Quartier :</strong> ' + quartier_name + '<br>' +
                    '<strong>Arrondissement :</strong> ' + arrondissement_num;

                // place tooltip
                tooltip = new mapboxgl.Popup()
                    .setLngLat(e.lngLat)
                    .setHTML(infos)
                    .addTo(map);
            }
        });
    };


    map.on('click', quartierInfos);

</script><!-- END MAP -->