<?php
$Redirects = new MorrisonRedirects($API);

$result = false;
$message = false;
$details   = false;

//check to see if we have an ID on the QueryString
if (isset($_GET['id']) && $_GET['id']!='') {
    //If yes, this is an edit. Get the object and turn it into an array
    $redirectID = (int) $_GET['id'];
    $Redirect = $Redirects->find($redirectID, true);
    if ($Redirect) {
        $details = $Redirect->to_array();
    }

    $title = $details['title'];
} else {
    //If no, we're adding a new one
    $Redirect = false;
    $redirectID = false;
    $details = array();

    $title = 'Create New Redirect';
}

// Template
$Template   = $API->get('Template');
$Template->set('redirects/redirect.html', 'redirects');

$tags = $Template->find_all_tags_and_repeaters();

$Form = $API->get('Form');

if (!$CurrentUser->has_priv('hooters_redirects.edit')) {
    $Form->display_only(true);
};

$Form->handle_empty_block_generation($Template);

$Form->set_required_fields_from_template($Template, $details);

if ($Form->submitted()) {
    $data = $Form->get_posted_content($Template, $Redirects, $Redirect);

    if (strtolower($data['pattern']) == strtolower($data['url'])) {
        $message = $HTML->failure_message("You cannot redirect to the same URL! Please check your old and new URLs to ensure they are different.");
        $details = array_merge([], $details, $data); // set form details to whatever was posted
    } else {
        if ($Redirect) {
            $Redirect->update($data);
            $Redirect->index($Template);
        } else {
            $Redirect = $Redirects->create($data);

            if ($Redirect) {
                $Redirect->index($Template);
                PerchUtil::redirect($Perch->get_page().'?id='.$Redirect->id().'&created=1');
            }
        }

        if (is_object($Redirect)) {
            $message = $HTML->success_message('Your redirect has been successfully updated. Return to %sredirect listing%s', '<a href="'.$API->app_path() .'">', '</a>');
        } else {
            $message = $HTML->failure_message('Sorry, that redirect could not be updated.');
        }
    }
}

if (PerchUtil::get('created') && !$message) {
    $message = $HTML->success_message('Your redirect has been successfully created. Return to %sredirect listing%s', '<a href="'.$API->app_path() .'">', '</a>');
}
if (isset($data) && strtolower($data['pattern']) !== strtolower($data['url'])) {
    if (is_object($Redirect)) {
        $Redirect = $Redirects->find($redirectID);
        $details = $Redirect->to_array();
    }
}
