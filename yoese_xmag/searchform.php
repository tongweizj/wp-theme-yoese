<?php
/**
 * Template for displaying search forms in Yoese
 *
 * @package Yoese
 * @since Yoese 1.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'yoese' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'yoese' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><span class="sli icon-magnifier"></span> <span class="screen-reader-text"><?php _ex( 'Search', 'submit button', 'yoese' ); ?></span></button>
</form>
