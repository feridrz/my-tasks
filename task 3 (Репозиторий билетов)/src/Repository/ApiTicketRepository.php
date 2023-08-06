<?php

namespace App\Repository;

use App\Interface\TicketRepositoryInterface;

class ApiTicketRepository implements TicketRepositoryInterface
{
    private $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function load($ticketID)
    {
        // Use $this->apiClient to load a ticket by ID from API
    }

    public function save($ticket)
    {
        // Use $this->apiClient to save a ticket to API
    }

    public function update($ticket)
    {
        // Use $this->apiClient to update a ticket in API
    }

    public function delete($ticket)
    {
        // Use $this->apiClient to delete a ticket in API
    }
}