<?php

namespace App\Repository;

use PDO;
use App\Model\Ticket;
use App\Interface\TicketRepositoryInterface;

class DatabaseTicketRepository implements TicketRepositoryInterface
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function load($ticketID)
    {
        return Ticket::find($this->db, $ticketID);
    }

    public function save($ticket)
    {
        $ticket->save();
    }

    public function update($ticket)
    {
        $ticket->update();
    }

    public function delete($ticket)
    {
        $ticket->delete();
    }
}
