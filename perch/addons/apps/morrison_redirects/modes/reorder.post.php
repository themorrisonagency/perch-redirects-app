<?php
echo $HTML->title_panel([
    'heading' => $Lang->get('Reorder Redirects'),
    'button'  => [
        'text' => $Lang->get('Add Redirect'),
        'link' => '/addons/apps/morrison_redirects/edit',
        'icon' => 'core/plus',
        'priv' => 'hooters_locations.edit',
    ]
], $CurrentUser);

$Alert->set('info', PerchLang::get('Drag and drop the items to reorder them.'));
$Alert->output();

include(__DIR__ . '/_smartbar.php');
?>

<div class="inner">
<form method="post" action="<?php echo PerchUtil::html($Form->action(), true); ?>" class="reorder form-simple">

<?php
if (PerchUtil::count($Redirects)) {
    echo '<ol class="basic-sortable sortable-tree">';
    $i = 1;
    foreach ($Redirects as $Redirect) {
        $details = $Redirect->to_array();
        $editUrl = PERCH_LOGINPATH.'/addons/apps/morrison_redirects/edit/?id='.$Redirect->id();
        echo '<li><div>';
        echo '<a href="'.$editUrl.'" class="col">';
        echo '<svg role="img" width="14" height="14" class="icon icon-menu" title="Reorder" aria-label="Reorder">';
        echo '<use xlink:href="/perch/core/assets/svg/core.svg#menu"></use></svg>';
        echo PerchUtil::html($details['title']).'</a>';
        echo $Form->text('item_'.$details['id'], $details['sort_order'], 's');
        echo '</div></li>';
        $i++;
    }
    echo '</ol>';
}
?>
        <div class="submit-bar">
            <?php
            echo $Form->submit('reorder', 'Save Changes', 'button action');
            echo $Form->hidden('orders', '');
            ?>
        </div>
    </form>
</div>
