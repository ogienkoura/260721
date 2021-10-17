<?php
require_once __DIR__ . '/file-edit.php';

$rout = $_GET['rout'] ?? '';
$path = preparePath($rout);
$content = file_put_contents($path);
$saveFile = refreshFile($_POST($content));

var_dump($content);