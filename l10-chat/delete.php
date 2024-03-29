<?php

require_once __DIR__ . '/lib/security.php';

$date = $_GET['date'] ?? null;
$file = $_GET['file'] ?? null;

if (empty($date) || empty($file)) {
    exit('Got no file for edit');
}

require_once __DIR__ . '/lib/comments.php';
require_once __DIR__ . '/lib/response.php';
require_once __DIR__ . '/restore-message.php';

dropMessage($date, $file);

redirect("/l10-chat/index.php?date={$date}");