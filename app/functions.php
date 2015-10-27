<?php

/**
 * Pretty print an object to a web-page or CLI
 *
 * @param mixed $pre Object to pretty print
 * @param string $name Optional title to print above the object
 *
 * @return void
 */
function pre($pre, $name = null)
{
    if (strtolower(php_sapi_name()) == 'cli') {
        if ($name) {
            echo '[[ ' . $name . ' ]]' . PHP_EOL;
        }
        print_r($pre);
        echo "\n\n";
    } else {
        if ($name) {
            echo '<h3>' . $name . '</h3>';
        }
        echo '<pre>';
        print_r($pre);
        echo '</pre>';
    }
}