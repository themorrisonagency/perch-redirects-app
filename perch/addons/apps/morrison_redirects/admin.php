<?php
define('MORRISON_REDIRECTS_PATH', PERCH_PATH.'/addons/apps/morrison_redirects');
define('MORRISON_REDIRECTS_VERSION', '0.1.1');

if ($CurrentUser->logged_in() && $CurrentUser->has_priv('morrison_redirects')) {
    $this->register_app('morrison_redirects', 'Redirects', 1, 'Add Simple Redirects', MORRISON_REDIRECTS_VERSION);
    $this->require_version('morrison_redirects', '3.0.6');
}

spl_autoload_register(function ($class_name) {
    if (strpos($class_name, 'MorrisonRedirects')===0) {
        include(PERCH_PATH.'/addons/apps/morrison_redirects/classes/'.$class_name.'.php');
        return true;
    }
    return false;
});
