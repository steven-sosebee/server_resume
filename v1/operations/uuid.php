<?php

function uuid ($length){
    $bytes = random_bytes($length/2);
    $bytes = bin2hex($bytes);
    return $bytes;
}