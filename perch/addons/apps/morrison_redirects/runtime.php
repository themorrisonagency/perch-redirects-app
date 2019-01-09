<?php
// This app will load redirects before the site loads anything else
spl_autoload_register(function ($class_name) {
    if (strpos($class_name, 'MorrisonRedirects')===0) {
        include(__DIR__.'/classes'.'/'.$class_name.'.php');
        return true;
    }
    return false;
});

include(__DIR__.'/load.php');
