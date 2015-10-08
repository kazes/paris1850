<?php 
/**
 * Template Name: map
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.2
**/ 
get_header();
global $ti_option; 
?>
	
	<section id="content" role="main" class="clearfix animated">

        <?php
        /**
         * If Featured Image is uploaded set it as a background
         * and change page title color to white
        **/
        if ( has_post_thumbnail() ) {
            $page_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'big-size' );
            $page_bg_image = 'style="background-image:url(' . $page_image_url[0] . ');"';
            $title_with_bg = 'title-with-bg';
        } else {
            $title_with_bg = 'wrapper title-with-sep';
        } ?>

        <header class="entry-header page-header">
            <div class="page-title <?php echo isset( $title_with_bg ) ? $title_with_bg : ''; ?>" <?php echo isset( $page_bg_image ) ? $page_bg_image : ''; ?>>
                <div class="wrapper">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </div>
            </div>
        </header>
            
    	<div class="wrapper">
			<?php
			// Enable/Disable sidebar based on the field selection
			if ( ! get_field( 'page_sidebar' ) || get_field( 'page_sidebar' ) == 'page_sidebar_on' ):
			?>
            <div class="grids">
                <div class="grid-8 column-1">
            <?php endif; ?>
                
                <?php 
                if (have_posts()) : while (have_posts()) : the_post();
                ?>
                
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                        <div class="page-content">
                        	<?php // the_content(); ?>

                            <!-- START MAP -->
                            <script src='https://api.mapbox.com/mapbox.js/v2.2.2/mapbox.js'></script>
                            <link href='https://api.mapbox.com/mapbox.js/v2.2.2/mapbox.css' rel='stylesheet' />

                            <!-- fullscreen -->
                            <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.4/Leaflet.fullscreen.min.js'></script>
                            <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.4/leaflet.fullscreen.css' rel='stylesheet' />

                            <!-- styles-->
                            <style type="text/css">
                                #map {
                                    height: 700px;
                                    margin-top: 40px;
                                    margin-bottom: 40px;
                                }
                            </style>


                            <h2>
                                Batiments présents en 1850 (données collectées)
                            </h2>



                            <!-- map -->
                            <div id="map"></div>


                            <h2>
                                Crédits données :
                            </h2>

                            <ul>
                                <li>
                                    <a href="https://twitter.com/cq94/status/610037834167283712" target="_blank">Fortifications de Paris en 1900</a> : par Christian Quest
                                </li>
                                <li>
                                    Prison des Madelonettes
                                </li>
                                <li>
                                    Prison Mazas
                                </li>
                            </ul>

                            <script>
                                var theme_path = '<?php echo get_template_directory_uri(); ?>'; // "http://paris1850.localhost/wp-content/themes/simplemag"

                                L.mapbox.accessToken = 'pk.eyJ1Ijoia2F6ZXMiLCJhIjoiMjBiMDc0M2UzYTdkY2NjZDZjZDVhZDdjYWMxMWU4NGMifQ.UbQyYB-QiEQklqy7AXI4XA';
                                var mapbox_project_id = 'kazes.bba505ed';
                                var map = L.mapbox.map('map', mapbox_project_id);

                                // set position to Paris, zoom level 15
                                map.setView([48.85850346934555, 2.335796356201172], 13);


                                // loads and displays fortifications geojson as layer
                                var fortifications_layer = L.mapbox.featureLayer().loadURL(theme_path + '/geodata/fortifications_de_paris_en_1900.json').addTo(map);
                                var mapbox_data = L.mapbox.featureLayer().loadURL(theme_path + '/geodata/mapbox.json').addTo(map);
                                var arrondissements = L.mapbox.featureLayer().loadURL(theme_path + '/geodata/arrondissements.json').addTo(map);

                                // button fullscreen
                                L.control.fullscreen().addTo(map);

                                // toggle layers
                                L.control.layers( {
                                    // radio buttons

                                },{
                                    // checkboxes
                                    'Fortifications 1900': fortifications_layer,
                                    'arrondissements': arrondissements,
                                    'mapbox_data': mapbox_data
                                }).addTo(map);
                            </script>



                            <!-- END MAP -->
                        </div>
                        
                    </article>
                
                <?php endwhile; endif; ?>
        		
                <?php 
				// Enable/Disable comments
				if ( $ti_option['site_page_comments'] == 1 ) {
					comments_template();
				}
				?>
                
				<?php
				// Enable/Disable sidebar based on the field selection
				if ( ! get_field( 'page_sidebar' ) || get_field( 'page_sidebar' ) == 'page_sidebar_on' ):
				?>
                </div><!-- .grid-8 -->
            
                <?php get_sidebar(); ?>

            </div><!-- .grids -->
            <?php endif; ?>
        
        </div>
    </section><!-- #content -->

<?php get_footer(); ?>