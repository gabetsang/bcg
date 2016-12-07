<?php

class DateCalculator
{
    protected $firstDate;
    protected $secondDate;

    public function __construct(DateValidator $validator)
    {
        $this->validator = $validator;
    }

    public function setFirstDate($string)
    {
        $this->firstDate = $string;
    }

    public function setSecondDate($string)
    {
        $this->secondDate = $string;
    }

    public function getDaysDiff() {
        $firstDateDays = $this->getDaysFromDate($this->validator->getValidInputFormat($this->firstDate));
        $secondDateDays = $this->getDaysFromDate($this->validator->getValidInputFormat($this->secondDate));

        $days = abs($firstDateDays - $secondDateDays);

        if ($days) {
            return $days - 1;
        }

        return $days;
    }

    public function outputResult() {
        $days = $this->getDaysDiff();
        return sprintf('%s - %s: %s %s', $this->firstDate , $this->secondDate , $days,  ($days > 1) ? 'days' : 'day' );
    }

    public function getDaysFromDate(array $date) {
        $days = 0;

        for ($i = 1901; $i < $date[3]; $i++) {
            $days += $this->validator->isLeapYear($i) ? 366 : 365;
        }

        for ($i = 1; $i < 13; $i++) {
            if ($i < $date[2]) {
                $days += $this->validator->getDaysInMonth($i, $date[3]);
            }
        }

        $days += $date[1];

        return $days;
    }
}