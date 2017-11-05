<?php

namespace TaskHamster\Traits;

trait FrequenciesTrait
{
    public function cron(string $expression)
    {
        $this->expression = $expression;

        return $this;
    }

    public function everyMinute()
    {
        $this->expression = '* * * * *';

        return $this;
    }

    public function everyTenMinutes()
    {
        // $this->insertIntoExpression(1, '*/10');
        $this->expression = '*/10 * * * *';

        return $this;
    }

    public function everyQuarterHour()
    {
        $this->expression = '*/15 * * * *';

        return $this;
    }

    public function everyHalfHour()
    {
        $this->expression = '*/30 * * * *';

        return $this;
    }

    public function insertIntoExpression(int $position, string $value)
    {
        $expression = explode(' ', $this->expression);
        
        array_splice($expression, $position - 1, 1, $value);

        return $this->cron(implode(' ', $expression));
    }
}
