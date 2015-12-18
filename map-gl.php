<?php 
/**
 * Template Name: map GL
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
                            <!-- START MAP -->



                            <!-- styles-->
                            <style type="text/css">
                                #map {
                                    height: 700px;
                                    margin-top: 40px;
                                    margin-bottom: 40px;
                                }
                                #menu {
                                    background: #fff;
                                    position: absolute;
                                    z-index: 1;
                                    top: 10px;
                                    right: 10px;
                                    border-radius: 3px;
                                    width: 120px;
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

                            <h3>Que reste-t-il de cette époque dans la rue ?</h3>

                            <p>
                                source : <a href="http://www.apur.org/article/donnees-disponibles-open-data" target="_blank">APUR, emprise batie</a> + filtre sur datation
                            </p>

                            <!-- THE MAP -->
                            <div id="map"></div>
                            <nav id="menu"></nav>

                            <p>
                                todo : à croiser avec le plan Alpage Vasserot
                            </p>



                            <script>
                                // "http://paris1850.localhost/wp-content/themes/simplemag"
                                var theme_path = '<?php echo get_template_directory_uri(); ?>';

                                mapboxgl.accessToken = 'pk.eyJ1Ijoia2F6ZXMiLCJhIjoiMjBiMDc0M2UzYTdkY2NjZDZjZDVhZDdjYWMxMWU4NGMifQ.UbQyYB-QiEQklqy7AXI4XA';
                                var map = new mapboxgl.Map({
                                    container: 'map', // container id
                                    style: 'mapbox://styles/kazes/cihqcntjf004rbnm3br7uogd4', //hosted style id
                                    center: [2.3493576049804688, 48.86223033731979], // starting position
                                    zoom: 15 // starting zoom
                                });



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