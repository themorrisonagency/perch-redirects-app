<?php
$title = 'Redirect';
$delete_priv = 'morrison_redirects.delete';
$return_path = '/';

// include the API
include($_SERVER['DOCUMENT_ROOT'].'/perch/core/inc/api.php');

include(__DIR__ . '/../modes/_pre.php');

// Set the page title
$Perch->page_title = $Lang->get($title);

include(__DIR__ . '/../modes/delete.pre.php');

include(PERCH_CORE . '/inc/top.php');

include(__DIR__ . '/../modes/delete.post.php');

include(PERCH_CORE . '/inc/btm.php');
