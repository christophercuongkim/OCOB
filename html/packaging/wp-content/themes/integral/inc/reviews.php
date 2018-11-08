<?php

/**
 * Review notice
 */
function integral_review_notice() {
    global $current_user ;
        $user_id = $current_user->ID;
    if ( ! get_user_meta($user_id, 'integral_review_nag_ignore') ) { ?>
        <div class="notice notice-success" style="position: relative;">
        <p><?php esc_html_e('Love using Integral? Submit a review and tell us how Integral helped you build your website.', 'integral'); ?> <a target="_blank" href="<?php echo esc_url('https://wordpress.org/support/theme/integral/reviews/#new-post'); ?>"><?php esc_html_e('Sure! I\'d love to review Integral', 'integral'); ?></a></p>
        <a href="<?php echo esc_url( admin_url( '?integral_review_nag_ignore=0' ) ); ?>" style="text-decoration: none;" class="notice-dismiss"><span class="screen-reader-text"><?php esc_html_e('Dismiss this notice', 'integral'); ?></span></a>
        </div>
    <?php }
}
add_action('admin_notices', 'integral_review_notice', 100);

function integral_review_nag_ignore() {
    global $current_user;
        $user_id = $current_user->ID;
        if ( isset($_GET['integral_review_nag_ignore']) && '0' == $_GET['integral_review_nag_ignore'] ) {
             add_user_meta($user_id, 'integral_review_nag_ignore', 'true', true);
    }
}
add_action('admin_init', 'integral_review_nag_ignore');