<?php

const MESSAGES_STORAGE = __DIR__ . '/../storage/';


function getDates(): array
{
    $items = scandir(MESSAGES_STORAGE);
    $dates = preg_filter('/^\d{4}\-\d{2}\-\d{2}/', '$0', $items);
    rsort($dates);
    return $dates;
}

function getComments(string $date): array
{
    $dir = MESSAGES_STORAGE . $date;
    $items = scandir($dir);
    $files = preg_filter('/^\d{10}_[0-9a-f]{32}\.log$/', '$0', $items);
    rsort($files);

    $messages = [];
    foreach ($files as $file) {
        $messages[] = getComment($date, $file);
    }
    return $messages;
}

function getComment(string $date, string $file): array
{
    $rout = MESSAGES_STORAGE . "{$date}/{$file}";
    if (!file_exists($rout)) {
        exit('Comment not exists');
    }
    $comment = file_get_contents($rout);
    $comment = unserialize($comment);
    $comment['file'] = $file;

    return $comment;
}

function getMessageString(string $name, string $comment, int $createdAt, ?int $updatedAt = null): string
{
    $data = [
        'name' => $name,
        'comment' => $comment,
        'created_at' => $createdAt,
        'updated_at' => $updatedAt,
    ];

    return serialize($data);
}

function refreshMessage(string $date, string $file, string $comment): void
{
    $rout = MESSAGES_STORAGE . "{$date}/{$file}";
    if (!file_exists($rout)) {
        exit('Comment not exists');
    }

    file_put_contents($rout, $comment);
}


function dropMessage(string $date, string $file): void
{
    $rout = MESSAGES_STORAGE . "{$date}/{$file}";
    $basketStorage = basketDirectory();
    if (!file_exists($rout)) {
        exit('Comment not exists');
    }
        rename("$rout", "$basketStorage/$file");
}



function basketDirectory(): string
{
    $dirBasket = __DIR__ . '/../basket/' . date('Y-m-d');
    if (!is_dir($dirBasket)) {
        mkdir($dirBasket);
    }

    return $dirBasket;
}