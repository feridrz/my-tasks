<?php

require_once 'vendor/autoload.php';

use App\Repository\DatabaseTicketRepository;


$db = new PDO('mysql:host=localhost;dbname=testdb;charset=utf8', 'root', '123');

// Choose the repository based on a $_GET parameter
if (isset($_GET['repo']) && $_GET['repo'] === 'api') {
    $repository = new ApiTicketRepository();
} else {
    $repository = new DatabaseTicketRepository($db);
}

// Load a ticket
$ticketId = $_GET['ticketId'] ?? 1;
$ticket = $repository->load($ticketId);

if ($ticket) {
    echo 'Ticket name: ' . $ticket->getName();
} else {
    echo 'No ticket found';
}
