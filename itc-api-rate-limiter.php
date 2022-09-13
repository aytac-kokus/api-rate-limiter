<?php
/**
 * Plugin Name:       Itouchcode API Rate Limiter
 * Description:       Allows only 60 API requests per minute
 * Version:           1.0.0
 * Author:            Aytac
 */

add_action('rest_api_init', function ($wp_rest_server) {
    if (!isset($_SERVER['REMOTE_ADDR'])) {
        return;
    }

    $max_limit = 60;
    $ip = sanitize_text_field($_SERVER['REMOTE_ADDR']);
    $cache_key = 'rate_limit_' . $ip;

    $cache = get_transient($cache_key);

    if (empty($cache)) {
        $cache = 0;
    }

    $cache++;

    if ($cache > $max_limit) {
        status_header(429);
        echo wp_json_encode(
            array('message' => 'Rate limit exceeded: ' . $max_limit . ' requests per minute is allowed. Please try again after a minute.')
        );
        die;
    }

    set_transient($cache_key, $cache, 60);
});