<?php

class InputHelper{
    public static function input(string $info) {
        $input = readline($info . " : ");
        return $input;
    }

}