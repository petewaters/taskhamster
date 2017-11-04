<?php 

namespace TaskHamster\Events;

use TaskHamster\Scheduler\Event;

class SomeEvent extends Event
{
    public function handle()
    {
        var_dump('works');
    }
}