<?php

require_once __DIR__ . '/lib/security.php';

$name = $_POST['username'] ?? null;
$comment = $_POST['comment'] ?? null;

if (empty($name) || empty($comment)) {
    exit('Comment and Name are required!');
}

require_once __DIR__ . '/lib/comments.php';
require_once __DIR__ . '/lib/response.php';

$time = time();
$message = getMessageString($name, $comment, $time);
writeComment($message, $time);
redirect('index.php');


function getDirectory(): string
{
    $dir = __DIR__ . '/storage/' . date('Y-m-d');
    if (!is_dir($dir)) {
        mkdir($dir);
    }

    return $dir;
}

function writeComment(string $message, int $time): void
{
    $hash = md5($message);
    $dir = getDirectory();
    $file = "{$dir}/{$time}_{$hash}.log";

    file_put_contents($file, $message);
}







