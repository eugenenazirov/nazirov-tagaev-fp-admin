<?php

namespace App\Models\Entity;

class Message
{
    private ?int $id;
    private ?string $msg_text;
    private ?string $created_at;

    public function __construct($data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->msg_text = $data['msg_text'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getText() : string
    {
        return $this->msg_text ?? '';
    }

    public function getDate() : string
    {
        return $this->created_at ?? '';
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'text' => $this->getText(),
            'date' => $this->getDate(),
        ];
    }
}