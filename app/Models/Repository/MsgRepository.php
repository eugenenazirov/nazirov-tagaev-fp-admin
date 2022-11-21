<?php

namespace App\Models\Repository;
use App\Models\Entity\Message;
use PDO;

class MsgRepository extends DBHandle
{
    public function getAll()
    {
        $result = [];

        $stmt = $this->connect()->query('SELECT msg_text, created_at FROM messages;');
        $query = $stmt->fetchAll(PDO::FETCH_DEFAULT);

        foreach ($query as $data) {
            $result[] = new Message(json_decode(json_encode($data), true));
        }

        return $result;
    }

    public function read(int $id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM messages WHERE id = :id;');

        $stmt->bindValue("id", $id);
        $stmt->execute();

        $query = $stmt->fetch(PDO::FETCH_DEFAULT);

        return new Message(json_decode(json_encode($query), true));
    }

    public function create(array $data)
    {
        $stmt = $this->connect()->prepare('INSERT INTO messages (msg_text) VALUES (:msg_text);');

        $stmt->bindValue("msg_text", $data['msg_text'], PDO::PARAM_STR);

        $stmt->execute();

        return new Message($data);

    }
}
