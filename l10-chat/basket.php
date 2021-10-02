<?php

require_once __DIR__ . '/lib/comments.php';
$cleanBasket = __DIR__ . '/../basket/' . date('Y-m-d');

function cleanFiles ()
{
    $cleanBasket = __DIR__ . '/basket/' . date('Y-m-d');
    $files = scandir("$cleanBasket");
    foreach ($files as $file)  {
        if ($file === '.' || $file === '..') {
            continue;
        }
        $rout = $cleanBasket . '/' . $file;
        if (is_file($rout)) {
            unlink($rout);

        }
    }
}


