<?php

const STORAGE_DIR = __DIR__ . '/../storage/';

function createDirectory (string $name, string $rout): void
{
    $rout = preparePath($rout);
    $newRout = "{$rout}/{$name}";

    !is_dir($newRout) && mkdir($newRout);
    if (!is_dir($newRout)) {
        exit ("Directory {$newRout} can not be created");
    }
}

function readDirectory(string $rout): array
{
    $path = preparePath($rout);

    $filterItems = ['.', '.gitignore'];
    if($path === realpath(STORAGE_DIR)) {
        $filterItems [] = '..';
    }
    $dir = opendir(($path));
    $items = [];
    while (($item = readdir($dir)) !== false) {
        if (in_array($item, $filterItems, true)) {
            continue;
        }
        $items[] = [
            'name' => $item,
            'rout' => "{$rout}/{$item}",
            'is_dir' => is_dir("{$path}/{$item}"),

            ];
}
closedir($dir);

    usort($items, static fn (array $a, array $b) => $a['name'] <=> $b['name']);
    usort($items, static fn (array $a, array $b) => !$a['is_dir'] <=> !$b['is_dir']);
    return $items;
}


function preparePath (string $rout): string
{
    $rout = realpath(STORAGE_DIR . $rout);
    if (!is_dir($rout)) {
        exit ("Directory {$rout} is not exists");
    }
    return $rout;
}

function prepareRout (string $rout): string
{
    $path = preparePath($rout);
    $storage = realpath(STORAGE_DIR);
    if (strlen($path) < strlen($storage)) {
        return '';
    }
    return str_replace($storage,'', $path);
}