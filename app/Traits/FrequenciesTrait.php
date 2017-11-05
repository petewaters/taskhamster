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
        return $this->cron($this->expression);
    }

    public function everyTenMinutes()
    {
        return $this->insertIntoExpression(1, '*/10');
    }

    public function everyQuarterHour()
    {
        return $this->insertIntoExpression(1, '*/15');
    }

    public function everyHalfHour()
    {
        return $this->insertIntoExpression(1, '*/30');
    }

    public function insertIntoExpression(int $position, $value)
    {
        // In case of single value, cast to array so that we're always dealing with an array of values
        $value = (array) $value;

        $expression = explode(' ', $this->expression);
        
        // Insert the new value(s) at the specified position
        array_splice($expression, $position - 1, 1, $value);

        // Make sure the new expression isn't longer than the allowed for an expression
        $expression = array_slice($expression, 0, 5);

        return $this->cron(implode(' ', $expression));
    }
}
