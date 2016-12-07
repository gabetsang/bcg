<?php

require __DIR__ . '/vendor/autoload.php';

$firstDateSat = false;
$secondDateSat = false;

$calculator = new DateCalculator(new DateValidator());

while ($firstDateSat === false) {
    echo "Please enter the first day in DD/MM/YYYY format: \n";
    $line = Console::getCommandLineInput();
    if ($firstDateSat = $calculator->validator->validate($line)) {
        $calculator->setFirstDate($line);

    } else {
        echo "Invalid Input. Please enter the date again in DD/MM/YYYY format. \n";
    }
}

while ($secondDateSat === false) {
    echo "Please enter the second day in DD/MM/YYYY format: \n";
    $line = Console::getCommandLineInput();
    if ($secondDateSat = $calculator->validator->validate($line)) {
        $calculator->setSecondDate($line);

    } else {
        echo "Invalid Input. Please enter the date again in DD/MM/YYYY format.\n";
    }
}

echo $calculator->outputResult();
echo "\n";
exit;

