<?php
$Smartbar = new PerchSmartbar($CurrentUser, $HTML, $Lang);

$Smartbar->add_item([
    'active'   => true,
    'title'    => 'Redirects',
    'link'     => '/addons/apps/morrison_redirects/',
]);
$Smartbar->add_item([
    'active'   => false,
    'title'    => 'Reorder',
    'link'     => '/addons/apps/morrison_redirects/reorder/',
    'position' => 'end',
    'icon'     => 'core/menu',
]);

echo $Smartbar->render();
