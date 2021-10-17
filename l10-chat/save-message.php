<?php

require_once __DIR__ . '/lib/security.php';

$date = $_POST['date'] ?? null;
$file = $_POST['file'] ?? null;

if (empty($date) || empty($file)) {
    exit('Got no file for edit');
}

require_once  __DIR__ . '/lib/comments.php';
require_once __DIR__ . '/lib/response.php';


$oldMessage = getComment($date, $file);


$message = getMessageString($_POST['username'], $_POST['comment'], $oldMessage['created_at'], time());
refreshMessage($date, $file, $message);

redirect("/l10-chat/index.php?date={$date}");


