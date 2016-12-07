<?php

/**
 * Created by PhpStorm.
 * User: gtsang
 * Date: 24/03/2016
 * Time: 10:24 PM
 */
class DateValidator
{

    public function validate($string) {
        if ($matches = $this->getValidInputFormat($string)) {
            return $this->isValidDate($matches[1], $matches[2], $matches[3]);
        }

        return false;
    }

    public function isValidDate($day, $month, $year)
    {
        if ($year < 1901 || $year > 2999) {
            return 'Year value out of range between 1901 and 2999';
        }

        if ($month < 1 || $month > 12) {
            return 'Month value out of range between 01 and 12';
        }

        $days = $this->getDaysInMonth($month, $year);
        if ($day < 1 || $day > $days) {
            return 'Day value out of range between 01 and ' . $days;
        }

        return true;
    }

    public function getDaysInMonth($month, $year) {
        if ($month == 2) {
            return $this->isLeapYear($year) ? 29 : 28;
        }

        return (($month - 1) % 7 % 2) ? 30 : 31;
    }

    /**
     * @param $string
     * @return mixed array | bool
     */
    public function getValidInputFormat($string) {
        if (preg_match("/(\d{2})\/(\d{2})\/(\d{4})$/", $string, $matches)) {
            return $matches;
        }

        return false;
    }

    /**
     * pre-condition $year must be a valid four digit number
     * @param $year
     * @return bool
     */
    public function isLeapYear($year) {
        if ($this->isDivisibleByFour($year) && !$this->isDivisibleByAHundred($year)) {
            return true;
        }
        
        if ($this->isDivisibleByFourHundred($year)) {
            return true;
        }

        return false;
    }

    private function isDivisibleByFour($year) {
        return ($year % 4 == 0);
    }
    private function isDivisibleByAHundred($year) {
        return ($year % 100 == 0);
    }
    private function isDivisibleByFourHundred($year) {
        return ($year % 400 == 0);
    }

}