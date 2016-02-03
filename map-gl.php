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
                                Filtre sur datation provenant des données de l'<a href="http://www.apur.org/article/donnees-disponibles-open-data" target="_blank">APUR, emprise batie</a>.
                            </p>


                            <!-- THE MAP -->
                            <div id="map"></div>
                            <nav id="menu"></nav>

                            <p>
                                Il s'agit d'une très bonne base pour commencer à répertorier les batiments restants de l'époque mais il faut prendre en considération que ces données peuvent ne pas être à jour ou comporter des erreurs. Voici un extrait de la documentation de ces données :
                            </p>

                            <p>
                                "Pour l'information de datation, celle-ci peut également provenir de plusieurs sources :
                            </p>
                            <ul>
                                <li>
                                    Plan de datation de Paris (avant 1800 jusqu'à 1940) réalisée par François Loyer en 1970. Ce plan, originalement au format papier et éditée à deux échelles (1/10000eme et 1/2000eme) est basé sur le plan parcellaire de l'époque et renseigne sur l'ancienneté et la qualité architecturale des bâtiments sur rue datant d'avant 1940 (et visible en 1970). Inexploitable en tant que telle sur la plate-forme SIG, la carte a été numérisée et l'information de datation reportée sur le SIG. 74 000 bâtiments datant d'avant 1940 ont en effet été datés par un processus de classification automatique permettant de transposer l'information de datation des bâtiments de la carte " Loyer " sur les emprises vectorielles représentant le bâti parisien. Ces bâtiments (sous leur forme vectorielle en SIG) sont donc datés à quelques erreurs informatiques près (entre 5 et 10 % de non-reconnaissance des légendes). Des corrections ont donc du être opérées pour régler ces erreurs de classifications; les vérifications se font faites par enquête terrain.
                                </li>
                                <li>
                                    BD MAJICII de la DGFiP: Cette source indique l'âge du bâti, informations collectées lors de la saisie de déclarations diverses. Concernant la date de construction, les chiffres ne sont toutefois pas disponibles pour l'ensemble des 35 000 bâtiments datant d'après 1940. Cette information (pas toujours renseignée et parfois de façon erronée) est donnée par la DGFiP au niveau d'une parcelle. Un indicateur a donc été créé à la parcelle concernant le bâtiment le plus ancien et le plus récent. L'exactitude de cette date est parfois sujette à caution, d'autant que l'année de construction peut être modifiée dès lors qu'un permis de construire est autorisé sur la parcelle. L'enquête terrain a complété cette exploitation.
                                </li>
                                <li>
                                    Dates des Permis de Construire après 1990 : Les années de déclaration et d'obtention des permis de construire furent communiquées tardivement et localement mais ont permis dans certains cas d'affiner la datation.
                                </li>
                                <li>
                                    Enquête terrain : Le travail d'enquête dans les 6 000 rues de Paris a consisté à expertiser les façades et l'ensemble des corps de bâtiment apparents sur rue afin de leur attribuer une des 6 périodes (post 1940).
                                </li>
                                <li>
                                    Orthophotoplans successives de 2008, 2012, 2013. Thermographie aérienne de (2009)"
                                </li>
                            </ul>

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