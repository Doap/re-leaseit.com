<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package amora
 */
?>
	<div id="secondary" class="widget-area col-lg-4 col-md-4 col-sm-12 col-xs-12" role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', 'amora' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', 'amora' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
