<?php

namespace Entity;

class TodoList{
    private string $todo;


    public function __construct(string $todo = "")
    {
        $this->todo = $todo;
    }


    /**
     * Get the value of todo
     */
    public function getTodo(): string
    {
        return $this->todo;
    }

    /**
     * Set the value of todo
     */
    public function setTodo(string $todo): self
    {
        $this->todo = $todo;

        return $this;
    }
}