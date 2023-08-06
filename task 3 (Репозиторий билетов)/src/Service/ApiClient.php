<?php

namespace App\Service;

use App\Model\Ticket;

class ApiClient
{
    public function loadTicket($ticketId)
    {
        // Simulation of API operation
        return new Ticket($ticketId, 'Sample ticket');
    }

    public function saveTicket($ticket)
    {
        // Save the ticket using the API
    }

    public function updateTicket($ticket)
    {
        // Update the ticket using the API
    }

    public function deleteTicket($ticket)
    {
        // Delete the ticket using the API
    }
}
