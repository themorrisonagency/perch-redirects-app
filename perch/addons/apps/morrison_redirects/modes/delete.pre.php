<?php
$Redirect = false;
$details = false;

if (PerchUtil::get('id')) {
    if (!$CurrentUser->has_priv($delete_priv)) {
        PerchUtil::redirect($API->app_path());
    }

    $Redirect = $Redirects->find(PerchUtil::get('id'));
    $details = $Redirect->to_array();
} else {
    PerchUtil::redirect($API->app_path('morrison_redirects').$return_path);
}

$Form = $API->get('Form');
$Form->set_name('delete');

if ($Form->submitted()) {
    if ($Redirect) {
        $Redirect->delete();
    }

    if ($Form->submitted_via_ajax) {
        echo $API->app_path('morrison_redirects').$return_path;
        exit;
    } else {
        PerchUtil::redirect($API->app_path('morrison_redirects').$return_path);
    }
}

if (!$Redirect) {
    PerchUtil::redirect($API->app_path('morrison_redirects').$return_path);
}
