<?php

function s3_storage_load_template($name, array $_vars)
{
    // You cannot let locate_template load your template because you can't pass variables to it
    $template = locate_template($name, false, false);

    // Use the default template if the theme doesn't have it
    if (!$template) {
        $template = dirname(__FILE__) . '/../templates/' . $name . '.php';
    }

    // Load the template
    extract($_vars);
    require $template;
}