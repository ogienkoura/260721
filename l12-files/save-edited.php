<?php

require_once __DIR__ . '/lib/directories.php';
require_once __DIR__ . '/lib/files.php';
require_once  __DIR__ . '/lib/response.php';

$rout = $_POST['rout'] ?? '';
$path = preparePath($rout);
$content = $_POST['comment'];

file_put_contents($path, $content);

redirect ('/l12-files/index.php?isDir=0&rout=' . $rout);
