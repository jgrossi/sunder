<?php

function asset($path, $folder = 'assets', $absolute = false)
{
    $folder = empty($folder) ? 'assets' : $folder;
    $base_path = $absolute ? get_template_directory() : get_template_directory_uri();

    return $base_path.'/'.$folder.'/'.$path;
}

function js($file, $path = 'js')
{
    $file = $path.'/'.$file.'.js';

    return asset($file, 'assets', false);
}

function css($file, $path = 'css')
{
    $file = $path.'/'.$file.'.css';

    return asset($file, 'assets', false);
}

function img($file, $path = 'img')
{
    $file = $path.'/'.$file;

    return asset($file, 'assets', false);
}

