<?php

namespace TaskHamster\Traits;

trait FrequenciesTrait
{
    public function cron(string $expression)
    {
        $this->expression = $expression;
    }

    public function everyMinute()
    {
        
    }
}
