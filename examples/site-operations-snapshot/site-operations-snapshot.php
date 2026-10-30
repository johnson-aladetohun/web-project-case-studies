<?php
/**
 * Plugin Name: Site Operations Snapshot (Portfolio Demo)
 * Description: A read-only WordPress diagnostics panel demonstrating safe support triage.
 * Version: 0.1.0
 * Requires PHP: 7.4
 * License: GPL-2.0-or-later
 * Text Domain: site-operations-snapshot
 *
 * Demonstration code only. Test in a staging environment before production use.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add a read-only page in Tools for users who manage the site.
 *
 * No public routes, settings changes, or database writes are registered.
 */
add_action(
    'admin_menu',
    function () {
        add_management_page(
            __( 'Site Operations Snapshot', 'site-operations-snapshot' ),
            __( 'Site Ops Snapshot', 'site-operations-snapshot' ),
            'manage_options',
            'site-operations-snapshot',
            'jas_site_ops_render'
        );
    }
);

/**
 * Render information already available to a site administrator.
 */
function jas_site_ops_render() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( esc_html__( 'You cannot access this page.', 'site-operations-snapshot' ) );
    }

    global $wp_version;

    $home_scheme = wp_parse_url( home_url( '/' ), PHP_URL_SCHEME );
    $https_label = 'https' === strtolower( (string) $home_scheme )
        ? __( 'Enabled', 'site-operations-snapshot' )
        : __( 'Needs review', 'site-operations-snapshot' );

    $cron_disabled = defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON;
    $cron_label = $cron_disabled
        ? __( 'WP-Cron disabled: verify a server cron job exists', 'site-operations-snapshot' )
        : __( 'WP-Cron available', 'site-operations-snapshot' );

    $active_plugins = get_option( 'active_plugins', array() );
    $active_count   = is_array( $active_plugins ) ? count( $active_plugins ) : 0;
    $php_limit      = ini_get( 'memory_limit' );

    $checks = array(
        array(
            'label' => __( 'WordPress version', 'site-operations-snapshot' ),
            'value' => (string) $wp_version,
            'hint'  => __( 'Review Site Health and updates before changing core.', 'site-operations-snapshot' ),
        ),
        array(
            'label' => __( 'PHP version', 'site-operations-snapshot' ),
            'value' => PHP_VERSION,
            'hint'  => __( 'Check support status and extension compatibility.', 'site-operations-snapshot' ),
        ),
        array(
            'label' => __( 'Homepage URL scheme', 'site-operations-snapshot' ),
            'value' => $https_label,
            'hint'  => __( 'Also check certificate, redirects, and mixed content manually.', 'site-operations-snapshot' ),
        ),
        array(
            'label' => __( 'WP-Cron configuration', 'site-operations-snapshot' ),
            'value' => $cron_label,
            'hint'  => __( 'A disabled WP-Cron can be valid when server cron is configured.', 'site-operations-snapshot' ),
        ),
        array(
            'label' => __( 'Active site plugins', 'site-operations-snapshot' ),
            'value' => (string) $active_count,
            'hint'  => __( 'Count excludes multisite network activation.', 'site-operations-snapshot' ),
        ),
        array(
            'label' => __( 'PHP memory limit', 'site-operations-snapshot' ),
            'value' => false === $php_limit ? __( 'Unavailable', 'site-operations-snapshot' ) : (string) $php_limit,
            'hint'  => __( 'Compare with application needs and WordPress limits.', 'site-operations-snapshot' ),
        ),
    );

    echo '<div class="wrap">';
    echo '<h1>' . esc_html__( 'Site Operations Snapshot', 'site-operations-snapshot' ) . '</h1>';
    echo '<p>' . esc_html__( 'Read-only support triage. This is not a security scanner or a health certification.', 'site-operations-snapshot' ) . '</p>';
    echo '<table class="widefat striped"><thead><tr>';
    echo '<th scope="col">' . esc_html__( 'Check', 'site-operations-snapshot' ) . '</th>';
    echo '<th scope="col">' . esc_html__( 'Current value', 'site-operations-snapshot' ) . '</th>';
    echo '<th scope="col">' . esc_html__( 'Support note', 'site-operations-snapshot' ) . '</th>';
    echo '</tr></thead><tbody>';

    foreach ( $checks as $check ) {
        echo '<tr><th scope="row">' . esc_html( $check['label'] ) . '</th>';
        echo '<td>' . esc_html( $check['value'] ) . '</td>';
        echo '<td>' . esc_html( $check['hint'] ) . '</td></tr>';
    }

    echo '</tbody></table><p>';
    echo '<a class="button button-secondary" href="' . esc_url( admin_url( 'site-health.php' ) ) . '">';
    echo esc_html__( 'Open WordPress Site Health', 'site-operations-snapshot' );
    echo '</a></p></div>';
}
