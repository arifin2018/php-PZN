<?php

namespace Services;

interface TodolistService{
    public function showTodolist():void;
    public function addTodoList(String $todo):void;
    public function removeTodoList(int $number):void;
}