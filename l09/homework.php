<?php

$array = [
    'test' => 123123,
    'qwerty' => 'qqqq',
    'data' => [
        1, 2, 3,
    ],
    'q' => [
        'w' => [1, 2],
        'r' => [1, 2],
    ],
];


function arrayCount($array, $i = 0){
    foreach($array as $a){
        if(is_array($a)){
            $i += arrayCount($a, 1);
        }
        else {
            $i++;
        }
    }
    return $i;
}
var_dump(arrayCount($array));

function printArray($array){
    if(!is_array($array)) return $array;
    else {
        foreach ($array as $key=>$item) {
            print '['. $key. ']'. '=>'.printArray($item). '<br>';
        }
    }
}
echo printArray($array);