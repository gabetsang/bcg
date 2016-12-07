<?php
require __DIR__ . '/../vendor/autoload.php';

class DateCalculatorTest extends PHPUnit_Framework_TestCase
{
    protected $calculator;
    protected $validator;

    public function __construct()
    {
        $this->validator = new DateValidator();
        $this->calculator = new DateCalculator($this->validator);
    }

    public function is_second_date_after_the_start_date()
    {
        $start = $this->validator->getValidInputFormat('11/11/2011');
        $second = $this->validator->getValidInputFormat('11/11/2012');
        $this->assertTrue($this->calculator->isAfterStartDate($start, $second));

        $start = $this->validator->getValidInputFormat('11/11/2012');
        $second = $this->validator->getValidInputFormat('11/12/2012');
        $this->assertTrue($this->calculator->isAfterStartDate($start, $second));

        $start = $this->validator->getValidInputFormat('10/12/2012');
        $second = $this->validator->getValidInputFormat('11/12/2012');
        $this->assertTrue($this->calculator->isAfterStartDate($start, $second));

    }

    public function test_get_days_from_date()
    {
        date_default_timezone_set('Australia/Sydney');
        echo "\n";
        echo 'TEST CASES (DD/MM/YYYY)';
        echo "\n";
        $date1 = new DateTime("1901-01-03");
        $date2 = new DateTime("1901-01-01");

        $expected = (int) $date1->diff($date2)->format("%a");
        $date = $this->validator->getValidInputFormat('03/01/1901');
        $date2 = $this->validator->getValidInputFormat('01/01/1901');

        $this->assertEquals($expected, ($this->calculator->getDaysFromDate($date) - $this->calculator->getDaysFromDate($date2)));
        echo '1. 02/06/1983 - 22/06/1983: ';
        echo $expected-1 . ' days';
        echo "\n";
        $date1 = new DateTime("1983-06-02");
        $date2 = new DateTime("1983-06-22");

        $expected = (int) $date1->diff($date2)->format("%a");

        $date = $this->validator->getValidInputFormat('02/06/1983');
        $date2 = $this->validator->getValidInputFormat('22/06/1983');

        $this->assertEquals($expected, abs(($this->calculator->getDaysFromDate($date) - $this->calculator->getDaysFromDate($date2))));
        echo '2. 04/07/1984 - 25/12/1984: ';
        echo $expected-1 .' days';
        echo "\n";

        $date1 = new DateTime("1984-07-04");
        $date2 = new DateTime("1984-12-25");

        $expected = (int) $date1->diff($date2)->format("%a");

        $date = $this->validator->getValidInputFormat('04/07/1984');
        $date2 = $this->validator->getValidInputFormat('25/12/1984');

        $this->assertEquals($expected, abs(($this->calculator->getDaysFromDate($date) - $this->calculator->getDaysFromDate($date2))));

        $date1 = new DateTime("1989-01-03");
        $date2 = new DateTime("1983-08-03");

        $expected = (int) $date1->diff($date2)->format("%a");

        $date = $this->validator->getValidInputFormat('03/01/1989');
        $date2 = $this->validator->getValidInputFormat('03/08/1983');

        $this->assertEquals($expected, abs(($this->calculator->getDaysFromDate($date) - $this->calculator->getDaysFromDate($date2))));
        echo '3. 03/01/1989 - 03/08/1983: ';
        echo $expected-1 .' days';
        echo "\n";

    }
}
