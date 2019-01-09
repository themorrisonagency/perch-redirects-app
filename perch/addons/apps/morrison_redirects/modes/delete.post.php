<?php

echo $HTML->title_panel([
    'heading' => $Lang->get('Location Details'),
], $CurrentUser);

$Smartbar = new PerchSmartbar($CurrentUser, $HTML, $Lang);

$Smartbar->add_item([
    'active' => true,
    'type' => 'breadcrumb',
    'links' => [
        [
            'title' => 'Redirects',
            'link' => '/addons/apps/morrison_redirects/'
        ],
        [
            'title' => $title,
        ]
    ],
]);

echo $Smartbar->render();

# Main panel
echo $HTML->main_panel_start();

if (isset($message)) {
    echo $message;
} else {
    echo $HTML->heading1('Deleting ‘%s’', $HTML->encode($Redirect->title()));

    /* ---- FORM ---- */
    echo $Form->form_start('edit');
    echo $HTML->warning_message(
        'Are you sure you wish to delete the %s redirect?',
        $details['title']
    );
    echo $Form->hidden('id', $details['id']);
    echo $Form->submit_field('btnSubmit', 'Delete', $API->app_path('hooters_locations').$return_path);

    echo $Form->form_end();
    /* ---- /FORM ---- */
};

echo $HTML->main_panel_end();
