<?php

/*
Plugin Name: Sunder
Plugin URI: http://wordpress.org/plugins/sunder
Description: Sunder allows you to separate logic and view files inside Wordpress themes, making your code cleaner.
Author: Junior Grossi
Version: 1.0.0
Author URI: http://jgrossi.com
*/

require __DIR__.'/functions.php';
require __DIR__.'/src/SunderApp.php';
require __DIR__.'/src/SunderView.php';

function before_template()
{
    $template = get_page_template();
    $template = $template ? $template : get_template_directory().'/index.php';
    $output = sunder_render($template);
    if ($output !== 1) {
        echo $output;
    }
    exit();
}

add_action('template_redirect', 'before_template');

function render($file, array $variables)
{
    $path = get_template_directory();
    $file = str_replace('.php', '', $file).'.php';
    ob_start();
    $view = new SunderView($variables);
    sunder_render($path.DIRECTORY_SEPARATOR.$file, array('view' => $view));
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

function sunder_render($file, array $variables = null)
{
    global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

    if (is_array($wp_query->query_vars)) {
        extract($wp_query->query_vars, EXTR_SKIP);
    }

    if (isset($s)) {
        $s = esc_attr($s);
    }

    if (is_array($variables)) {
        extract($variables, EXTR_SKIP);
    }

    if (file_exists($file)) {
        return require_once $file;
    }
}

