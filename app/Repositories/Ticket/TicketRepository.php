<?php

namespace App\Repositories\Ticket;

use App\Ticket;
use App\Repositories\BaseRepository;

class TicketRepository extends BaseRepository
{
    public function getModel()
    {
        return new Ticket();
    }
}
