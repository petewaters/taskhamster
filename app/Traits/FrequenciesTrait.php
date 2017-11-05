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

    public function hourly()
    {
        return $this->hourlyAt();
    }

    public function hourlyAt(int $minute = 1)
    {
        return $this->insertIntoExpression(1, $minute);
    }

    public function daily()
    {
        return $this->dailyAt();
    }

    public function dailyAt(int $hour = 0, int $minute = 0)
    {
        return $this->insertIntoExpression(1, [$minute, $hour]);
    }

    public function twiceDaily(int $firstHour = 1, int $lastHour= 12)
    {
        return $this->insertIntoExpression(1, [0, "$firstHour,$lastHour"]);
    }

    public function days(...$days)
    {
        return $this->insertIntoExpression(5, implode(',', $days ?: ['*']));
    }

    public function mondays()
    {
        return $this->days(1);
    }

    public function tuesdays()
    {
        return $this->days(2);
    }

    public function wednesdays()
    {
        return $this->days(3);
    }

    public function thursdays()
    {
        return $this->days(4);
    }

    public function fridays()
    {
        return $this->days(5);
    }

    public function saturdays()
    {
        return $this->days(6);
    }

    public function sundays()
    {
        return $this->days(7);
    }

    public function weekdays()
    {
        return $this->days(1, 2, 3, 4, 5);
    }

    public function weekends()
    {
        return $this->days(6, 7);
    }

    public function at(int $hour = 0, int $minute = 0)
    {
        return $this->insertIntoExpression(1, [$minute, $hour]);
    }

    public function weekly()
    {
        return $this->insertIntoExpression(5, 0);
    }

    public function weeklyOn(int $day = 0)
    {
        return $this->insertIntoExpression(5, $day);
    }

    public function monthly()
    {
        return $this->insertIntoExpression(1, [0, 0, 1]);
    }

    public function monthlyOn(int $day = 1)
    {
        return $this->insertIntoExpression(1, [0, 0, $day]);
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
