<?php 

namespace TaskHamster\Events;

use TaskHamster\Scheduler\Event;

class SomeEvent extends Event
{
    /**
     * Handles the event
     *
     * @return void
     */
    public function handle()
    {
        var_dump($this->expression);
    }
}