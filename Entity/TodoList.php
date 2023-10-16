<?php

namespace Entity;

class TodoList{
    private string $todo;
    private int $id;


    public function __construct(string $todo = "", int $id = null)
    {
        $this->todo = $todo;
        $this->id = $id;
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

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
}