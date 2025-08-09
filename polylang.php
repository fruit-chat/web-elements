/**
 * Polylang Shortcode - https://wordpress.org/plugins/polylang/
 * Add this code in your functions.php
 * Put shortcode [polylang_langswitcher] to post/page for display flags
 *
 * @return string
 */
function custom_polylang_langswitcher() {
    $output = '';
    if ( function_exists( 'pll_the_languages' ) ) {
        $args = [
            'dropdown' => 1,
            'echo' => 0,
            'hide_if_empty' => 1,
            'show_flags' => 0,
            'show_names' => 1,
            'display_names_as' => 'name',
            'force_home' => 0,
            'hide_if_no_translation' => 1,
            'hide_current' => 0,
            'post_id' => null,
            'raw' => 0,
            'item_spacing' => 'preserve',
            'admin_render' => 0,
            'admin_current_lang' => null,
            'classes' => [],
            'link_classes' => [],
        ];
        $output = '<div class="polylang-langswitcher-dropdown">' . pll_the_languages( $args ) . '</div>';
    }
    return $output;
}

add_shortcode( 'polylang_langswitcher', 'custom_polylang_langswitcher' );
