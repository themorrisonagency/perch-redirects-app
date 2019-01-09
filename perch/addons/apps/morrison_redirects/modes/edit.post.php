<?php

echo $HTML->title_panel([
    'heading' => $Lang->get($title),
], $CurrentUser);

echo $message ? $message : '';

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

echo $HTML->open('div.inner');

$template_help_html = $Template->find_help();
if ($template_help_html) {
    echo $HTML->heading2('Help');
    echo '<div class="template-help">' . $template_help_html . '</div>';
}

echo $Form->form_start('edit');

    echo $Form->fields_from_template($Template, $details);
    echo $Form->submit_field('btnSubmit', 'Save', $API->app_path());

echo $Form->form_end();

echo $HTML->close('div');
