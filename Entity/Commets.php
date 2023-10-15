<?php

namespace Entity;

class Comments{
    private ?int $id;
    private ?string $comment;
    private ?int $customer_id;
    public function __construct(
        ?int $id = null,
        ?string $comment = null,
        ?int $customer_id = null
    )
    {
        $this->id = $id;
        $this->comment = $comment;
        $this->customer_id = $customer_id;
    }

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id):void
    {
        $this->id = $id;
    }

    /**
     * Get the value of comment
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     */
    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * Get the value of customer_id
     */
    public function getCustomerId(): ?int
    {
        return $this->customer_id;
    }

    /**
     * Set the value of customer_id
     */
    public function setCustomerId(?string $customer_id):void
    {
        $this->customer_id = $customer_id;
    }
}