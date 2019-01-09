<?php

$Form = new PerchForm('reorder');
if ($Form->posted() && $Form->validate()) {
    $redirects = $Form->find_items('item_');
    if (PerchUtil::count($redirects)) {
        foreach ($redirects as $redirectID => $redirectOrder) {
            $Redirect = $Redirects->find($redirectID);
            if (is_object($Redirect)) {
                $data = array();
                $data['sort_order'] = (int)$redirectOrder;
                $Redirect->update($data);
            }
        }
        $Alert->set('success', PerchLang::get('Redirect orders successfully updated.'));
        PerchUtil::redirect(PERCH_LOGINPATH . '/addons/apps/morrison_redirects/reorder');
    }
}
$Redirects = $Redirects->all();
