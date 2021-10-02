<?php

require_once __DIR__ . '/lib/comments.php';

function restoreFiles ()
{
    $restoreDir = __DIR__ . '/basket/' . date('Y-m-d');
    $files = scandir("$restoreDir");
    foreach ($files as $file)  {
        if ($file === '.' || $file === '..') {

            continue;
        }
        if (is_file("$restoreDir/$file")) {
            $dir = __DIR__ . '/storage/' . date('Y-m-d');
            rename("$restoreDir/$file", "{$dir}/{$file}");
        }
    }
}






