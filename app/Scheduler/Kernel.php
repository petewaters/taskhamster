<?php

namespace TaskHamster\Scheduler;

use Carbon\Carbon;

use TaskHamster\Scheduler\Event;

class Kernel 
{
    protected $events = [];
    protected $date;

    /**
     * Get events attached to kernel
     *
     * @return array $events
     */
    public function getEvents()
    {
        return $this->events;
    }


    /**
     * Add event to events array
     *
     * @param Event $event
     * @return void
     */
    public function add(Event $event)
    {
        array_push($this->events, $event);

        return $event;
    }

    public function run()
    {
        foreach ($this->getEvents() as $event) {
            if (!$event->isDueToRun($this->getDate()))
                continue;
            
            $event->handle();
        }
    }

    /**
     * Return current kernel date
     *
     * @return Carbon $date
     */
    public function getDate()
    {
        if (!$this->date)
            return Carbon::now();

        return $this->date;
    }

    /**
     * Set current kernel date
     *
     * @param Carbon $date
     * @return void
     */
    public function setDate(Carbon $date)
    {
        $this->date = $date;
    }
}
