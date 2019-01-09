<?php

echo $HTML->title_panel([
    'heading' => $Lang->get('Redirects'),
    'button'  => [
        'text' => $Lang->get('Add Redirect'),
        'link' => '/addons/apps/morrison_redirects/edit/',
        'icon' => 'core/plus',
        'priv' => 'content.pages.create',
    ]
], $CurrentUser);

include(__DIR__ . '/_smartbar.php');

echo $HTML->open('div.inner');

$allRedirects = $Redirects->all($Paging);

if ($allRedirects) {
    $Listing = new PerchAdminListing($CurrentUser, $HTML, $Lang, $Paging);
    $Listing->add_col([
        'title'     => 'Redirect Title',
        'value'     => 'title',
        'sort'      => 'title',
        'edit_link' => 'edit',
    ]);
    $Listing->add_col([
        'title'     => 'Pattern',
        'value'     => 'pattern',
        'sort'      => 'pattern',
    ]);
    $Listing->add_col([
        'title'     => 'URL',
        'value'     => 'url',
        'sort'      => 'url',
    ]);
    $Listing->add_col([
        'title'     => 'Status',
        'value'     => function ($item) {
            return $item->status_string();
        },
        'sort'      => 'status',
    ]);
    $Listing->add_delete_action([
        'priv'   => 'morrison_redirects.delete',
        'inline' => true,
        'path'   => 'delete',
    ]);

    echo $Listing->render($allRedirects);
};

echo $HTML->close('div');
