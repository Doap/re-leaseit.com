<?php
/**
 * amora functions and definitions
 *
 * @package amora
 */



if ( ! function_exists( 'amora_setup' ) ) :
/**
 * Set the content width based on the theme's design and stylesheet.
 */
 global $content_width;
if ( ! isset( $content_width ) ) {
	$content_width = 1100; /* pixels */
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
 

function amora_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on amora, use a find and replace
	 * to change 'amora' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'amora', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('featured-thumb',600,600,true);
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'amora' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'amora_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // amora_setup
add_action( 'after_setup_theme', 'amora_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function amora_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'amora' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'amora' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'amora' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'amora' ),
		'id'            => 'sidebar-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'amora' ),
		'id'            => 'sidebar-5',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'amora_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
 
	
function amora_customizer( $wp_customize ) {
	
	$wp_customize-> add_section(
	'layout_grid',
	array(
		'title'	=> 'Layout Settings',
		'priority' => 1
		)
	);
	
	$wp_customize->add_setting(
    'layout_option',
    array(
        'default' => '2',
        'sanitize_callback'	=> 'amora_sanitize_radio',
        )
    );
 
	$wp_customize->add_control(
	    'layout_option',
	    array(
	        'type' 	=> 'radio',
	        'label' => 'Select a Layout',
	        'section' => 'layout_grid',
	        'default'	=> '1',
	        'choices' => array(
	            '3' => '2 Column Layout',
	            '2' => '3 Column Layout',
	            '1' => '4 Column layout',
	        )
	    )
	);
	
	$wp_customize-> add_setting(
	'page_layout',
	array(
		'default'	=> 'left',
		'sanitize_callback'	=> 'amora_sanitize_select',
		)
	);
	
	$wp_customize->add_control(
    'page_layout',
    array(
        'type' => 'select',
        'label' => 'Sidebar Layout',
        'section' => 'layout_grid',
        'choices' => array(
            'left' => 'Left Sidebar',
            'right' => 'Right Sidebar',
             ),
         )
    );
    
    $wp_customize-> add_setting('logo');
    
    $wp_customize-> add_control(
	new WP_Customize_Image_Control(
        $wp_customize,
        'logo',
        array(
            'label' => __('OR Logo Upload', 'amora'),
            'section' => 'title_tagline',
            'settings' => 'logo'
            )
        )
    );
    
    $wp_customize-> add_section(
    'amora_social',
    array(
    	'title'			=> __('Social Settings','amora'),
    	'description'	=> __('Manage the Social Icon Settings of your site.','amora'),
    	'priority'		=> 3,
    	)
    );
    
    $wp_customize-> add_setting(
    'social',
    array(
    	'sanitize_callback'	=> 'amora_sanitize_checkbox',
    	)
    );
    
    $wp_customize-> add_control(
    'social',
    array(
    	'type'		=> 'checkbox',
    	'label'		=> __('Enable Social Icons','amora'),
    	'section'	=> 'amora_social',
    	'priority'	=> 1,
    	)
    );
    
    $wp_customize->add_setting(
    'iconset',
    array(
        'default' => 'def',
        'sanitize_callback'	=> 'amora_sanitize_list',
        )
    );
 
	$wp_customize->add_control(
	    'iconset',
	    array(
	        'type' => 'select',
	        'label' => 'Choose the iconset:',
	        'section' => 'amora_social',
	        'priority'=> 2,
	        'choices' => array(
	            'def' => 'Default',
	            'soshion' => 'Soshions',
	            'glossy' => 'Glossy',
	        )
	    )
	);


    $wp_customize-> add_setting(
    'facebook',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'facebook',
    array(
    	'label'		=> __('Facebook URL','amora'),
    	'section'	=> 'amora_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'twitter',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'twitter',
    array(
    	'label'		=> __('Twitter URL','amora'),
    	'section'	=> 'amora_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'google',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'google',
    array(
    	'label'		=> __('Google Plus URL','amora'),
    	'section'	=> 'amora_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'instagram',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'instagram',
    array(
    	'label'		=> __('Instagram URL','amora'),
    	'section'	=> 'amora_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'pinterest',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'pinterest',
    array(
    	'label'		=> __('Pinterest URL','amora'),
    	'section'	=> 'amora_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'rss',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'rss',
    array(
    	'label'		=> __('RSS URL','amora'),
    	'section'	=> 'amora_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'vimeo',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'vimeo',
    array(
    	'label'		=> __('Vimeo URL','amora'),
    	'section'	=> 'amora_social',
    	'type'		=> 'text',
    	)
    );
    
    $wp_customize-> add_setting(
    'mail',
    array(
    	'default'	=> '',
    	'sanitize_callback' => 'esc_url_raw',
    	)
    );
    
    $wp_customize-> add_control(
    'mail',
    array(
    	'label'		=> __('Your E-Mail Info','amora'),
    	'section'	=> 'amora_social',
    	'type'		=> 'text',
    	)
    );
    
   /*
 $wp_customize->add_setting(
    'site_color',
    	array(
	        'default' => '#6669d2',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
	
	$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'site_color',
	        array(
	            'label' => 'Site Title Color',
	            'section' => 'color',
	            'settings' => 'site_color',
	        )
	    )
	);
*/
    
    $wp_customize-> add_panel(
    'slider', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Slider Settings', 'amora'),
    'description'    => '',
    ));
    
    $wp_customize-> add_section(
    'slides',
    array(
    	'title'			=> __('Enable Slider','amora'),
    	'priority'		=> 3,
    	'panel'			=> 'slider',
    	)
    );
    
    $wp_customize-> add_setting(
    'slide_enable',
    array(
    	'sanitize_callback'	=> 'amora_sanitize_checkbox',
    	)
    );
    
    $wp_customize-> add_control(
    'slide_enable',
    array(
    	'type'		=> 'checkbox',
    	'label'		=> __('Enable Slider','amora'),
    	'section'	=> 'slides',
    	'priority'	=> 1,
    	)
    );
    
    $wp_customize-> add_section(
    'slide-1', array(
    	'title'		=> __('Slide 1', 'amora'),
    	'panel'		=> 'slider',
    	)
    );
    
    $wp_customize->add_setting( 
    'slide_1', array(
    	'sanitize_callback'	=> 'esc_url_raw',
    	)
     );
 
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'slide_1',
	        array(
	            'label' => 'Slide Upload',
	            'section' => 'slide-1',
	            'settings' => 'slide_1',
	        )
	    )
	);
	
	$wp_customize-> add_setting( 
	'desc-1', array(
			'sanitize_callback'	=> 'amora_sanitize_text',
			 )
	);
	
	$wp_customize-> add_control(
	'desc-1', array(
		'label'		=> __('Description','amora'),
		'section'	=> 'slide-1',
		'type'		=> 'text',
		)
	);
	
	$wp_customize-> add_section(
    'slide-2', array(
    	'title'		=> __('Slide 2', 'amora'),
    	'panel'		=> 'slider',
    	)
    );
    
	$wp_customize->add_setting( 
    'slide_2', array(
    	'sanitize_callback'	=> 'esc_url_raw',
    	)
     );
 
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'slide_2',
	        array(
	            'label' => 'Slide Upload',
	            'section' => 'slide-2',
	            'settings' => 'slide_2',
	        )
	    )
	);
	
	$wp_customize-> add_setting( 
	'desc-2', array(
			'sanitize_callback'	=> 'amora_sanitize_text',
			 )
	);
	
	$wp_customize-> add_control(
	'desc-2', array(
		'label'		=> __('Description','amora'),
		'section'	=> 'slide-2',
		'type'		=> 'text',
		)
	);
	
	$wp_customize-> add_section(
    'slide-3', array(
    	'title'		=> __('Slide 3', 'amora'),
    	'panel'		=> 'slider',
    	)
    );
    
	$wp_customize->add_setting( 
    'slide_3', array(
    	'sanitize_callback'	=> 'esc_url_raw',
    	)
     );
 
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'slide_3',
	        array(
	            'label' => 'Slide Upload',
	            'section' => 'slide-3',
	            'settings' => 'slide_3',
	        )
	    )
	);
	
	$wp_customize-> add_setting( 
	'desc-3', array(
			'sanitize_callback'	=> 'amora_sanitize_text',
			 )
	);
	
	$wp_customize-> add_control(
	'desc-3', array(
		'label'		=> __('Description','amora'),
		'section'	=> 'slide-3',
		'type'		=> 'text',
		)
	);
    
    function amora_sanitize_text( $t ) {
    return wp_kses_post( force_balance_tags( $t ) );
    }
    
     function amora_sanitize_radio($a) {
		$valid = array(
			'3' => '2 Column Layout',
	        '2' => '3 Column Layout',
	        '1' => '4 Column layout',
	        );
	        
	        if (array_key_exists($a, $valid)) {
		        return $a;
		        } 
		        else {
		        return '';
		        }
	    }
	    
	   function amora_sanitize_select($a) {
		$valid = array(
			'left' => 'Left idebar',
	        'right' => 'Right Sidebar',
	        );
	        
	        if (array_key_exists($a, $valid)) {
		        return $a;
		        } 
		        else {
		        return '';
		        }
	    }
	    
    function amora_sanitize_list( $input ) {
    $valid = array(
        'def' => 'Default',
	    'soshion' => 'Soshions',
	    'glossy' => 'Glossy',

    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
        } 
        else {
        return '';
       	 }
     }
     
     function amora_sanitize_checkbox( $i ) {
    if ( $i == 1 ) {
        return 1;
    } else {
        return '';
    }
}
}
add_action('customize_register', 'amora_customizer');


function amora_scripts() {
	wp_enqueue_style( 'amora-style', get_stylesheet_uri() );
	global $opt_amora;
	if (get_theme_mod('page_layout') == 'right') {
		wp_enqueue_style('amora-layout',get_template_directory_uri()."/css/layout/content-sidebar.css");
	}
	else 
	{
		wp_enqueue_style('amora-layout',get_template_directory_uri()."/css/layout/sidebar-content.css");
	}
	
	
	wp_enqueue_style('amora-bootstrap-style',get_template_directory_uri()."/css/bootstrap/bootstrap.min.css", array('amora-layout'));

	wp_enqueue_style('amora-main-skin', get_template_directory_uri()."/css/skins/main.css",array('amora-bootstrap-style'));
	
	wp_enqueue_style('bx-slider-default-theme-skin', get_template_directory_uri(). "/css/slider/jquery.bxslider.css", array('amora-main-skin'));
	
	wp_enqueue_script( 'amora-js', get_template_directory_uri() . '/js/jquery-1.11.2.js', array('jquery'));
	
	wp_enqueue_script( 'amora-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	
	wp_enqueue_script( 'amora-slider-js', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array(), true );

	wp_enqueue_script( 'amora-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function amora_initialize_header() {

	echo "<script>"; ?>
	
		$(document).ready(function(){
		  $('.bxslider').bxSlider({
		  mode: 'fade',
		  adaptiveHeight: true,
		  captions: true
		 });
		});	
		
	<?php
	
	echo "</script>";
	
	?>
	
	<style type="text/css">
	h1.site-title a {
		color: <?php echo get_theme_mod('title_color','#6669d2'); ?> !important;
	}
	</style>
	
	<?php
}
add_action('wp_head', 'amora_initialize_header');



function amora_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination clearfix"><div><ul>';
	            echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div></div>';
}}

function amora_social() {
	global $opt_amora;
	return $opt_amora['social'];
}

add_action( 'wp_enqueue_scripts', 'amora_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';