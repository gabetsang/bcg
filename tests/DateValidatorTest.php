<?php
require __DIR__ . '/../vendor/autoload.php';

class DateValidatorTest extends PHPUnit_Framework_TestCase
{
    protected $validator;

    public function __construct()
    {
        $this->validator = new DateValidator();
    }

    public function test_validation() {
        $string = '11/11/2011';
        $this->assertTrue($this->validator->validate($string));
        $string = '28/02/2011';
        $this->assertTrue($this->validator->validate($string));
        $string = '29/02/2016';
        $this->assertTrue($this->validator->validate($string));

    }

    public function test_valid_date() {
        $day = '01';
        $month = '01';
        $year = '2001';
        $this->assertTrue($this->validator->isValidDate($day, $month, $year));
        $day = '00';
        $this->assertEquals('Day value out of range between 01 and 31', $this->validator->isValidDate($day, $month, $year));
        $day = '33';
        $this->assertEquals('Day value out of range between 01 and 31', $this->validator->isValidDate($day, $month, $year));
    }

    public function test_check_days_in_months()
    {
        $months = [
            1 => 31,
            3 => 31,
            4 => 30,
            5 => 31,
            6 => 30,
            7 => 31,
            8 => 31,
            9 => 30,
            10 => 31,
            11 => 30,
            12 => 31,
        ];

        $year = 2016;
        foreach($months as $month => $days) {
            $this->assertEquals($days, $this->validator->getDaysInMonth($month, $year), $month);
        }
        $this->assertEquals(29, $this->validator->getDaysInMonth(2, $year), $year);

        $year = 2017;
        $this->assertEquals(28, $this->validator->getDaysInMonth(2, $year), $year);
    }

    public function test_check_string_format_is_dd_mm_yyyy() {
        $string = '01/01/2011';
        $this->assertEquals(['01/01/2011', '01', '01', '2011'],$this->validator->getValidInputFormat($string));
        $string = '1111/2011';
        $this->assertFalse($this->validator->getValidInputFormat($string));
        $string = '11112011';
        $this->assertFalse($this->validator->getValidInputFormat($string));
        $string = '1/1/1/1/2011';
        $this->assertFalse($this->validator->getValidInputFormat($string));
        $string = '';
        $this->assertFalse($this->validator->getValidInputFormat($string));
        $string = 'aa/11/2011';
        $this->assertFalse($this->validator->getValidInputFormat($string));
        $string = 'aa/aa/2011';
        $this->assertFalse($this->validator->getValidInputFormat($string));
        $string = 'aa/aa/aaaa';
        $this->assertFalse($this->validator->getValidInputFormat($string));
    }

    public function test_check_is_leap_year() {
        $year = 2015;
        $this->assertFalse($this->validator->isLeapYear($year));
        $year = 2004;
        $this->assertTrue($this->validator->isLeapYear($year));
        $year = 2400;
        $this->assertTrue($this->validator->isLeapYear($year));
        $year = 2200;
        $this->assertFalse($this->validator->isLeapYear($year));
    }
}
