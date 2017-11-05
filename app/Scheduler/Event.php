<?php

namespace TaskHamster\Scheduler;

use Cron\CronExpression;
use Carbon\Carbon;

use TaskHamster\Traits\FrequenciesTrait;

abstract class Event
{
    use FrequenciesTrait;

    /**
     * The cron expression for the event
     *
     * @var string
     */
    public $expression = '* * * * *';

    /**
     * Handle the event
     *
     * @return void
     */
    abstract public function handle();

    /**
     * Check if the event is due
     *
     * @param Carbon $date
     * @return boolean
     */
    public function isDueToRun(Carbon $date)
    {
        return CronExpression::factory($this->expression)->isDue($date);
    }
}
