<?php

include(__DIR__.'/classes/MorrisonRedirects.php');
include(__DIR__.'/classes/MorrisonRedirect.php');

$API  = new PerchAPI(1.0, 'morrison_redirects');
$Redirects = new MorrisonRedirects($API);

$redirectsCollection = $Redirects->active();
if (PerchUtil::count($redirectsCollection) > 0) {
    foreach ($redirectsCollection as $key => $redirect) {
        if (strtolower($_SERVER['REQUEST_URI']) == strtolower($redirect->pattern())) {
            $code = $redirect->code();
            header('Location: ' . $redirect->url(), true, isset($code) ? (int)$code : 301);
            die();
        }
    }
}
