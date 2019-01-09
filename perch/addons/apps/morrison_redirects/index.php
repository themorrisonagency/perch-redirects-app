<?php

include($_SERVER['DOCUMENT_ROOT'].'/perch/core/inc/api.php');
include(__DIR__ . '/modes/_pre.php');

$Perch->page_title = $Lang->get('Redirects');

include(__DIR__ . '/modes/list.pre.php');

include(PERCH_CORE . '/inc/top.php');

include(__DIR__ . '/modes/list.post.php');

include(PERCH_CORE . '/inc/btm.php');
