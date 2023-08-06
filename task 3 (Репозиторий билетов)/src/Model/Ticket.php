<?php

namespace App\Model;

use PDO;

class Ticket
{
    private $id;
    private $name;
    private $db;

    public function __construct(PDO $db, $id, $name)
    {
        $this->db = $db;
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public static function find(PDO $db, $id)
    {
        $stmt = $db->prepare("SELECT * FROM tickets WHERE id = ?");
        $stmt->execute([$id]);

        $ticketData = $stmt->fetch();

        if ($ticketData) {
            return new Ticket($db, $ticketData['id'], $ticketData['name']);
        }

        return null;
    }

    public function save()
    {
        $stmt = $this->db->prepare("INSERT INTO tickets (id, name) VALUES (?, ?)");
        $stmt->execute([$this->id, $this->name]);
    }

    public function update()
    {
        $stmt = $this->db->prepare("UPDATE tickets SET name = ? WHERE id = ?");
        $stmt->execute([$this->name, $this->id]);
    }

    public function delete()
    {
        $stmt = $this->db->prepare("DELETE FROM tickets WHERE id = ?");
        $stmt->execute([$this->id]);
    }
}
