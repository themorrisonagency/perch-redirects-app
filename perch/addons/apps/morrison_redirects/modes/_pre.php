<?php

include(__DIR__.'/../classes/MorrisonRedirects.php');
include(__DIR__.'/../classes/MorrisonRedirect.php');

$API  = new PerchAPI(1.0, 'morrison_redirects');
$Redirects = new MorrisonRedirects($API);
$HTML   = $API->get('HTML');
$Lang   = $API->get('Lang');
$Paging = $API->get('Paging');

$Paging->set_per_page(50);

$allRedirects = array();
$allRedirects = $Redirects->all();

// Install only if $allRedirects is false. This will run the code in activate.php
// so should only ever happen on first run - silently installing the app.
if ($allRedirects == false) {
    $Redirects->attempt_install();

    $message = $HTML->warning_message('There are currently no redirects.');
}

// Attempt Updates if necessary
$Redirects->update_app_version();

PerchUI::set_subnav([
    [
        'page' => [
            'morrison_redirects',
            'morrison_redirects/edit',
            'morrison_redirects/reorder',
            'morrison_redirects/delete',
        ],
        'label'=> 'Redirects'
    ],
], $CurrentUser);
