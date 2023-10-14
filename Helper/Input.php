<?php

function input(string $info) {
    $input = readline($info . " : ");
    return $input;
}